<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\UserType;
use App\Student;
use App\Product;
use App\ExamMaster;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;
use View;
use DB;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $shareData = array();
        
		$mainMenu = Product::select('product_id','name','slug')->where('status', '=', '1')->orderBy('name', 'asc')->get();
        $exams = ExamMaster::select('exam_name','id')->where('status', '=', '1')->orderBy('id', 'asc')->get();
        $combo_pack_products = Product::select('product_id','name','slug')
                        ->where(['status' => '1',
                                'is_combo'=>1
                        ])
                        ->orderBy('name', 'asc')
                        ->get();
        $newsfeed=\App\NewsFeedMaster::where('status',1)->get();     
        $articles_cat=\App\ArticleCategory::where('status',1)->get();                
        $shareData['articlecats'] = $articles_cat;     
        
        $floatersignup=\App\FloaterSignUpMaster::where('status',1)->first();   
        $shareData['floatersignup'] = $floatersignup;

        $shareData['newsfeed'] = $newsfeed;
        $shareData['combo_pack_products'] = $combo_pack_products;
        $shareData['mainMenu'] = $mainMenu;
        $shareData['exams'] = $exams;
        
        View::share($shareData);
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorRegisterGeneral(array $data) {
        //dd($data);
        $validate = [
            
            'email' => 'required|email|max:255|unique:users',
            //'password' => 'required|min:6',
            //'g-recaptcha-response' => 'required|captcha'
        ];

        return Validator::make($data, $validate);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function signupAction(Request $request)
    {
        //return $request;
        try{
            
            //return \Session::get('buy_course_id');    
            $user_type=UserType::where('name','Student')->first();
            
            $name = $request->input('first_name').' '.$request->input('last_name');
            $email = $request->input('email');
            $password = $request->input('password');
            $user_type_id = $user_type->id;
            $status = 1;
            $is_approved =1;
            
            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $contactnumber = $request->input('contactnumber');
            $g_recaptcha_response = $request->input('g-recaptcha-response');
            $ip_address = $request->ip();

            $data_user_details = array(
                'name' => $name,
                'email' => $email,
                'g-recaptcha-response' => $g_recaptcha_response
            );
            $validator = $this->validatorRegisterGeneral($data_user_details);


            
           
                
        if ($validator->fails()) {
            $val = $validator->errors();
            //dd($val);
            //return redirect()->intended(config("constants.admin_prefix") . '/' . 'student/create')->withErrors($val)->withInput();
            return back()->withErrors($val)->withInput();
        }

        $data_user_details = array(
                'name' => $name,
                'email' => $email,
                'password' => md5($password),
                'user_type_id'=>$user_type_id,
                'status' => $status,
                'is_approved' => $is_approved,
        );
        //DB::beginTransaction();
       
        $user_id=User::create($data_user_details)->id;
        if($user_id){
                $student_details=array(
                    'user_id'=>$user_id,
                    'firstname'=>$first_name,
                    'lastname'=>$last_name,
                    'contactnumber'=>$contactnumber,
                    'ip_address'=>$ip_address,

                );
            $user = Student::create($student_details);
        }
        Auth::loginUsingId($user_id);
        //echo $request->session()->has('buy_course_id');die;
        if($request->session()->has('buy_course_id')){
            $product_id= \Session::get('buy_course_id');
            //echo $product_id;die;                
            return redirect()->route('billing');
        }
        if($request->session()->has('mock_test_login')){
            return redirect()->route('showInstruction');
        }

        $this->sendWelcomeMail($email,$password,$first_name);

        return redirect()->intended(route('home'))->with('messageClass', 'alert alert-success')
                                ->with('message', 'Student successfully added');

        }catch (\Exception $e) {
            DB::rollback();
            return redirect()->intended(route('sign-up'))
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

    public function signUp($value='')
    {
        //return  \Session::get('buy_course_id');
        $DataBag = $meta_array = array();
        $meta_array['meta_title']='Sign Up | '.env('APP_NAME','IIPARS');
        $meta_array['meta_desc']='Register with us and make the most of our valuable study materials for your CSIR UGC NET/SET/JRF exam preparation.';
        $meta_array['meta_keyword']=env('APP_NAME','IIPARS').' - Sign Up';
        $meta_array['meta_robots']='noindex';
        
        $DataBag['page_metadata'] = (object)$meta_array;
        return view('frontend.auth.register',$DataBag);
    }
    public function login($value='')
    {
        //return  \Session::get('buy_course_id');
        $DataBag = $meta_array = array();
        $meta_array['meta_title']='Sign In | '.env('APP_NAME','IIPARS');
        $meta_array['meta_desc']='Register with us and make the most of our valuable study materials for your CSIR UGC NET/SET/JRF exam preparation.';
        $meta_array['meta_keyword']=env('APP_NAME','IIPARS').' - Sign In';
        $meta_array['meta_robots']='noindex';
        
        $DataBag['page_metadata'] = (object)$meta_array;
        return view('frontend.auth.login',$DataBag);
    }

    public function loginAction(Request $request)
    {
        $data = $request->all();
        //dd($data);
        $this->validate($request, ['email' => 'required', 'password' => 'required']);

        $user = User::where('email', '=', $data['email'])
            ->where('password', '=', md5($data['password']))
            ->whereIn('user_type_id',['2'])
            ->first();
        if($user){
                //return $user;
            if($user->user_type_id!=1){

                if ($user->status==1) {
                    
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
                    return redirect()->intended(route('home'))->with('messageClass', 'alert alert-success')
                        ->with('message', 'Student successfully added');
                    //return redirect()->back();
                   
                } 
                elseif ($user->status==0) {
                    $error=[
                        'status' => false,
                        'msg'    => 'Your Account has been blocked.',
                    ];
                    return back()->withErrors($error)->withInput();
                    
                }
            }else {
                $error=[
                    'status' => false,
                    'msg'    => 'Invalid username or password',
                ];
                return back()->withErrors($error)->withInput();
                
            }
            
        }else {
            $error=[
                'status' => false,
                'msg'    => 'Invalid username or password',
            ];
            return back()->withErrors($error)->withInput();
            
        }
    }
}
