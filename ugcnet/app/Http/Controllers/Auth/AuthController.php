<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Student;
use App\EmailTemplates;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Foundation\Auth\RegistersUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\RedirectResponse;
//use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use Session;
use Hash;
use DB;
use Storage;
use View;
//use Socialite;

class AuthController extends Controller {

    public function __construct()
    {
        $shareData = array();
        
		$mainMenu = \App\Product::select('product_id','name','slug')->where('status', '=', '1')->orderBy('name', 'asc')->get();
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
        $this->middleware('guest');
    }

     public function forgetPasswordPage() {
        $meta_array['meta_title']='Teachinns - Forgot Password';
        $meta_array['meta_desc']='Teachinns - Forgot Password';
        $meta_array['meta_keyword']='Teachinns  - Forgot Password';
        
        $DataBag['page_metadata'] = (object)$meta_array;

        return view('web.auth.forget_password',$DataBag);
     }

    public function forgetPasswordAction(Request $request) {
      
        
        $email = trim($request->input('femail'));


        if ($email != "") {

            $arr = User::where('email', '=', $email)->first();
            //dd($arr);
          
            if (!empty($arr)) {

                $user_id = $arr->id;
                $token = md5(csrf_token() . "-" . uniqid(rand(), true) . "-" . microtime(TRUE) . "-" . $user_id);
                $url = route('reset_password_page', ['token' => $token]);

                $temp_data = EmailTemplates::where([['mail_id', 'forgot_password']])->get();
       
                $template_data = $temp_data[0];

                $content = $template_data->content;
                $content = str_replace("{{link}}", $url, $content);
                $content = str_replace("{{first_name}}", $arr->name, $content);

                $emailData = array();
                $emailData['subject'] = trim($template_data->subject);
                $emailData['body'] = trim($content);
                $emailData['to_email'] = $email;
                $emailData['from_email'] = trim(getSettings('from_email'));
                $emailData['from_name'] = trim(getSettings('from_name'));
                //echo "<pre>"; print_r($emailData); die;

                $update = User::where('email', '=', $email)->update(['remember_token' => $token]);

                if ($update) {
                   try{ 
                    Mail::send('frontend.emails.password', ['emailData' => $emailData], function ($message) use ($emailData) {

                        $message->from($emailData['from_email'], $emailData['from_name']);

                        $message->to($emailData['to_email'])->subject($emailData['subject']);
                        //$message->to('moutusi@karmicksolutions.com')->subject($emailData['subject']);
                    });
                    }catch (\Exception $e){
                        return response()->json([
                            'status'  => false,
                            'msg'=>$e->getMessage()
                        ]);
                    }
                    if($arr->user_type_id==2){
                        return response()->json([
                            'status'  => true,
                            'message'=>'Password reset link sent to your mail, please check your mail, thankyou.'
                        ]);

                    }
                    // $request->session()->flash('messageClass', 'alert alert-danger');
                    // $request->session()->flash('message', 'Invalid username or password');
                    
                    // return redirect()->intended(route('contributorlogin'))->with('messageClass', 'alert alert-danger')
                    //                 ->with('message', 'Invalid username or password')->withInput();
                    return back()->with('messageClass', 'alert alert-success')
                                    ->with('message', 'Password reset link sent to your mail, please check your mail, thankyou.');
                }
            } else {

                return back()->with('msg', 'Sorry! this email-id not registered.')
                                ->with('msg_class', 'alert alert-danger');
            }
        }

        return back();
    }

    public function resetPasswordPage($token) {
        $meta_array['meta_title']='Teachinns - Reset Password';
        $meta_array['meta_desc']='Teachinns - Reset Password';
        $meta_array['meta_keyword']='Teachinns  - Reset Password';
        
        $DataBag['page_metadata'] = (object)$meta_array;
        $DataBag['token'] = $token;

        //d878ca3a191751a9c831bd6ccd71e75b
        $DataBag['user'] = User::where('remember_token', '=', $token)->first();
        //return $DataBag;
        //if (!empty($arr)) {

            return view('frontend.auth.reset_password', $DataBag);
        // } else {

        //     return redirect()->route('home');
        // }
    }

    public function resetPasswordAction(Request $request) {
        
       // dd($request->all());die;
        

        $password = (trim($request->input('password')));
        $verify_token = trim($request->input('verify_token'));
        $user=User::where('remember_token', '=', $verify_token)->first();
        $update = $user->update(['password' => md5($password)]);
        //print_r($user)  ;die;      
        $this->sendResetSuccessMail($user,$password,$verify_token);
        if ($update) {
            return redirect()->route('reset_password_page',['token'=>$verify_token])->with('msg', 'Your password changed successfully, please login. thankyou')
                            ->with('msg_class', 'alert alert-success');
        }

        return back()->with('msg', 'Something went wrong or you are unauthorized.Please try again.')
        ->with('msg_class', 'alert alert-danger');
    }

    public function sendResetSuccessMail($user,$password,$verify_token)
    {
        try{
            $first_name=$user->name;
            $email=$user->email;
            $temp_data = \App\EmailTemplates::where(['mail_id'=>'reset_password'])->first();
            $template_data = $temp_data;
            //print_r($template_data);die;
    
            $content = $template_data->content;
            $content = str_replace("{{first_name}}", $first_name, $content);
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
            return redirect()->intended(route('reset_password_page',['token'=>$verify_token]))
            ->withErrors($e->getMessage())->withInput();
        }


            
    }

}
