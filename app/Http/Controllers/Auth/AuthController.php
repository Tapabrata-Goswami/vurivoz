<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\Admin;

class AuthController extends Controller
{
    // Admin Login
    public function AdminLoginView(){
        return view('auth.adminLogin');
    }

    public function AdminLoginPost(Request $request){
        dd($request);
    }

    // Admin Sign
    public function AdminSigninView(){
        return view('auth.adminSignin');
    }

    public function AdminSigninPost(Request $request){

        $rules = [
            'username' => ['required', 'string', 'alpha_dash', 'min:3', 'max:15'],
            'email' => ['required', 'email', 'max:255',],
            'password' => ['required', 'string', 'min:8'],
        ];
    
        // Define custom messages
        $messages = [
            'username.required' => 'The username is required.',
            'username.alpha_dash' => 'The username may only contain letters, numbers, dashes, and underscores.',
            'username.unique' => 'The username has already been taken.',
            'email.required' => 'An email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'The email address is already registered.',
            'password.required' => 'A password is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }
        
        // Check if the email already exists
        $existingEmail = Admin::where('email', $request->email)->first();
        if ($existingEmail) {
            return redirect()->back()->withErrors([
                'email' => 'The email address is already registered.',
            ])->withInput();
        }

        // Check if the username already exists
        $existingUsername = Admin::where('username', $request->username)->first();
        if ($existingUsername) {
            return redirect()->back()->withErrors([
                'username' => 'The username has already been taken.',
            ])->withInput();
        }

        // Create the new admin
        $admin = new Admin();
        $admin->username = $request->input('username');
        $admin->email = $request->input('email');
        $admin->password = Hash::make($request->input('password'));
        $admin->verification_code = rand(100000, 999999);

        // Send om mail this verification code --

        // Save the admin to the database
        $admin->save();

        return redirect()->route('OtpValidateView')->with('success', 'Verification code sent successfully!');
    }

    public function OtpValidateView(){
        return view('auth.adminOtp');
    }


    public function OtpValidatePost(Request $request){

        $rules = [
            'otp' => ['required'],
        ];
    
        // Define custom messages
        $messages = [
            'otp.required' => 'Enter a valid Otp.',
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        $admin = Admin::where('verification_code', $request->otp)->first();

        if($admin){

            $admin->status = 1;
            $admin->email_verification = 1;
            $admin->save();

            return redirect()->route('AdminDashboard')->with('success', 'Verification code sent successfully!');
        }else{
            return redirect()->back()->withErrors([
                'otp' => 'Otp does not match.',
            ])->withInput();
        }


    }


    
}
