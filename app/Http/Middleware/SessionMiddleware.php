<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SessionMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if(Session::has('isLogin'))
        {
            return redirect('/news');
        }
        return $next($request);
    }
}
