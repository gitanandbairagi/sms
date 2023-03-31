<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Society;
use Validator;

class SettingsController extends Controller
{
    public function my_profile() {
        $data = [
            'user' => User::where('id', session('id'))->first(),
        ];
        return view('sms.pages.settings.profile', compact('data'));
    }

    public function credentials() {
        $data = [
            'user' => User::where('id', session('id'))->first(),
        ];
        return view('sms.pages.settings.credentials', compact('data'));
    }

    public function update_email(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required | email | unique:users,email',
        ], [
            'email.required' => '* Email is Required',
            'email.email' => '* Invalid Email Format',
            'email.unique' => '* Email is Already Taken',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        User::where('id', session('id'))->update([
            'email' => $request->email,
        ]);
        return response()->json(['message' => 'Email updated successfully'], 200);
    }

    public function update_password(Request $request) {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required | min:8 | confirmed',
            'password_confirmation' => 'required | min:8',
        ], [
            'current_password.required' => '* Current Password is Required',
            'password.required' => '* Password is Required',
            'password.confirmed' => '* Password and Confirm Password does not match',
            'password_confirmation.required' => '* Confirm Password is Required',
        ]);

        $current_password = User::where('id', session('id'))->first()->makeVisible(['password'])->password;
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }
        else if (!password_verify($request->current_password, $current_password)) {
            $validator->errors()->add('current_password', '* Current Password is not correct');
            return response()->json($validator->messages(), 400);
        }

        User::where('id', session('id'))->update([
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
        ]);
        return response()->json(['message' => 'Password updated successfully'], 200);
    }

    public function society_profile() {
        $data = [
            'society' => Society::where('id', session('society_id'))->first(),
        ];
        return view('sms.pages.settings.society_profile', compact('data'));
    
    }
    public function update_society(Request $request) {
        $validator = Validator::make($request->all(), [
            'value' => 'required'
        ], [
            'value.required' => '*'.ucwords($request->key).' is Required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        Society::where('user_id', session('id'))->update([
            $request->key => $request->value
        ]);

        return response()->json([
            'message' => ucfirst($request->key).' updated successfully. Please refresh the page to view changes'
        ], 200);
    }
}
