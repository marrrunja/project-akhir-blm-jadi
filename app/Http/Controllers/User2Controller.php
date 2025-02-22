<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class User2Controller extends Controller
{
    public function checkSession()
    {
        // Ambil session user
        $user = Session::get('user');

        if ($user) {
            return response()->json([
                'message' => 'User is logged in',
            ]);
        }

        return response()->json([
            'message' => 'No user session found'
        ]);
    }
}
