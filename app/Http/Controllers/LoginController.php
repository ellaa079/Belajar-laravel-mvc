<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function halamanlogin(){
        return view('Login.login-aplikasi');
    }
       
    public function postlogin(Request $request)
    {
        // Check if the email and password provided in the request are valid
        if (Auth::attempt($request->only('email', 'password'))) {
            // If authentication is successful, redirect the user to the 'beranda' route
            return redirect()->route('beranda');
        }
        // If authentication fails, redirect the user back to the login page with an error message
        return redirect()->route('login')->with('error', 'Email atau password salah');
    }
    
    
    public function logout (){
       Auth::logout();
       return redirect ('/');
    }


}
