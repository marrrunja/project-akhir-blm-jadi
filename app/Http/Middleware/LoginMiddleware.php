<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class LoginMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    private function emptyInputUser($nama, $password):bool
    {
        return empty($nama) || empty($password);
    }
    public function handle(Request $request, Closure $next): Response
    {
        // periksa apakah inputan user kosong
        if($this->emptyInputUser($request->email, $request->password)){
            return redirect('/login')->with('error', 'Inputan tidak boleh ada yang kosong!!');
        }
        // periksa apakah emailnya ada di database
        $email = User::where('email', $request->email)->get();
        if(count($email) > 0){
            // cek passwordnya
            if(Hash::check($request->password, $email->first()->password)){
                $request->session()->put('isLogin', true);
                $request->session()->put('email', $email->first()->email);
                $request->session()->put('nama', $email->first()->nama);
                $request->session()->put('id', $email->first()->id);
                return $next($request);         
            } else{
                return redirect('/login')->with('error', 'password salah');
            }
        } else {
            return redirect('/login')->with('error', 'Email tidak terdaftar');
        }
    }
}
