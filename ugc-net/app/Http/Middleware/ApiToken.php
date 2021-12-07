<?php

namespace App\Http\Middleware;

use Closure;
use App\ApiUser;

class ApiToken
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
        //print_r($request->header('Authorization'));die;
        // if ($request->header('Authorization') != Bearer.' '.env('API_KEY')) {
        //     return response()->json('Unauthorized', 401);
        // } 

        
       // print_r($token_exists);die;
        
        if($request->header('Authorization'))
        {
            $auth_token=$request->header('Authorization');
            $auth_token=explode(" ",$auth_token);
    
            $token_exists=ApiUser::where('api_token',$auth_token[1])->first();
            
            //dd($token_exists); 
            if($token_exists){
                return $next($request);
            }
            else{
                return response()->json([
                    'status'=>401,
                    'message' => 'Invalid Token.',
                ]);
            }
          }
        return response()->json([
            'message' => 'Not a valid API request.',
        ]);
    }
}
