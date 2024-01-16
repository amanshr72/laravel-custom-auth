<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserCredentialRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    public function showLoginForm(){
        return view('login');
    }

    public function showRegistrationForm(){
        return view('register');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }else{
            return back()->with('error', 'Whops, Invalid email and password');
        }
    }

    public function register(StoreUserCredentialRequest $request){   
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        
        Auth::login($user); // Get user log in after registration
        return view('dashboard');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
