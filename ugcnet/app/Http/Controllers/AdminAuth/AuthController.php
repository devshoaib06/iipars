<?php

namespace App\Http\Controllers\AdminAuth;

use App\Admin;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;

class AuthController extends Controller {

    public function showLoginForm() {
        
        if (Auth::guard('admins')->check()) {
            return redirect()->intended('admin');
        } else {
            return view('admin/auth/login');
           //return view('web.pages.provider.profile_setup', $data_msg);
        }
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post'))
        {
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
                    ->whereIn('user_type_id', ['1','6'])
                    //->where('status', '=', '1')
                    ->first();

            //if (Auth::guard('admins')->attempt(['email' => $username, 'password' => $password, 'user_type_id' => '1'], $remember)) {

            if (!empty($adminUserLogin))
            {
    
             Auth::guard('admins')->login($adminUserLogin);
                    //$admin_id = Auth::guard('admins')->user()->id;
    
    
                /*$adminUserLogin = Admin::where('email', '=', $username)
                        ->where('password', '=', $password)
                        ->whereIn('user_type_id', ['1','2'])
                        //->where('status', '=', '1')
                        ->first();*/
    
                //if (!empty($adminUserLogin)) {
                    //echo 'AC';die;
                    //Auth::guard('admins')->login($adminUserLogin);
                   // $admin_id = Auth::guard('admins')->user()->id;
    
                    /*$current_login = Auth::guard('admins')->user()->current_login;
    
                    $update_data = array(
                        'current_login' => date('Y-m-d H:i:s'),
                        'last_login' => $current_login,
                    );
                    $adminDetails = Admin::find($admin_id);
                    //dd($adminDetails);
                    $adminDetails->update($update_data);
    
                    */
    
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
            }
            else {
                    $request->session()->flash('message', 'Invalid username or password. !');
                    return redirect()->intended('admin/login');
                }
        }
    }

    public function logout() {
        Auth::guard('admins')->logout();
        //Auth::logout();
        //Session::flush();
        return redirect()->intended('admin/login');
    }

}
