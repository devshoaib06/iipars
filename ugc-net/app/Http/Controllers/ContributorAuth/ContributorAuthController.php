<?php

namespace App\Http\Controllers\ContributorAuth;

use App\Admin;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;
use View;
use App\User;

class ContributorAuthController extends Controller {

    public function __construct() 
	{
        $shareData = array();
        
        $mainMenu = \App\Product::select('name','product_id','slug')->where('status', '=', '1')->orderBy('name', 'asc')->get();
        $exams = \App\ExamMaster::select('exam_name','id')->where('status', '=', '1')->orderBy('id', 'asc')->get();
        $combo_pack_products = \App\Product::select('product_id','name','slug')
                        ->where(['status' => '1',
                                'is_combo'=>1
                        ])
                        ->orderBy('name', 'asc')
                        ->get();
        $floatersignup=\App\FloaterSignUpMaster::where('status',1)->first();   
        $shareData['floatersignup'] = $floatersignup;
        $newsfeed=\App\NewsFeedMaster::where('status',1)->get();                
        $articles_cat=\App\ArticleCategory::where('status',1)->get();                
        $shareData['articlecats'] = $articles_cat;   
        $shareData['newsfeed'] = $newsfeed;
        $shareData['combo_pack_products'] = $combo_pack_products;
        $shareData['mainMenu'] = $mainMenu;
        $shareData['exams'] = $exams;
        
        
        View::share($shareData);
	}

    public function showLoginForm() {
        
        if (Auth::guard('contributors')->check()) {
            return redirect()->intended('contributors');
        }elseif(Auth::check()){
            return back();
        } 
        else {
        $meta_array['meta_title']='Contributor Login | Teachinns';
        $meta_array['meta_desc']='At Teachinns, we welcome back our regular ontributors! Keep on writing for CSIR UGC NET/SET/JRF study material.';
        $meta_array['meta_keyword']='Teachinns';
        $meta_array['meta_robots']='Teachinns';
        
        $DataBag['page_metadata'] = (object)$meta_array;
            return view('frontend/contributor/auth/register-login',$DataBag);
           //return view('web.pages.provider.profile_setup', $data_msg);
        }
    }
    public function showForgotPasswordForm() {
        
        if (Auth::guard('contributors')->check()) {
            return redirect()->intended('contributors');
        } else {
            $meta_array['meta_title']='Contributor Forgot Password | Teachinns';
            $meta_array['meta_desc']='Passwords are not easy to remember. So, if you are a study material contributor and have forgotten your password, we are making things easier for you!';
            $meta_array['meta_keyword']='Teachinns';
            $meta_array['meta_robots']='Teachinns';
            
            $DataBag['page_metadata'] = (object)$meta_array;
            return view('frontend/contributor/auth/forgot-password',$DataBag);
           //return view('web.pages.provider.profile_setup', $data_msg);
        }
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $username = $request->input('email');
            $cookie_pwd = trim($request->input('password'));
            $password = trim($request->input('password'));
            $remember_me = $request->input('remember_me');
            $md5_password = md5(trim($request->input('password')));
            $remember = false;
            if ($remember_me == '1') {
                $remember = true;
            }
             $contributorUserLogin = User::where('email', '=', $username)
                    ->where('password', '=', $md5_password)
                    ->whereIn('user_type_id',['3'])
                    ->first();

            
            if (!empty($contributorUserLogin))
            {
    
             Auth::guard('contributors')->login($contributorUserLogin);
             Auth::login($contributorUserLogin);
                   
    
                if ($remember_me) {
                    setcookie("teachinns_username", $username, time() + (86400 * 30));
                    setcookie("teachinns_password", $cookie_pwd, time() + (86400 * 30));
                } else {
                    unset($_COOKIE['teachinns_username']);
                    unset($_COOKIE['teachinns_password']);
                    setcookie("teachinns_username", '', time() - 3600);
                    setcookie("teachinns_password", '', time() - 3600);
                }
                return redirect()->intended('contributor');
            }
            else {
                $request->session()->flash('messageClass', 'alert alert-danger');
                $request->session()->flash('message', 'Invalid username or password');
                
                return redirect()->intended(route('contributorlogin'))->with('messageClass', 'alert alert-danger')
                                ->with('message', 'Invalid username or password')->withInput();
                    
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
