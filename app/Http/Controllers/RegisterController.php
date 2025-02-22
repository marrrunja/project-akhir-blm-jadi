<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use App\Http\Middleware\SessionMiddleware;

class RegisterController extends Controller
{
    public function redirectRegister(){
        return view('sign-up');
    }
    public function store(Request $request){
        $nama = $request->input('nama');
        $password = $request->input('password');
        $email = $request->input('email');
       
        User::create([
            "nama" => $nama,
            "email" => $email,
            "password" => $password
        ]);
        return redirect('/register')->with('status', 'register berhasil, silahkan login');
    }
}
