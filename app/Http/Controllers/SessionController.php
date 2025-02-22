<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function createSession(Request $request):string{
        $request->session()->put('user', 'irfan');
        $request->session()->put('isMember', 'true');
        return "Ok";
    }
    public function getSession(Request $request){
        echo $request->session()->get('user');
    }
    public function logout(Request $request){
        $request->session()->invalidate();
        return view('session-view');
    }
}
