<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserCredentialRequest;
use App\Mail\ForgetPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use Exception;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{   
    public function showForgetPasswordForm(){
        return view('password.forget_password');
    }

    public function showResetPasswordForm($token) { 
        return view('password.reset_password', ['token' => $token]);
    }

    public function sendForgetPasswordLink(Request $request){
        try{
            $request->validate([
                'email' => 'required|email|exists:users',
            ]);
            
            $token = Str::random(64);
            
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email, 
                'token' => $token, 
                'created_at' => now()
            ]);

            Mail::to($request->email)->send(new ForgetPasswordMail($token));
            
            return back()->with('success', 'We have e-mailed your password reset link!, Please check your email.');
        }catch(Exception $e){
            if($e->getCode() == 23000){
                return back()->with('error', 'An password rest link is already send to this email. Please try again later.');
            }
            return back()->with('error', 'Whoops, Invalid email. Please try again later.');
        }
    }

    public function forgetPassword(UpdateUserCredentialRequest $request){
        $updatePassword = DB::table('password_reset_tokens')->where(['email' => $request->email, 'token' => $request->token])->first();

        if(!$updatePassword){
            return back()->withErrors(['error' => 'Whoops, Invalid token, Please try again.']);
        }

        User::where('email', $request->email)->update(['password' => bcrypt($request->password)]);

        DB::table('password_reset_tokens')->where(['email'=> $request->email])->delete();

        return redirect()->route('login')->with('success', 'Password updated successfully');
    }
}
