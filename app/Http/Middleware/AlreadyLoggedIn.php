<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AlreadyLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('LoggedUser')/*  && (url('loginform') == $request->url() ||
         url('signupform') == $request->url()) */) {

           // return redirect('seller');

             return back();
        }
        return $next($request);
    }
}
