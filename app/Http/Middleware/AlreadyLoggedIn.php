<?php

namespace App\Http\Middleware;

use App\Models\User;
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
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            if ($user->user_role == 'Seller' || $user->user_role == 'Trainer') {
                return redirect('dashboard');
            } else if ($user->user_role == 'Buyer') {
                return redirect('hiredirect');
            }
            else{
                return redirect('courses');
            }
        }
        return $next($request);
    }
}
