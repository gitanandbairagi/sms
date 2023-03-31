<?php

namespace App\Http\Controllers\PaymentController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FundRaisingCollection;
use App\Models\Transaction;
use App\Models\Account;
use App\Mail\Invoices;
use Validator;
use Carbon\Carbon;

class CashfreePaymentController extends Controller
{
    public function create(Request $request)
    {
        return view('payment-create');
    }

    public function vindicate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required | min:1'
        ], [
                'amount.required' => '* Amount is Required',
                'amount.min' => '* Amount must be greater than 1',
            ]);
        // return error messages if validator fails else proceed
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $full_name = session('first_name') . session('last_name');
        $mobile_number = session('mobile_number');
        $email = session('email');

        $url = "https://sandbox.cashfree.com/pg/orders";

        $headers = array(
            "Content-Type: application/json",
            "x-api-version: 2022-01-01",
            "x-client-id: " . env('CASHFREE_API_KEY'),
            "x-client-secret: " . env('CASHFREE_API_SECRET')
        );

        $data = json_encode([
            'order_id' => 'order_' . $mobile_number .'_'. rand(1111111111, 9999999999).'_'.time(),
            'order_amount' => $request->amount,
            "order_currency" => "INR",
            "customer_details" => [
                "customer_id" => 'customer_' . $mobile_number .'_'. rand(111111111, 999999999).'_'.time(),
                "customer_name" => $full_name,
                "customer_email" => $email,
                "customer_phone" => $mobile_number,
            ],
            "order_meta" => [
                "return_url" => 'http://localhost/sms/payment/cashfree/success/?order_id={order_id}&reason='.$request->reason.'&data='.urlencode(base64_encode($request->id))
            ]
        ]);

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $resp = json_decode(curl_exec($curl));
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return response()->json([$err], 500);

        }

        return response()->json([
            'message' => 'You are being redirected to payment gateway...',
            'redirect_url' => $resp->payment_link,
        ], 200);
    }

    public function store_transaction($data) {
        // Storing order details in transactions table
        $transaction = new Transaction;
        $transaction->reason = $data['reason'];
        $transaction->amount = $data['order_amount'];
        $transaction->user_id = session('id');
        $transaction->society_id = session('society_id');
        $transaction->cf_order_id = $data['cf_order_id'];
        $transaction->order_id = $data['order_id'];
        $transaction->order_status = $data['order_status'];
        $transaction->order_currency = $data['order_currency'];
        $transaction->created_at = now();
        $transaction->save();
    }

    public function success(Request $request)
    {
        $order_id = $request->order_id;
        $work_id = base64_decode(urldecode($request->data));
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://sandbox.cashfree.com/pg/orders/".$order_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'x-api-version: 2021-05-21',
                'x-client-id: '.env('CASHFREE_API_KEY'),
                'x-client-secret: '.env('CASHFREE_API_SECRET')
            ),
        )
        );

        $resp = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($resp, true);
        if ($result['order_status'] != 'PAID') {
            $this->store_transaction([
                'reason' => $request->reason,
                'order_amount' => $result['order_amount'],
                'cf_order_id' => $result['cf_order_id'],
                'order_id' => $result['order_id'],
                'order_status' => $result['order_status'],
                'order_currency' => $result['order_currency'],
            ]);
            session()->flash('error', "Payment Failed. But don't worry,  if  amount deducted, will be auto-credited into your acount within 3-5 business days.");
            if ($request->reason == 'maintenance') {
                return redirect()->route('account');
            }
            else if ($request->reason == 'fund_raising') {
                return redirect()->route('fund.raising');
            }
        }

        // Storing order details in transactions table
        $this->store_transaction([
        'reason' => $request->reason,
        'order_amount' => $result['order_amount'],
        'cf_order_id' => $result['cf_order_id'],
        'order_id' => $result['order_id'],
        'order_status' => $result['order_status'],
        'order_currency' => $result['order_currency'],
        ]);
        // Storing data in accounts table parallely
        $account = new Account;
        $account->order_id = $order_id;
        $account->society_id = session('society_id');
        $account->credit_debit = 'cr';
        $account->amount = $result['order_amount'];
        $account->balance += $result['order_amount'];
        $account->created_at = now(); ;
        $account->save();

        if ($request->reason == 'fund_raising') {
            // Store paid amount in fund_raising_collections table
            $frc = new FundRaisingCollection;
            $frc->work_id = $work_id;
            $frc->user_id = session('id');
            $frc->society_id = session('society_id');
            $frc->amount = $result['order_amount'];
            $frc->order_id = $order_id;
            $frc->created_at = now();    
            $frc->save();
        }
        // Sending invoice in email
        $title = ucwords(str_replace('_', ' ', $request->reason));
        $details = [
            'title' => 'SMS '.$title.' Invoice',
            'reason' => $title,
            'order_id' => $order_id,
            'amount' => money_format_india($result['order_amount']).' '.$result['order_currency'],
        ];
        \Mail::to(session('email'))->send(new Invoices($details));

        if ($request->reason == 'maintenance') {
            session()->flash('success', 'Maintenance paid successfully.');
            return redirect()->route('account');
        }
        else if ($request->reason == 'fund_raising') {
            session()->flash('success', 'Payment successfully done. Thankyou for support');
            return redirect()->route('fund.raising');
        }
    }
}