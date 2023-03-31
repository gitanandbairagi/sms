<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Carbon\Carbon;
use App\Mail\MemberCredentials;

class MembersController extends Controller
{
    public function index() {
        $data = [
            'users' => User::where(['status' => 1, 'society_id' => session('society_id')])->get(),
        ];
        return view('sms.pages.members.index', compact('data'));
    }

    public function history() {
        $data = [
            'users' => User::where('status', 0)->get(),
        ];
        return view('sms.pages.members.history', compact('data'));
    }

    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required | email | unique:users,email',
            'dob' => 'required | date',
            'mobile_number' => 'required | digits:10',
            'aadhaar_number' => 'required | digits:12',
            'profile_pic' => 'required',
        ], [
            'first_name.required' => '* First Name is Required',
            'last_name.required' => '* Last Name is Required',
            'email.required' => '* Email is Required',
            'email.email' => '* Invalid Email Format',
            'email.unique' => '* Email is Already Taken',
            'dob.required' => '* Date of Birth is Required',
            'dob.date' => '* Date of has to be a date',
            'mobile_number.required' => '* Mobile Number is Required',
            'aadhaar_number.required' => '* Aadhaar Number is Required',
            'aadhaar_number.digits' => '* Aadhaar Number should have length of 12 digits',
            'profile_pic.required' => '* Profile Picture is Required',
        ]);

        if ($request->type == false && $validator->fails()) {  
            $validator->errors()->add('type', '* Type is Required');
            return response()->json($validator->messages(), 400);
        } 
        else if ($request->gender == false && $validator->fails()) {  
            $validator->errors()->add('gender', '* Gender is Required');
            return redirect()->back()->withErrors($validator->messages())->withInput();
        } 
        else if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }
        // Generating password and sending over the mail to member
        $password = generate_password();
        $details = [
            'title' => 'SMS Member Credentials',
            'body' => 'Welcome '.$request->first.' to SMS<br>Below are your credentials for login to SMS Member Portal<br>Email: '.$request->email.' <br>Password: '.$password,
        ];
        \Mail::to($request->email)->send(new MemberCredentials($details));
        // Move profile_pic to folder and rename it
        $profile_pic = $request->file('profile_pic');
        $profile_pic_name = 'profile_pic_'.time().'.'.$profile_pic->getClientOriginalExtension();
        $profile_pic->move(base_path('assets/images'), $profile_pic_name);
        // Adding Member to users table
        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->dob = $request->dob;
        $user->mobile_number = $request->mobile_number;
        $user->aadhaar_number = $request->aadhaar_number;
        $user->role = 'member';
        $user->profile_pic = $profile_pic_name;
        $user->type = $request->type;
        $user->society_id = session('society_id');
        $user->created_at = now();
        $saved = $user->save();
        // Check if model got saved or not
        if (!$saved) {
            return response()->json(['message' => 'Something went wrong at server'], 500);
        }
        return response()->json(['message' => 'Member saved and password sent to email successfully. Please refresh page to view saved member.'], 200);
    }

    public function move(Request $request) {
        User::where('id', $request->id)->update([
            'status' => 0,
        ]);
        session()->flash('success', 'Member moved successfully.');
        return redirect()->route('members');
    }
    public function restore(Request $request) {
        User::where('id', $request->id)->update([
            'status' => 1,
        ]);
        session()->flash('success', 'Member restored successfully.');
        return redirect()->route('members.history');
    }
    public function profile($id) {
        $data = [
            'user' => User::where('id', $id)->first(),
        ];
        return view('sms.pages.members.profile', compact('data'));
    }
}
