<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Account;
use App\Models\Notice;
use App\Models\Query;
use Validator;

class CommonController extends Controller
{
    public function index() {
        return view('main.index');
    }
    public function dashboard() {
        $account = Account::where('society_id', session('society_id'));
        if ($account->exists()) {
            $available_balance = $account->latest()->first()->balance;
        } else {
            $available_balance = 0;
        }
        $data = [
            'available_balance' => $available_balance,
            'members_count' => User::where('society_id', session('society_id'))->count(),
            'notice' => Notice::where(['status' => 1, 'user_id' => session('id')])->with('user:first_name,last_name,profile_pic,id')->first(),
        ];
        return view('sms.dashboard', compact('data'));
    }

    public function message_us(Request $request) {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile_number' => 'required | digits:10',
            'email' => 'required | email',
            'message' => 'required',
        ], [
            'first_name.required' => '* First Name is Required',
            'last_name.required' => '* Last Name is Required',
            'mobile_number.required' => '* Mobile Number is Required',
            'mobile_number.digits' => '* Mobile Number must contains 10 digits',
            'email.required' => '* Email is Required',
            'email.email' => '* Invalid Email Format',
            'message.required' => '* Message is Required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $query = new Query;
        $query->first_name = $request->first_name;
        $query->last_name = $request->last_name;
        $query->email = $request->email;
        $query->mobile_number = $request->mobile_number;
        $query->message = $request->message;
        $query->save();

        return response()->json(['message' => 'Thankyou for reaching us. Our team will contact you soon.'], 200);
    }
}
