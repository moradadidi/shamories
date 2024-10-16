<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function show(){
        return view('login.show');
    }
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $login = $request->email;
        $password = $request->password;
        $values = ['email' => $login, 'password' => $password];
    
        if (Auth::attempt($values)) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Welcome to your profile');;
        } else {
            return back()->withErrors([
                'email' => 'Email or password is invalid.',
            ])->onlyInput('email');
        }
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect('/login');
    }
    
}
