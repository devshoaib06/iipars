<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class StudentApiAuth
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
        
        
        // if($request->has('login_token'))
        // {
        //     $login_token=$request->login_token;
        //     $token_exists=User::where('api_token',$login_token)->first();
        //     if($token_exists){
        //         return $next($request);
        //     }
        //     else{
        //         return response()->json([
        //             'status'=>401,
        //             'message' => 'Invalid login token.',
        //         ]);
        //     }
        // }
        if($request->has('logged_in_user_id') && $request->logged_in_user_id>0)
        {
            $logged_in_user_id=$request->logged_in_user_id;
            $token_exists=User::where('logged_in_user',$logged_in_user_id)->first();
            if($token_exists){
                return $next($request);
            }
            else{
                return response()->json([
                    'status'=>401,
                    'message' => 'Invalid user.',
                ]);
            }
        }
        return response()->json([
            'status'=>0,
            'message' => 'Invalid user.',
        ]);
    }
}
