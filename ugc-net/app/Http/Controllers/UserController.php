<?php

namespace App\Http\Controllers;

use Validator;
use Mail;
use App\Admin;
use App\User;
use App\Student;
use App\ExamMaster;
use App\Coupon;
//use App\ModulesAction;
use Hasher;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\CourseStructureRelation;
use App\ExamPaperMaterialMaster;
use App\MaterialMaster;
use App\library\myFunctions;
use App\Media;
use View;
use App\OrderContributorPaymentDetails;

class UserController extends Controller {

    public function __construct() {
        $lang = Session::get('variableLocale');
        if ($lang != null) {
            Session::put('variableLocale', 'en');
            \App::setLocale($lang);
        }
        
        $shareData = array();
        
		$mainMenu = Product::select('product_id','name','slug')->where('status', '=', '1')->orderBy('name', 'asc')->get();
        $exams = ExamMaster::select('exam_name','id')->where('status', '=', '1')->orderBy('id', 'asc')->get();
        $combo_pack_products = Product::select('product_id','name','slug')
                        ->where(['status' => '1',
                                'is_combo'=>1
                        ])
                        ->orderBy('name', 'asc')
                        ->get();
        
        $articles_cat=\App\ArticleCategory::where('status',1)->get();                
        $shareData['articlecats'] = $articles_cat;       
        $floatersignup=\App\FloaterSignUpMaster::where('status',1)->first();   
        $shareData['floatersignup'] = $floatersignup; 
        
        $newsfeed = DB::connection('mysql2')->table('tbl_news_feed')->where('status', 1)->get();
        $social = DB::connection('mysql2')->table('tbl_social_link')->get();
        $contact = DB::connection('mysql2')->table('tbl_contact')->get();
        $counter = DB::connection('mysql2')->table('tbl_no_of_visitor')->get();
        $shareData['newsfeed'] = $newsfeed;
        $shareData['social'] = $social;
        $shareData['contact'] = $contact;
        $shareData['counter'] = $counter;

        $shareData['combo_pack_products'] = $combo_pack_products;
        $shareData['mainMenu'] = $mainMenu;
        $shareData['exams'] = $exams;
        View::share($shareData);
    }

    public function index() {


        if (Auth::guard('admins')->check()) {

            $data_msg = array();
            $data_msg['menu_parent'] = 'dashboard';
            $data_msg['menu_child'] = 'dashboard';
            $data_msg['users'] = '';


            $data_msg['result_date'] = array();

            $totalOwner = User::where('user_type_id', '=', '3')->get()->count();//->where('email_verified_at', '<>', null)
            $totalProvider = User::where('user_type_id', '=', '4')->get()->count();//->where('email_verified_at', '<>', null)



            $data_msg['totalOwner'] = $totalOwner;
            $data_msg['totalProvider'] = $totalProvider;
			




            return view('admin.dashboard', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function setLocalLang($locale) {

        if (is_null($locale)) {
            return redirect()->back();
        }

        Session::put('variableLocale', $locale);

        return redirect()->back();
    }

    public function checkUseremail(Request $request) {
        if ($request->ajax()) {
            $email = trim($request->input('femail'));
            $ck = DB::table('users')->where('email', $email)->first();
            
            if (!empty($ck)) {
                return "true";
            } else {
                return "false";
            }
        }
    }


    public function dashboard() {

        if (Auth::check()) {  
            $data_msg = array();
            $meta_array['meta_title']=env('APP_Name', 'IIPARS').'-Dashboard';
             $meta_array['meta_desc']=env('APP_Name', 'IIPARS').'';
             $meta_array['meta_keyword']=env('APP_Name', 'IIPARS').'';
             $meta_array['meta_robots']=env('APP_Name', 'IIPARS').'';
            $data_msg['page_metadata'] = (object)$meta_array;

            $userArr = User::find(Auth::id());
            if (!empty($userArr)) {  

                $result =  DB::table('users')
                    ->join('students as st','st.user_id','users.id')
                    ->select('users.id', 'st.*', 'users.email')
                    ->where('users.user_type_id', '=', '2')
                    ->where('users.id', '=', Auth::id());
                $result = $result->get();

                $purchased_courses=$data_msg['order_info']=DB::table('orders')
                        ->join('products','products.product_id','orders.course_id')
                        ->select('orders.order_id','orders.id as tech_order_id','orders.user_id',
                                'products.name as product_name',
                                'products.product_id','products.end_date')
                        ->where([
                            'orders.user_id'=>Auth::id(),
                            'orders.payment_status'=>'success',
                            
                        ])
                        //->where('products.end_date','>=',date('Y-m-d'))
                        //->where('products.is_mock_test','=',0)      
                        ->orderBy('orders.created_at','desc')        
                        ->get(); 
                         
                // return  $purchased_courses;           
                $data_msg['result'] = $result;
                $data_msg['purchasedcourses'] = $purchased_courses;
                $content_info=[];
                foreach($purchased_courses as $purchased_course){
                    $course_infos=CourseStructureRelation::where('product_id',$purchased_course->product_id)->first();
                    $course_data=json_decode($course_infos->course_data);
                    foreach($course_data as $exam){
                        foreach($exam as $key=>$materials){
                            $content_info[]=array(
                                'exam_id'=>key($course_data),
                                'paper_id'=>$key,
                                'material_id'=>$materials[0],
                                'subject_id'=>$materials[1]       
                             );
                        }
                    }    
                    
                }
                //$this->contributorShareCalculation($purchased_courses);           

                $data_msg['content_info']=$content_info;
                //print_r($content_info);die;
                return view('frontend.dashboard', $data_msg);
                
            }else {
                return redirect()->route('loginAction');
            }
        } else {
            return redirect()->route('loginAction');
        }
        
    }

    


    public function contributorShareCalculation($purchased_courses)
    {
        $myLibrary=new \App\library\myFunctions();
        echo '<pre>';
       foreach ($purchased_courses as $course){
        $related_materials_info=$myLibrary->getMaterialInfo($course->product_id);
        foreach ($related_materials_info as $related_material){
            $exam_paper_material_content=\App\ExamPaperMaterialContent::where($related_material)
            ->where('status',1)
            ->first();
            $related_contributor_infos= \App\ExamPaperMaterialContributor::where('exam_paper_material_content_id',$exam_paper_material_content->id)->get();
            
            foreach($related_contributor_infos as $related_contributor_info ){
                $share_payment_data=array(
                    'course_id'=>$course->product_id,
                    'order_id'=>1,
                    'contributor_id'=>$related_contributor_info->contributor_id,
                    'price_earn'=>$related_contributor_info->price,
                );

                OrderContributorPaymentDetails::create($share_payment_data);
            }
        }
       }
       echo "</pre>";
    }


    public function myAccount() {       

        if (Auth::check()) {

             $data_msg = array();
             
            $result =  DB::table('users')
                        ->join('students as st','st.user_id','users.id')
                        ->select('users.id', 'st.*', 'users.email')
                        ->where('users.user_type_id', '=', '2')
                        ->where('users.id', '=', Auth::id());                   

                    $result = $result->get();
                    // print_r($result);
                    // die;
            $meta_array['meta_title']='Teachinns-MyAccount';
            $meta_array['meta_desc']='Teachinns';
            $meta_array['meta_keyword']='Teachinns';
            $meta_array['meta_robots']='Teachinns';
            $data_msg['page_metadata'] = (object)$meta_array;
            $data_msg['result'] = $result;            
            
            return view('frontend.myAccount', $data_msg);
            
        }else {
            return redirect()->route('loginAction');
        }
        
        
    }
    

    public function myAccountAction(Request $request, $id) {



        $name = $request->input('firstname').' '.$request->input('lastname');
        $email = $request->input('email');


        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $contactnumber = $request->input('phn_no');

        $data_uer_details = array(
            'name' => $name,
            'email' => $email
        );

        $userDetails = User::find($id);
        
        
        $updated_user_info=$userDetails->update($data_uer_details);

        if($updated_user_info){
            $student_details=array(
                        'user_id'=>$id,
                        'firstname'=>$firstname,
                        'lastname'=>$lastname,
                        'contactnumber'=>$contactnumber
             
            );

            $student_info=Student::where('user_id',$id)->update($student_details);
            $request->session()->flash('messageClass', 'alert alert-success'); //alert-danger
            $request->session()->flash('message', 'Account Info Updated Successfully.');
            return back();


        }


    }

    public function myCourses($course_id) {       

        if (Auth::check()) {
            $meta_array['meta_title']='Teachinns-Dashboard';
            $meta_array['meta_desc']='Teachinns';
            $meta_array['meta_keyword']='Teachinns';
            $meta_array['meta_robots']='Teachinns';

            $product_id=$course_id;
            $data_msg = array();
            $products=Product::select('name','short_description','category_id','price','revised_price','image')
                     ->where('product_id',$product_id)->first();
            $course_infos=CourseStructureRelation::where('product_id',$product_id)->first();
            
            $data_msg['relatedexam']="";
            $data_msg['allPapers']=$data_msg['relatedSubjects']=$data_msg['content_info']=$content_info=[];
            //echo "<pre>";
            if($course_infos){
                
                $course_data=json_decode($course_infos->course_data);
                $course_subjects=json_decode($course_infos->course_subject);
                
                //print_r($course_subjects);die;
                $exam_id=key($course_data);
                
                $data_msg['relatedexam']=key($course_data);
                $relatedPapers=array();
                $relatedmaterials=array();
                foreach($course_data as $exam){
                    foreach($exam as $key=>$materials){
                        foreach($materials as $material){
                            foreach($course_subjects as $csubject){
                                foreach($csubject as $subject){
                                    $content_info[]=array(
                                       'exam_id'=>key($course_data),
                                       'paper_id'=>$key,
                                       'material_id'=>$material,
                                       'subject_id'=>$subject       
                                    ); 
                                }
                            }
                        }
                    }  
                }

                
            }
            $data_msg['productinfo']=$products;
            $data_msg['content_infos']=$content_info;
            //return $content_info;
            return view('frontend.student.myCourses', $data_msg);
            
        }else {
            return redirect()->route('loginAction');
        }
        
        
    }

    public function myMockTests() {       

        if (Auth::check()) {
            $meta_array['meta_title']='Teachinns-Mock Test';
            $meta_array['meta_desc']='Teachinns';
            $meta_array['meta_keyword']='Teachinns';
            $meta_array['meta_robots']='Teachinns';

            $product_id=$course_id;
            $data_msg = array();
            $products=Product::select('name','short_description','category_id','price','revised_price','image')
                     ->where('product_id',$product_id)->first();
            $course_infos=CourseStructureRelation::where('product_id',$product_id)->first();
            
            $data_msg['relatedexam']="";
            $data_msg['allPapers']=$data_msg['relatedSubjects']=$data_msg['content_info']=$content_info=[];
            //echo "<pre>";
            if($course_infos){
                
                $course_data=json_decode($course_infos->course_data);
                $course_subjects=json_decode($course_infos->course_subject);
                
                //print_r($course_subjects);die;
                $exam_id=key($course_data);
                
                $data_msg['relatedexam']=key($course_data);
                $relatedPapers=array();
                $relatedmaterials=array();
                foreach($course_data as $exam){
                    foreach($exam as $key=>$materials){
                        foreach($materials as $material){
                            foreach($course_subjects as $csubject){
                                foreach($csubject as $subject){
                                    $content_info[]=array(
                                       'exam_id'=>key($course_data),
                                       'paper_id'=>$key,
                                       'material_id'=>$material,
                                       'subject_id'=>$subject       
                                    ); 
                                }
                            }
                        }
                    }  
                }

                
            }
            $data_msg['productinfo']=$products;
            $data_msg['content_infos']=$content_info;
            //return $content_info;
            return view('frontend.student.myCourses', $data_msg);
            
        }else {
            return redirect()->route('loginAction');
        }
        
        
    }

    public function changePassword() {
        $data_msg = array();
        if (Auth::check()) {   
            $meta_array['meta_title']='Teachinns-Change Password';
            $meta_array['meta_desc']='Teachinns';
            $meta_array['meta_keyword']='Teachinns';
            $meta_array['meta_robots']='Teachinns';
           $data_msg['page_metadata'] = (object)$meta_array;         
            return view('frontend.changePassword', $data_msg);
            
        } else {
            return redirect()->route('loginAction');
        }
    }

    public function updatePassword(Request $request)
    {

        $user_id = Auth::id();
        $password = md5($request->input('npassword'));
        $data_stud_details = array(
            'password' => $password
        );
        $studentDetails = User::find($user_id);
        $studentDetails->update($data_stud_details);
        $request->session()->flash('messageClass', 'alert alert-success'); //alert-danger
        $request->session()->flash('message', 'Password Changed Successfully.');
        return back(); 
        
    }

    public function downloadContent($media_id) {
        //dd(Auth::check());
         if (Auth::check()) {
 
            
             $media_info=Media::find($media_id);
             $pathToFile = $path = storage_path('uploads/materials/') . $media_info->value;
             return response()->download($pathToFile, $media_info->value);
         } else {
             return redirect()->intended('/login');
         }
     }

    

}
