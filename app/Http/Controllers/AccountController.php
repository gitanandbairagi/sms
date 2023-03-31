<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Maintenance;
use Validator;
use Carbon\Carbon;

class AccountController extends Controller
{
    public function index() {
        $from = now()->startOfMonth()->toArray();
        $from = $from['formatted'];
        $account = new Account;
        $maintenance = new Maintenance;
        $data = [
            'accounts' => $account->where('created_at', '>=', $from)
                                ->with('transaction','transaction.user')
                                ->orderBy('id', 'DESC')
                                ->get(),
            'available_balance' => $account->exists() ? $account->latest()->first()->balance : 0,
            'maintenance_amount' => $maintenance->exists() ? $maintenance->latest()->first()->amount : 0,
        ];
        return view('sms.pages.account.index', compact('data'));
    }

    public function history(Request $request) {
        // if params are set then assigned param value else assigned empty string
        $from = isset($request->from) ? $request->from : today()->addMinutes(2280);
        $to = isset($request->to) ? $request->to : '2023-03-26';
        $data = [];
        // fetching results from db
        $data['accounts'] = Account::where('created_at', '>=', $from)->orWhere('created_at', '<=', $to)
                                ->with('transaction','transaction.user')
                                ->orderBy('id', 'DESC')
                                ->get();
        $result_count = $data['accounts']->count();
        // if $result_count is between 0 to 1 spell 'result' else spell 'results' in the string $result_count." result found";
        if ($result_count == 0 || $result_count == 1) {
            $data['message'] = $result_count." result found";
        }
        else {
            $data['message'] = $result_count." results found";
        }
        session()->flashInput($request->input());
        return view('sms.pages.account.history', compact('data'));
    }

    public function withdraw(Request $request) {
        $validator = Validator::make($request->all(), [
            'amount' => 'required | min:1',
        ], [
            'amount.required' => '* Amount is Required',
            'amount.min' => '* Amount must be greater than 1',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }
        $account = new Account;
        $balance = $account->latest()->first()->balance;
        if ($request->amount > $balance) {
            $validator->errors()->add('amount', '* Insuffient Fund in Account');
            return response()->json($validator->messages(), 400);
        }
        // Adding withdraw amount to accounts table
        $account->credit_debit = 'dr';
        $account->amount = $request->amount;
        $account->balance = $balance - $request->amount;
        $account->created_at = now();
        $saved = $account->save();
        // Check if model got saved or not
        if (!$saved) {
            return response()->json(['message' => 'Something went wrong at server'], 500);
        }
        return response()->json(['message' => $request->amount.' has been withdraw successfully.'], 200);
    }

    public function set_maintenance(Request $request) {
        $validator = Validator::make($request->all(), [
            'amount' => 'required | min:1',
        ], [
            'amount.required' => '* Amount is Required',
            'amount.min' => '* Amount must be greater than 1',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }
        $maintenance = new Maintenance;
        // Adding maintenance to maintenances table
        $maintenance->user_id = session('id');
        $maintenance->amount = $request->amount;
        $saved = $maintenance->save();
        // Check if model got saved or not
        if (!$saved) {
            return response()->json(['message' => 'Something went wrong at server'], 500);
        }
        return response()->json(['message' => 'New maintenance set successfully to '.$request->amount.' INR.'], 200);
    }
}
