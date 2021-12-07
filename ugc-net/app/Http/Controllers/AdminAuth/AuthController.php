<?php

namespace App\Http\Controllers\AdminAuth;

use App\Admin;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        // (Auth::loginUsingId([1]))
        // $user=Auth::loginUsingId([1]);
        // Auth::guard('admins')->login($user);
        if (Auth::guard('admins')->check()) {
            return redirect()->intended('admin');
        } else {
            return view('admin/auth/login');
            //return view('web.pages.provider.profile_setup', $data_msg);
        }
    }
    public function adminloginIIPARS(Request $request)
    {
        $data = $request->all();
        $data['email']='contact@teachinns.com';
        $adminUserLogin = Admin::where('email', '=', $data['email'])
            //->where('password', '=', $md5_password)
            ->whereIn('user_type_id', ['1', '6'])
            ->first();
        Session::put('iipars_admin_id', $data['user_id']);
        if(Auth::loginUsingId($adminUserLogin->id, TRUE)){
            //$user=Auth::loginUsingId([1]);
            Auth::guard('admins')->login($adminUserLogin);
            return;
        }else{
           return false;
        }    
        
    }

    public function login(Request $request)
    {
        
        if ($request->isMethod('post')) {
            $username = $request->input('username');
            $cookie_pwd = trim($request->input('password'));
            $password = trim($request->input('password'));
            $remember_me = $request->input('remember_me');
            $md5_password = md5(trim($request->input('password')));
            $remember = false;
            if ($remember_me == '1') {
                $remember = true;
            }
            $adminUserLogin = Admin::where('email', '=', $username)
                ->where('password', '=', $md5_password)
                ->whereIn('user_type_id', ['1', '6'])
                ->first();

            //if (Auth::guard('admins')->attempt(['email' => $username, 'password' => $password, 'user_type_id' => '1'], $remember)) {

            if (!empty($adminUserLogin)) {

                Auth::guard('admins')->login($adminUserLogin);

                if ($remember_me) {
                    setcookie("teachinns_username", $username, time() + (86400 * 30));
                    setcookie("teachinns_password", $cookie_pwd, time() + (86400 * 30));
                } else {
                    unset($_COOKIE['teachinns_username']);
                    unset($_COOKIE['teachinns_password']);
                    setcookie("teachinns_username", '', time() - 3600);
                    setcookie("teachinns_password", '', time() - 3600);
                }
                return redirect()->intended('admin');
            } else {
                $request->session()->flash('message', 'Invalid username or password. !');
                return redirect()->intended('admin/login');
            }
        }
    }

    public function logout()
    {
        $url=config('path.iipars_admin_base_url')."/index.php/admin_login/logout";
        Auth::guard('admins')->logout();
        Session::flush();        
        
        // return redirect()->intended('admin/login');
        return redirect($url);
    }
}
