<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use DB;
use App\Student;
use App\Order;
use App\CourseStructureRelation;
use Str;
use Mail;

class UserController extends Controller 
{
    public $successStatus = 200;
    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
    */ 
    public function apitest()
    {
       return "hiii";
    }
    public function login(Request $request){ 

        $data = $request->all();

        $user = User::select('id','id as user_id','id as logged_in_user_id','name as user_name','email')->where('email', '=', $data['email'])
        ->where('password', '=', md5($data['password']))
        ->whereIn('user_type_id',['2'])
        ->first();
        
        if($user){
                
            $collection = collect($user);
            $user_student=User::find($user->user_id)->student;
            $user_details = $collection->merge($user_student);

            $token=$user->createToken('User login Token')->accessToken;
            $user->api_token = $token;

            $lastOrder=DB::table('orders')->where('user_id',$user->user_id)->orderBy('id','desc')->first();
            //dd( $lastOrder);
            $lastbillinfo='';
            if($lastOrder){
                $lastbillinfo=\App\BillingDetail::where('order_id',$lastOrder->id)->first();
                
            }
            $user->logged_in_user = $user->user_id;
            $user->update();   

            if(!empty($lastbillinfo)){

                $returndata=[
                    'success' => 1,
                    'login_token'=>$token,
                    'message'=>'Success',
                    'user_details'=>$user_details,
                    'lastbillinfo'=>$lastbillinfo
                ];
            }else{
                $returndata=[
                    'success' => 1,
                    'login_token'=>$token,
                    'message'=>'Success',
                    'user_details'=>$user_details,
                    
                ];
            }
            return response()->json($returndata, $this-> successStatus); 
        } 
        else{ 
            $returndata=[
                'success' => 0,
                'message'=>'Invalid user credentials',
               
            ];
            return $returndata;
            return response()->json($returndata, $this-> successStatus); 
            //return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }
    public function logout(Request $request)
    {
        //dd(Auth::user());
        $user=User::where('logged_in_user',$request->logged_in_user_id)->first();
        if($user){
            $user->api_token = null;
            $user->logged_in_user = 0;
            $user->save();
            $returndata=[
                'success' => 1,
                'message'=>'Logout successfully',
               
            ];
        }else{
            
            $returndata=[
                'success' => 0,
                'message'=>'User not found',
               
            ];
        }

        return $returndata;
        
    }
    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
    */ 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'firstname' => 'required', 
            'lastname' => 'required', 
            'email' => 'required|email|unique:users,email', 
            'password' => 'required', 
            'phone'=>'required'
            //'c_password' => 'required|same:password', 
        ]);
        if ($validator->fails()) { 
                    return response()->json(['success'=>0,'error'=>$validator->errors()], 401);            
        }
        
            $input = $request->all(); 
            $user_type=\App\UserType::where('name','Student')->first();
            
            $name = $request->input('firstname').' '.$request->input('lastname');
            $email = $request->input('email');
            $password = $request->input('password');
            $user_type_id = $user_type->id;
            $status = 1;
            $is_approved =1;
            
            $firstname = $request->input('firstname');
            $lastname = $request->input('lastname');
            $contactnumber = $request->input('phone');
            $ip_address = $request->ip();

            $data_user_details = array(
                'name' => $name,
                'email' => $email,
                'password' => md5($password),
                'user_type_id'=>$user_type_id,
                'status' => $status,
                'is_approved' => $is_approved,
            );

            $user = User::create($data_user_details); 
            $user_id=$user->id;
            $student_details=array(
                'user_id'=>$user_id,
                'firstname'=>$firstname,
                'lastname'=>$lastname,
                'contactnumber'=>$contactnumber,
                'ip_address'=>$ip_address,

            );
            $student = \App\Student::create($student_details);

            $collection = collect($user);
            $user_student=User::find($user_id)->student;
            $user_details = $collection->merge($user_student);
                
            //$token =  $user->createToken('TeachinnsMobileApp')->accessToken; 

            $returndata=[
                'success' => 1,
                //'token'=>$token,
                'message'=>'Success',
                'user_details'=>$user_details
            ];
            return response()->json($returndata, $this-> successStatus);
    }
    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
    */ 
    public function getUserInfo(Request $request) {  
       // return $request;     

        if ($request->has('logged_in_user_id') && $request->logged_in_user_id>0) {

            $data_msg = array();
             
            $result =  DB::table('users')
                        ->join('students as st','st.user_id','users.id')
                        ->select('users.id','users.logged_in_user', 'st.*', 'users.email')
                        ->where('users.user_type_id', '=', '2')
                        ->where('users.logged_in_user', '=', $request->logged_in_user_id);                   

            $result = $result->first();
            if($result){

                $returndata=[
                    'success' => 1,
                    'message'=>'Success',
                    'user_details'=>$result,
                    'logged_in_user_id'=>$result->logged_in_user
                ];
            }else{
                $returndata=[
                    'success' => 1,
                    'message'=>'No such user',
                    'logged_in_user_id'=>$request->logged_in_user_id
                ];
            }
            return response()->json($returndata, $this-> successStatus);  
            
        }else {
            $returndata=[
                'success' => 0,
                'message'=>'Invalid user',
                'logged_in_user_id'=>$request->has('logged_in_user_id')?$request->logged_in_user_id:0
            ];
            return response()->json($returndata, $this-> successStatus);  
        }
        
        
    }
    
    public function updateProfile(Request $request) {


        $name = $request->input('firstname').' '.$request->input('lastname');
        $email = $request->input('email');
        
        
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $contactnumber = $request->input('phone');
        
        $data_uer_details = array(
            'name' => $name,
            'email' => $email
        );
        
        $userDetails = User::select('id','id as user_id','logged_in_user as logged_in_user_id','name','email')->where('logged_in_user',$request->logged_in_user_id)->first();
        //return $userDetails;
        
        
        $updated_user_info=$userDetails->update($data_uer_details);

        if($updated_user_info){
            $student_details=array(
                        'user_id'=>$userDetails->id,
                        'firstname'=>$firstname,
                        'lastname'=>$lastname,
                        'contactnumber'=>$contactnumber
             
            );

            $student_info=Student::where('user_id',$userDetails->id)->update($student_details);
        }
        $collection = collect($userDetails);
        $user_student=User::find($userDetails->id)->student;
        $user_details = $collection->merge($user_student);

        $returndata=[
            'success' => 1,
            'message'=>'Success',
            'user_details'=>$user_details,
            'logged_in_user_id'=>$userDetails->logged_in_user_id
        ];
        return $returndata;
    }

    public function updatePassword(Request $request)
    {
        $userDetails = User::select('id','id as user_id','logged_in_user as logged_in_user_id','name','email','password')->where('logged_in_user',$request->logged_in_user_id)->first();

        $user_id = $userDetails->id;
        
        $oldpassword = md5($request->input('password_old'));

        if($oldpassword!=$userDetails->password){
            $returndata=[
                'success' => 0,
                'message'=>'Old password is not correct.',
                'logged_in_user_id'=>$userDetails->logged_in_user_id
            ];
            return $returndata;
        }

        $password = md5($request->input('password_new'));
        $data_stud_details = array(
            'password' => $password
        );
        $studentDetails = User::find($user_id);
        $studentDetails->update($data_stud_details);
        $returndata=[
            'success' => 1,
            'message'=>'Success',
            'logged_in_user_id'=>$userDetails->logged_in_user_id
        ];
        return $returndata;
        
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
           
            'email' => 'required|email'
            //'c_password' => 'required|same:password', 
        ]);
        if ($validator->fails()) { 
                    return response()->json(['success'=>0,'error'=>$validator->errors()], 401);            
        }

        $email=$request->email;

        $user=User::where('email',$email)->first();

        if(!$user){
            return $returndata=[
                'success'=>0,
                'message'=>"Email doesn\'t exists"
            ];
        }
        $password = Str::random(6);
        $update = $user->update(['password' => md5($password)]);
        $this->sendResetSuccessMail($user,$password);
        return $returndata=[
            'success'=>1,
            'message'=>"Password is sent to your mail.Please check.",
            //'password'=>$password
        ];

        
    }
    public function sendResetSuccessMail($user,$password)
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
           
            return $returndata=[
                'success'=>0,
                'message'=>$e->getMessage(),
                
            ];
        }


            
    }

    public function dashboard(Request $request) {
        
        $userDetails = User::select('id','id as user_id','logged_in_user as logged_in_user_id','name','email')->where('logged_in_user',$request->logged_in_user_id)->first();
        $user_id = $userDetails->id;
        //return $user_id;

        
            $data_msg = array();
            

            $userArr = User::find(Auth::id());
            

                
                $purchased_courses=DB::table('orders')
                        ->join('products','products.product_id','orders.course_id')
                        ->select('orders.order_id','orders.id as tech_order_id','orders.user_id',
                                'products.name as product_name',DB::raw('DATE_FORMAT(products.end_date, "%d-%m-%Y") as course_end_date'),
                                'products.product_id','products.end_date')
                        ->where([
                            'orders.user_id'=>$user_id,
                            'orders.payment_status'=>'success',
                            //'orders.id'=>160
                        ])
                        ->where('products.end_date','>=',date('Y-m-d'))
                        ->orderBy('orders.created_at','desc')        
                        ->get(); 

                
                $data_msg['purchasedcourses'] = $purchased_courses;
                $content_info=$combo_data=[];
                
                $final_data=$fdata=[];
                
               $path=asset('storage/uploads/materials/');
                
                $prev_course="";
                $prev_course_data=[];
                foreach($purchased_courses as $purchased_course){
                    $course_infos=CourseStructureRelation::where('product_id',$purchased_course->product_id)->first();
                    $course_data=json_decode($course_infos->course_data);
                    //$final_data['courses'][]=$purchased_course;
                    $ma_medias=[];
                    foreach($course_data as $exam){
                        foreach($exam as $key=>$materials){
                            $i=0;
                            if(count($materials)>0){

                                foreach($materials[0] as $material_id){
                                    $combo_data=array(
                                        'exam_id'=>key($course_data),
                                        'paper_id'=>$key,
                                        'material_id'=>$material_id,
                                        'subject_id'=>$materials[1][0] 
                                    );
                                    $exam_paper_material_content=\App\ExamPaperMaterialContent::where($combo_data)
                                    ->where('status',1)
                                    ->first();
                                    if($exam_paper_material_content){

                                        // @$medias['material'][]=$ma_medias=DB::table('media')->select('media_id','media_type',
                                        //                     DB::raw('(CASE 
                                        //                     WHEN media.media_type = "pdf" THEN CONCAT("'.$path.'/",value,"") 
                                        //                     WHEN media.media_type = "video" THEN value 
                                        //                     END) AS filepath'))
                                        //             ->where('exam_paper_material_content_id',$exam_paper_material_content->id)->get();

                                            $ma_medias[]=DB::table('media')->select('media_id','media_type',
                                                    DB::raw('(CASE 
                                                    WHEN media.media_type = "pdf" THEN CONCAT("'.$path.'/",value,"") 
                                                    WHEN media.media_type = "video" THEN value 
                                                    END) AS filepath'))
                                            ->where('exam_paper_material_content_id',$exam_paper_material_content->id)->get();
                                                    
                                                   // @$medias['material'][]=  $purchased_course->tech_order_id;       
                                    }
                                    
                                }
                            }
                            
                        }
                       
                }    
                 if(!empty($ma_medias)){

                     $flat['material'] = call_user_func_array('array_merge', json_decode(json_encode($ma_medias)));
                     
                     $collection = collect($purchased_course);
                     $final_data[]= $collection->merge($flat);
                     
                 }                                            //print_r($ma_medias);die;
                    
            }

            $returndata=[
                'success' => 1,
                'message'=>'Success',
                'courses'=>$final_data,
                'logged_in_user_id'=>$userDetails->logged_in_user_id
            ];
            return $returndata;
                
               return $final_data;
                // foreach(){

                // }
                
                $coursesdata=[];
                // $i=0;
                $newarr = array();

                foreach($final_data as $ar => $el) {
                    $found = -1;
                        // does the key already exist? Thought I could use array_search(), but no
                    for ($count = 0; $count < count($newarr); $count++) { 
                        if ($newarr[$count]['order_id'] == $el['order_id']) { 
                            $found = $count;
                            break;
                        }
                    }
                    if ($found != -1) { 
                        // already have a main entry, so just add to the val array
                    $newarr[$found]['material'][] = $el['material'];
                   // print_r($el['material']);
                    }
                    else {
                        // there *must* be a better way to do this bit in one line
                        $newarr[]['order_id'] = $el['order_id'];
                        $latest = count($newarr)-1;
                        $newarr[$latest]['tech_order_id'] = $el['tech_order_id'];
                        $newarr[$latest]['product_name'] = $el['product_name'];
                        $newarr[$latest]['user_id'] = $el['user_id'];
                        $newarr[$latest]['course_end_date'] = $el['course_end_date'];
                        $newarr[$latest]['product_id'] = $el['product_id'];
                        $newarr[$latest]['material'] = $el['material'];
                        }
                }
                return $newarr;
                die;
                //$newarr=json_decode(json_encode($newarr));
                //dd($newarr);

                
                // foreach($newarr as $marray){
                //     foreach($marray as $key => $submited_data){
                //     $submited_data=json_decode(json_encode($submited_data));
                //         if(is_array($submited_data)){
                //             foreach($submited_data as $key => $data)
                //             {
                //                 if(is_array($data))
                //                 {
                //                     print_r($data);
                                    
                //                 }
                //             }
                           
                //         }

                //     }

                //     die;
                // }
                //return $newarr;
                
                
                
                
    }
}