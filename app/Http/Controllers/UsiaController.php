<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Middleware\ValidateUsia;

class UsiaController extends Controller
{
    public function __construct()
    {
        $this->middleware(ValidateUsia::class);
    }
    public function store(Request $request){
        $umur = $request->input('umur');
        return $umur;
    }
}
