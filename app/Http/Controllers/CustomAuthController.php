<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserCredentialRequest;
use App\Models\User;
use App\Models\ApiToken;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
            
            $apiToken = Str::random(60);
            
            Session::put('apiToken', $apiToken);
            
            ApiToken::create([
                'user_id' => auth()->id(),
                'token' => hash('sha256', $apiToken),
            ]);

            return view('dashboard', compact('apiToken'));
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
        return redirect('login');
    }
}
