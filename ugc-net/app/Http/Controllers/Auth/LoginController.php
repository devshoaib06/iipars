<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request) {
        $request->session()->forget('buy_course_id');
        $request->session()->forget('reseller_code');


        $request->session()->flush();
        Auth::logout();
        return redirect()->intended(route('home'));

    }

  
    public function login(Request $request)
    {
        $data = $request->all();
        //dd($request->header('referer'));
        $this->validate($request, ['email' => 'required', 'password' => 'required']);

        $user = User::where('email', '=', $data['email'])
            ->where('password', '=', md5($data['password']))
            ->whereIn('user_type_id',['2'])
            ->first();
        if($user){
                //return $user;
            if($user->user_type_id!=1){

                if ($user->status==1) {
                    // dd($request->session());
                    // print_r($request->session()->has('mock_test_login'));die;
                    Auth::login($user);
                    $redirecturl='';
                    if($user->user_type_id==2){
                        if($request->session()->has('buy_course_id')){
                        
                            $redirecturl=route('billing');
                        }else if($request->session()->has('mock_test_login')){
                            $redirecturl=route('showInstruction');
                        }
                        else{

                            $redirecturl=$request->header('referer');
                        }
                    }
                    
                    if ($request->has('remberme')) {
                        setcookie("techinns_web_username", $data['email'], time() + (86400 * 30));
                        setcookie("techinns_web_password", $data['password'], time() + (86400 * 30));
                    } else {
                        unset($_COOKIE['techinns_web_username']);
                        unset($_COOKIE['techinns_web_password']);
                        setcookie("techinns_web_username", '', time() - 3600);
                        setcookie("techinns_web_password", '', time() - 3600);
                    }
                        return response()->json([
                            'status'  => true,
                            'userObj' => $user,
                            'redirecturl'=>$redirecturl
                        ]);
                   
                } 
                elseif ($user->status==0) {
                    return response()->json([
                        'status' => false,
                        'msg'    => 'Your Account has been blocked.',
                    ]);
                }
            }else {
                return response()->json([
                    'status' => false,
                    'msg'    => 'Invalid username or password',
                ]);
            }
            
        }else {
            return response()->json([
                'status' => false,
                'msg'    => 'Invalid username or password',
            ]);
        }
    }
}
