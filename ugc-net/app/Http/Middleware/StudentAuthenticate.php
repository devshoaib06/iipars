<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class StudentAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //dd(auth()->user());
        if(auth()->user()){

            if(auth()->user()->user_type_id == 2 || auth()->user()->user_type_id == 1){
                return $next($request);
            }
        }
            return redirect('home')->with('error','You have not admin access');
    }
}
