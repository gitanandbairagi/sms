<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Scopes\AncientScope;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Society;
use App\Models\Maintenance;
use Validator;

class AuthController extends Controller
{
    public function login() {
        return view('main.auth.login');
    }
    public function login_post(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required | email',
            'password' => 'required',
        ], [
            'email.required' => '* Email is Required',
            'email.email' => '* Invalid Email Format',
            'password.required' => '* Password is Required',
        ]);

        // Check if validator fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages())->withInput();
        }
        // Access SMS if validator passes
        $user = User::withoutGlobalScope(AncientScope::class)->where('email', $request->email)->first();
        // $user = User::where('email', $request->email)->with('society')->first();
        if (isset($user->email)) {
            // Email exists
            if (password_verify($request->password, $user->password)) {
                // SMS Access Granted
                session([
                    'id' => $user->id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'mobile_number' => $user->mobile_number,
                    'email' => $user->email,
                    'profile_pic' => $user->profile_pic,
                    'status' => $user->status,
                    'role' => $user->role,
                    'society_name' => $user['society']->name,
                    'society_id' => $user['society']->id,
                ]);
                return redirect()->route('dashboard');
            }
            else {
                session()->flash('error', 'Password is Incorrect.');
                return redirect()->back()->withInput();
            }
        }
        session()->flash('error', 'Email does not Exist.');
        return redirect()->back()->withInput();
    }

    public function logout() {
        session()->flush();
        return redirect()->route('index');
    }

    public function signup() {
        return view('main.auth.signup');
    }

    public function signup_post(Request $request) {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required | email | unique:users,email',
            'gender' => 'required',
            'dob' => 'required | date',
            'mobile_number' => 'required | digits:10',
            'aadhaar_number' => 'required | digits:12',
            'profile_pic' => 'required',
            'type' => 'required',
            'name' => 'required',
            'area' => 'required',
            'landmark' => 'required',
            'city' => 'required',
            'state' => 'required',
            'maintenance_amount' => 'required | min:1',
            'password' => 'required | min:8 | confirmed',
            'password_confirmation' => 'required | min:8',
        ], [
            'first_name.required' => '* First Name is Required',
            'last_name.required' => '* Last Name is Required',
            'email.required' => '* Email is Required',
            'email.email' => '* Invalid Email Format',
            'email.unique' => '* Email is Already Taken',
            'gender.required' => '* Gender is Required',
            'dob.required' => '* Date of Birth is Required',
            'dob.date' => '* Date of has to be a date',
            'mobile_number.required' => '* Mobile Number is Required',
            'aadhaar_number.required' => '* Aadhaar Number is Required',
            'aadhaar_number.digits' => '* Aadhaar Number should have length of 12 digits',
            'profile_pic.required' => '* Profile Picture is Required',
            'type.required' => '* Type is Required',
            'name.required' => '* Name is Required',
            'area.required' => '* Area is Required',
            'landmark.required' => '* Landmark is Required',
            'city.required' => '* City is Required',
            'state.required' => '* State is Required',
            'maintenance.required' => '* Maintenance Amount is Required',
            'maintenance.min' => '* Maintenance Amount must be Greater than 1 INR',
            'password.required' => '* Password is Required',
            'password.min' => '* Password must be Greater than 8 Characters',
            'password.confirmed' => '* Password and Confirm Password does not match',
            'password_confirmation.required' => '* Confirm Password is Required',
        ]);

        // return back if validator fails  
        if ($validator->fails()) {  
            return redirect()->back()->withErrors($validator->messages())->withInput();
        } 

        // Move profile_pic to folder and rename it
        $profile_pic = $request->file('profile_pic');
        $profile_pic_name = 'profile_pic_'.time().'.'.$profile_pic->getClientOriginalExtension();
        $profile_pic->move(base_path('assets/images'), $profile_pic_name);
        // Adding Society Info to societies Table
        $society_id = Society::insertGetId([
            'name' => $request->name,
            'area' => $request->area,
            'landmark' => $request->landmark,
            'city' => $request->city,
            'state' => $request->state,
        ]);
        // Adding Admin to users Table
        $user_id = User::insertGetId([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'gender' => $request->gender,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
            'dob' => $request->dob,
            'mobile_number' => $request->mobile_number,
            'aadhaar_number' => $request->aadhaar_number,
            'role' => 'admin',
            'society_id' => $society_id,
            'profile_pic' => $profile_pic_name,
            'type' => $request->type,
            'created_at' => now(),
        ]);
        // Adding maintenance amount to maintenances table
        Maintenance::insert([
            'user_id' => $user_id,
            'society_id' => $society_id,
            'amount' => $request->maintenance_amount,
            'created_at' => now(),
        ]);
        session()->flash('success', 'Account Created Successfully. Please Signin to Continue.');
        return redirect()->route('login');
    }
}
