<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){
        return view('sign-in');
    }
    public function redirectToNews(Request $request){
        return redirect()->route('news');
    }
    public function logout(Request $request){
        $request->session()->invalidate();
        return redirect('/');
    }
}
