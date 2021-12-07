<?php

namespace App\Http\Controllers\ResellerAuth;

use App\Admin;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;
use View;
use App\User;
use App\Distributor;
use App\UserBankDetail;
use Str;
use Mail;
use DB;

class ResellerAuthController extends Controller {

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

        $newsfeed=\App\NewsFeedMaster::where('status',1)->get();                
        $articles_cat=\App\ArticleCategory::where('status',1)->get();                
        $floatersignup=\App\FloaterSignUpMaster::where('status',1)->first();   
        $shareData['floatersignup'] = $floatersignup;
        $shareData['articlecats'] = $articles_cat;   
        $shareData['newsfeed'] = $newsfeed;
        $shareData['combo_pack_products'] = $combo_pack_products;
        $shareData['mainMenu'] = $mainMenu;
        $shareData['exams'] = $exams;
        
        
        View::share($shareData);
	}

    public function showLoginForm() {
        
        if (Auth::guard('resellers')->check()) {
            return redirect()->intended('reseller');
        }elseif(Auth::check()){
            return back();
        } 
        else {
            $meta_array['meta_title']='Reseller Login | Teachinns';
            $meta_array['meta_desc']='We welcome back our resellers to keep on spreading the word about our practice-oriented CSIR UGC NET/SET/JRF study materials.';
            $meta_array['meta_keyword']='Teachinns';
            $meta_array['meta_robots']='Teachinns';
            $DataBag['page_metadata'] = (object)$meta_array;
            
            return view('frontend.reseller.auth.login',$DataBag);
           //return view('web.pages.provider.profile_setup', $data_msg);
        }
    }
    public function showForgotPasswordForm() {
        
        if (Auth::guard('resellers')->check()) {
            return redirect()->intended('resellers');
        } else {
            $meta_array['meta_title']='Reseller Forgot Password | Teachinns';
            $meta_array['meta_desc']='Teachinns';
            $meta_array['meta_keyword']='Teachinns';
            $meta_array['meta_robots']='Teachinns';
            $DataBag['page_metadata'] = (object)$meta_array;
            
            
            return view('frontend.reseller.auth.forgot-password',$DataBag);
           //return view('web.pages.provider.profile_setup', $data_msg);
        }
    }

    public function changePassword() {
        $data_msg = array();
        if (Auth::check()) {   
            $meta_array['meta_title']='Teachinns-Change Password';
            $meta_array['meta_desc']='Teachinns';
            $meta_array['meta_keyword']='Teachinns';
            $meta_array['meta_robots']='Teachinns';
            $DataBag['page_metadata'] = (object)$meta_array;         
            return view('frontend.reseller.changePassword', $data_msg);
            
        } else {
            return redirect()->route('loginAction');
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
             $resellerUserLogin = User::where('email', '=', $username)
                    ->where('password', '=', $md5_password)
                    ->whereIn('user_type_id',['4'])
                    //->where('status', '=', '1')
                    ->first();

            // echo "<pre>";
            // print_r($resellerUserLogin);die;
            if (!empty($resellerUserLogin))
            {
    
             Auth::guard('resellers')->login($resellerUserLogin);
             Auth::login($resellerUserLogin);
            
    
                    if ($remember_me) {
                        setcookie("teachinns_username", $username, time() + (86400 * 30));
                        setcookie("teachinns_password", $cookie_pwd, time() + (86400 * 30));
                    } else {
                        unset($_COOKIE['teachinns_username']);
                        unset($_COOKIE['teachinns_password']);
                        setcookie("teachinns_username", '', time() - 3600);
                        setcookie("teachinns_password", '', time() - 3600);
                    }
                    return redirect()->intended(route('resellerdashboard'));
            }
            else {
                $request->session()->flash('messageClass', 'alert alert-danger');
                $request->session()->flash('message', 'Invalid username or password');
                
                return redirect()->intended(route('resellerlogin'))->with('messageClass', 'alert alert-danger')
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
    public function signUp($value='')
    {
        //return  \Session::get('buy_course_id');
        $DataBag = $meta_array = array();
        $meta_array['meta_title']='Reseller Sign Up | Teachinns';
        $meta_array['meta_desc']='Teachinns - Sign Up';
        $meta_array['meta_keyword']='Teachinns';
        $meta_array['meta_robots']='Teachinns';
        $DataBag['page_metadata'] = (object)$meta_array;
        
        
        return view('frontend.reseller.auth.sign-up',$DataBag);
    }

    public function signupAction(Request $request)
    {
        
       
        try{

        //return \Session::get('buy_course_id');    
        $user_type=\App\UserType::where('name','Reseller')->first();

        $name = $request->input('first_name').' '.$request->input('last_name');
                $email = $request->input('email');
                $password = $request->input('password');
                $user_type_id = $user_type->id;
                $status = $request->input('status')?$request->input('status'):1;
                $is_approved =1;
	
                
                $first_name = $request->input('first_name');
                $last_name = $request->input('last_name');
                $contactnumber = $request->input('phone');
                // $gender = $request->input('gender');
                // $address = $request->input('address');
                // $country_id = $request->input('country');
                // $commission = $request->input('commission');
                $reseller_code = strtoupper($this->generateBarcodeNumber());
                $ip_address = $request->ip();
                //echo $reseller_code;die;
                $ac_holder_name = $request->input('ac_holder_name');
                $account_number = $request->input('account_number');
                $bank_name = $request->input('bank_name');
                $bank_branch = $request->input('bank_branch');
                $ifsc_code = $request->input('ifsc_code');
                $g_recaptcha_response = $request->input('g-recaptcha-response');

               
    
               
				
                $data_user_details = array(					
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'g-recaptcha-response' => $g_recaptcha_response,
                    'email' => $email,
                    'password' => md5($password),
                );

				
                $validator = $this->validatorRegisterGeneral($data_user_details);
                
                if ($validator->fails()) {
                    $val = $validator->errors();
                    //dd($val);
                    return redirect()->intended(route('reseller-sign-up'))->withErrors($val)->withInput();
                }

				$data_user_details = array(
                    'name' => $name,
                    'email' => $email,
                    'password' => md5($password),
                    'user_type_id'=>$user_type_id,
                    'status' => $status,
                    'is_approved' => $is_approved,
                  
                );
				
				
                DB::beginTransaction();
                $user_info=User::create($data_user_details);
                //print_r($user_info);die;
				$user_id=$user_info->id;
                if($user_id){
                    $distributor_details=array(
                        'user_id'=>$user_id,
                        'firstname'=>$first_name,
                        'lastname'=>$last_name,
                        'contactnumber'=>$contactnumber,
                        'reseller_code'=>$reseller_code,
                        'ip_address'=>$ip_address,
                    );
                    $reseller_bank_details=array(
                        'user_id'=>$user_id,
                        'ac_holder_name'=>$ac_holder_name,
                        'account_number'=>$account_number,
                        'bank_name'=>$bank_name,
                        'bank_branch'=>$bank_branch,
                        'ifsc_code'=>$ifsc_code
             
                    );
                    $user = Distributor::create($distributor_details);
                    UserBankDetail::create($reseller_bank_details);
                }
                DB::commit();
                Auth::guard('resellers')->login($user_info);
                Auth::loginUsingId($user_id);
        
        
        $this->sendWelcomeMail($email,$password,$first_name);

        return redirect()->intended(route('resellerdashboard'))->with('messageClass', 'alert alert-success')
                                ->with('message', 'Student successfully added');

        }catch (\Exception $e) {
            DB::rollback();
            return redirect()->intended(route('reseller-sign-up'))
            ->withErrors($e->getMessage())->withInput();
        }

    }

    

    public function sendWelcomeMail($email,$password,$first_name)
    {
        try{

            $temp_data = \App\EmailTemplates::where(['mail_id'=>'welcome_email'])->first();
            $template_data = $temp_data;
         
            
    
    
            $content = $template_data->content;
            $content = str_replace("{{first_name}}", $first_name, $content);
            $content = str_replace("{{email}}", $email, $content);
            $content = str_replace("{{password}}", $password, $content);
           
    
            $emailData = array();
            $emailData['subject'] = trim($template_data->subject);
            $emailData['body'] = trim($content);
            $emailData['to_email'] = $email;
            $emailData['from_email'] = trim(getSettings('from_email'));
            $emailData['from_name'] = trim(getSettings('from_name'));
            //echo "<pre>"; print_r($emailData); die;
    
            Mail::send('frontend.emails.order', ['emailData' => $emailData], function ($message) use ($emailData) {
    
                    $message->from($emailData['from_email'], $emailData['from_name']);
    
                    $message->to($emailData['to_email'])->subject($emailData['subject']);
                    //$message->to('moutusi@karmicksolutions.com')->subject($emailData['subject']);
            });
        }catch (\Exception $e){
            return redirect()->intended(route('sign-up'))
            ->withErrors($e->getMessage())->withInput();
        }


            
    }

    protected function validatorRegisterGeneral(array $data) {
        
        $validate = [
            'first_name' => 'required|max:20|min:3',
            'last_name' => 'required|max:20|min:3',
            // 'country_id' => 'required',
            // 'sex' => 'required',
            // 'address' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'g-recaptcha-response' => 'required|captcha'

        ];

        return Validator::make($data, $validate);
    }

    function generateBarcodeNumber() {
        //$number = mt_rand(1000000000, 9999999999); // better than rand()
        $number = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 6);;// better than rand()
    
        // call the same function if the barcode exists already
        if ($this->barcodeNumberExists($number)) {
            return $this->generateBarcodeNumber();
        }
    
        // otherwise, it's valid and can be used
        return $number;
    }
    
    function barcodeNumberExists($number) {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return Distributor::where('reseller_code',$number)->exists();
    }

}
