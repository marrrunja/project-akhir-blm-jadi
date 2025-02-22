<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response as Re;
use Symfony\Component\HttpFoundation\Response;

class RegisterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    private function emptyInputUser($username, $password, $email):bool
    {
        return empty($username) || empty($password) || empty($email);
    }
    public function handle(Request $request, Closure $next)
    {
        $emailUser = User::where('email', $request->email)->get();
        if(count($emailUser) > 0){
            return redirect('/register')->with('error', 'Email sudah ada, harap masukkan email yang lain');
        }
        if($this->emptyInputUser($request->nama, $request->password, $request->email)){
            return redirect('/register')->with('error', 'inputan tidak boleh kosong');
        }
        return $next($request);
    }
}
