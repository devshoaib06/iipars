<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Product;
use App\ExamMaster;

use Auth;
use View;
use DB;
use App\User;
use Validator;
use App\ArticleMaster;
use App\QuestionMaster;
use App\QuestionAnswer;
use App\QuestionCategory;
use App\MockExam;
use App\MockExamStudentAnswer;
use App\MockTemplate;
use App\MockTemplateDetails;
use Hasher;
use Illuminate\Support\Carbon;
use App\CourseStructureRelation;
use App\StudentMockTest;
use App\MockQuestionMaster;
use App\MockTabulationRuleDetails;
use App\StudentTestQuestionResult;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class PaidMockTestController extends Controller
{
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

    public function createQuestion(Request $request) {
        $data_msg = array();
        $data_msg["categories"] = QuestionCategory::where('status',1)->orderBy('updated_at', 'desc')->get();
        
        if (Auth::guard('admins')->check()) {
            try{
            $data_msg['menu_parent'] = 'mock-test';
            $data_msg['menu_child'] = 'questionslist';

            if ($request->method() === "POST") {
                $question_data=array(
                    'category_id' =>$request->category  ,
                    'question' =>  $request->input('question'),
                    'status'=>$request->status
                );
                $article_info=QuestionMaster::create($question_data);
                
                $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Question successfully created');
                        
                return redirect()->intended(route('questionslist'))->with('messageClass', 'alert alert-success')
                                        ->with('message', 'Question successfully created');
            }
            	   return view('admin.mock-test.questions.create', $data_msg);

            }catch(\Exception $e){
                return redirect()->back()->with('messageClass', 'alert alert-danger')
                                        ->with('message', $e->getMessage())->withInput();
            }
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function mockTest(Request $request,$course_id) {

        if (Auth::check()) { 
            $course_id=Hasher::decode($course_id);
            
            $data_msg = array();
            $meta_array['meta_title']=env('APP_NAME','IIPARS') .'Mock Test';
            $meta_array['meta_desc']='' .env('APP_NAME','IIPARS');
            $meta_array['meta_keyword']='' .env('APP_NAME','IIPARS');
            $meta_array['meta_robots']='' .env('APP_NAME','IIPARS');
            $data_msg['page_metadata'] = (object)$meta_array;

            $userArr = User::find(Auth::id());
            if (!empty($userArr)) {  

                $result =  DB::table('users')
                    ->join('students as st','st.user_id','users.id')
                    ->select('users.id', 'st.*', 'users.email')
                    ->where('users.user_type_id', '=', '2')
                    ->where('users.id', '=', Auth::id());
                $result = $result->get();

               

                $purchased_mocktests=Product::where('products.end_date','>=',date('Y-m-d'))
                        ->where('products.product_id',$course_id)      
                        ->orderBy('products.created_at','desc')   
                        ->first();
                         
                //return  $purchased_mocktests;           
                $data_msg['result'] = $result;
                $data_msg['course'] = $purchased_mocktests;

                $content_info=[];
                
                    $course_infos=CourseStructureRelation::where('product_id',$purchased_mocktests->product_id)->first();
                    $course_data=json_decode($course_infos->course_data);
                    foreach($course_data as $exam){
                        foreach($exam as $key=>$materials){
                            $content_info[]=array(
                                'exam_id'=>key($course_data),
                                'paper_id'=>$key,
                                //'material_id'=>$materials[0],
                                'subject_id'=>$materials[1]       
                             );
                        }
                    }    
             
                
                $data_msg['templates'] =\App\MockTemplate::with('templateDetails')->where('is_active',1)->get();
                
               
                $data_msg['content_info']=$content_info;
                $user_id=Auth::id();
                $student_info=\App\Student::where('user_id',$user_id)->first();    
                $student_id=$student_info->student_id;
                $pending_tests=StudentMockTest::where('student_id',$student_id)
                    ->where('countdown','<>',0)
                    ->get();

                $data_msg['pending_tests']=$pending_tests;    
                //print_r($content_info);die;
                return view('frontend.student.mocktest', $data_msg);
                
            }else {
                return redirect()->route('loginAction');
            }
        } else {
            return redirect()->route('loginAction');
        }
        
    }
   
    public function showInstruction(Request $request)
    {
       //return $request;
        if (Auth::check()) {  

            $data_msg = array();
            $meta_array['meta_title']='Mock Test | ' .env('APP_NAME','IIPARS');
            $meta_array['meta_desc']='' .env('APP_NAME','IIPARS');
            $meta_array['meta_keyword']='' .env('APP_NAME','IIPARS');
            $meta_array['meta_robots']='' .env('APP_NAME','IIPARS');
            $data_msg['page_metadata'] = (object)$meta_array;

            $request->session()->put([
                'course_id' => $request->course_id,
                'exam_id' => $request->exam_id,
                'paper_id' => $request->paper_id,
                'subject_id' => $request->subject_id,
                'template_id' => $request->template_id
            ]);

            //Get Student Info 
            $user_id=Auth::id();
            $student_info=\App\Student::where('user_id',$user_id)->first();
            $exam_start = date('Y-m-d H:i:s');
            //dd($exam_start);

            //Get Session Value Info
            $template_id = $request->session()->get('template_id');
            $subject_id = $request->session()->get('subject_id');
            $course_id = $request->session()->get('course_id');
            

            //Get Course Info
            $course=\App\Product::find($course_id);
            $test_name=$course->name;
            
            //Get Template Info
            $template_info=MockTemplate::find($template_id);
            
            //Create student Moc Test Data and save it
            $student_mock_test=array(
                'student' =>$student_info->student_id,
                'datetime' =>  $exam_start,
                'status'=>0,
                'test_name'=>$test_name,
                'student_id'=>$student_info->student_id,
                'template_id'=>$template_id,
                'subject_id'=>$subject_id,
                'course_id'=>$course_id,
                'start_datetime'=>date('Y-m-d H:i:s'),
                'duration'=>$template_info->duration,
                'countdown'=>($template_info->duration * 60),
                'last_response_datetime'=>date('Y-m-d H:i:s'),
                'full_marks'=>'',
                'secured_marks'=>0,
            );
            //dd($student_mock_test);
            $mockexam=StudentMockTest::create($student_mock_test);
            $request->session()->put([
                'mock_test_id' => $mockexam->id,
                
            ]);

            
            $mock_test_id= $mockexam->id;
            $params=[
                'template_info'=>$template_info,
                'subject_id'=>$subject_id,
                'mock_test_id'=>$mock_test_id,
                'student_id'=>$student_info->student_id,
            ];
            $mocktestData=$this->saveStudentMockTestDetails($params);
            //dd($mocktestData['fullmarks']);
            $mockexam->full_marks=$mocktestData['fullmarks'];

            $mockexam->save();

            $session_data=[
                'mock_test_id'=>$mock_test_id,
                'start_datetime'=>date('Y-m-d H:i:s'),
                
            ];

            \App\StudentTestSession::create($session_data);
            //$limitquestion=trim(getMockTestSettings('mt_noofquestion'));

            $data_msg['subject']=\App\SubjectMaster::where('id',$request->subject_id)->first(); 
            $template=MockTemplate::find($request->template_id); 

            $template_details=$template->templateDetails;
            $level=[];
            $noofQuestion=0;
            foreach($template_details as $template_detail){
                $level[]= $template_detail->level->name;
                $noofQuestion=$noofQuestion+$template_detail->number_of_questions;
            }    
            

            $data_msg['template']=$template;
            $data_msg['level']=$level;
            $data_msg['noofQuestion']=$noofQuestion;
            $data_msg['fullmarks']=$mocktestData['fullmarks'];
            $data_msg['mock_test_id']=$mock_test_id;
           $request->session()->forget('question_no');
           
            return view('frontend.paid-mock-test.instruction', $data_msg);
                
            
        } else {
            return redirect()->route('loginAction');
        }
    }

    public function saveStudentMockTestDetails($params)
    {
        $template_info=$params['template_info'];
        $subject_id=$params['subject_id'];
        $mock_test_id=$params['mock_test_id'];
        $student_id=$params['student_id'];
        // DB::enableQueryLog();
        $previousMockTestQuestion=StudentTestQuestionResult::
            whereHas('mocktest',function($q) use ($student_id,$subject_id){
                $q->where(['subject_id'=>$subject_id,'student_id'=>$student_id]);
            })->distinct('question_id')->pluck('question_id');
        //dd(DB::getQueryLog(),$previousMockTestQuestion,count($previousMockTestQuestion));    
        if(count($previousMockTestQuestion)<1){
            $previousMockTestQuestion=[0];
        }
        $template_details=$template_info->templateDetails;

            $level=[];
            $noofQuestion=0;
            $levelmarks=[];

            foreach($template_details as $template_detail){
                $level[]= $template_detail->level_id;
                $noofQuestion=$noofQuestion+$template_detail->number_of_questions;
                if($template_detail->marks_per_question!=""){
                    $levelmarks[$template_detail->level_id]=$template_detail->marks_per_question;
                }else{

                    $levelmarks[$template_detail->level_id]=MockTabulationRuleDetails::where('level_id',$template_detail->level_id)->max('marks');
                }
            }  
            //dd($levelmarks);
                               
            $allquestions=\App\MockQuestionDetailsMaster::with('questionMaster')->with('questionOptions')->with('subject')->with('questionAnswers')
            ->whereIn('level_id',$level)
            ->where('subject_id',$subject_id)
            ->whereNotIn('question_id',$previousMockTestQuestion)   
            ->take($noofQuestion)           
            ->inRandomOrder()   
            ->get();
        //    dd($allquestions);
            $fullmarks=$secured_marks=0;


           
            $count=1;
            $checkmockpresent=\App\StudentTestQuestionResult::where('mock_test_id', $mock_test_id)->count();
            if($checkmockpresent==0){

                foreach($allquestions as $question){
                   
                    $data=[
                        'mock_test_id'=>$mock_test_id,
                        'question_id'=>$question->questionMaster->id,
                        'question_no'=>$count,
                        'level_id'=>$question->level_id
                        
                    ];
                   
                    $stQuest=\App\StudentTestQuestionResult::create($data);
                    $count++;
    
    
                    $belongsTolevel=$question->level_id;
                    @$fullmarks=$fullmarks+$levelmarks[$belongsTolevel];
                }
            }
           
            $data=[
                'fullmarks'=>$fullmarks
            ];
            return $data;
    }


    public function startExam(Request $request,$mock_test_id)
    {
    //    return $request->session()->all();

        if (Auth::check()) {  
            $data_msg = array();
            $meta_array['meta_title']='Mock Test | ' .env('APP_NAME','IIPARS');
            $meta_array['meta_desc']='' .env('APP_NAME','IIPARS');
            $meta_array['meta_keyword']='' .env('APP_NAME','IIPARS');
            $meta_array['meta_robots']='' .env('APP_NAME','IIPARS');
            $data_msg['page_metadata'] = (object)$meta_array;

            $mock_test_id=Hasher::decode($mock_test_id);

           
                    
            return redirect()->intended(route('mocktest',['mock_test_id'=>Hasher::encode($mock_test_id)]));
        } else {
            return redirect()->route('loginAction');
        }
    }
    public function showQuestionList(Request $request,$mock_test_id)
    {
        //return $value = $request->session()->all();  

        $template_id = $request->session()->get('template_id');
        $subject_id = $request->session()->get('subject_id');
        $course_id = $request->session()->get('course_id');
        
       

        
        if (Auth::check()) {  
            $data_msg = array();
            $meta_array['meta_title']='Mock Test | ' .env('APP_NAME','IIPARS');
            $meta_array['meta_desc']='' .env('APP_NAME','IIPARS');
            $meta_array['meta_keyword']='' .env('APP_NAME','IIPARS');
            $meta_array['meta_robots']='' .env('APP_NAME','IIPARS');
            $data_msg['page_metadata'] = (object)$meta_array;
            $data_msg['allquestions']=[];
            $mock_test_id = Hasher::decode($mock_test_id);
            $request->session()->put([
            
                'mock_test_id'=>$mock_test_id
            ]);
            if($request->session()->has('question_no')){
                
                
                $question_no = $request->session()->get('question_no');
                $data_msg['allquestions']=StudentTestQuestionResult::where('mock_test_id',$mock_test_id)
                ->where('question_no',$question_no)
                ->first();
            }else{
                
                $data_msg['allquestions']=StudentTestQuestionResult::where('mock_test_id',$mock_test_id)->first();
            }
            //dd($data_msg['allquestions']);
            

            $student_mock_test=StudentMockTest::find($mock_test_id);
            $subject=$student_mock_test->subject->subject_name;
           
            $data_msg['subject']=$subject;
            
            $data_msg['paper']=@$student_mock_test->subject->papers->paper_name;
            $data_msg['noofques']=StudentTestQuestionResult::where('mock_test_id',$mock_test_id)->count();
            
            $data_msg['answeredQues']=StudentTestQuestionResult::where('mock_test_id',$mock_test_id)->where('answer_type',2)->count();
            $data_msg['draftQues']=StudentTestQuestionResult::where('mock_test_id',$mock_test_id)->where('answer_type',1)->count();
            $data_msg['unanswered']=StudentTestQuestionResult::where(['mock_test_id'=>$mock_test_id])
                ->where(function($query) {
                
                    return $query->where('answer_type', '0')
                        ->orWhere('answer_type',NULL);
                })->count();

            $data_msg['mock_test_id']=$mock_test_id;

            // dd($data_msg,$student_mock_test->subject->papers);
            
            //return     $data_msg;    
            

            return view('frontend.paid-mock-test.questions', $data_msg);
                
            
        } else {
            return redirect()->route('loginAction');
        }
    }
    public function submitStudentAnwser(Request $request) 
    {
        //$question_type=['skip'];
       //return $request;
        $mock_test_id = $request->session()->get('mock_test_id');
        $question_id=$request->question_id;
        $question_no=$request->question_no;
        $answer_type=$request->answer_type;
        $answer=$request->input('answer');
        $score='';
        //dd(implode(",",$answer));



        $studentMockTest=StudentMockTest::find($mock_test_id);

        $prev_response_datetime = Carbon::parse($studentMockTest->last_response_datetime);
        $current_response_datetime = Carbon::parse(date('Y-m-d H:i:s'));
        
        $totalDuration = $current_response_datetime->diffInSeconds($prev_response_datetime);
        $request->session()->put([
            'last_countdown_sec' => $totalDuration,
            'question_no'=>$question_no
            
        ]);


        $studentMockTest->countdown=$studentMockTest->countdown-$totalDuration;
        $studentMockTest->last_response_datetime=date('Y-m-d H:i:s');
        $studentMockTest->save();

        $is_correct=0;

        if($answer_type==2){
            $checkcorrect=$this->checkcorrectness($question_id,$answer);
            if($checkcorrect>0){
                
                $score=$this->calculateScore($request,$mock_test_id,$question_id,$answer,$checkcorrect);
            }else{
                $score=0;
            }
            //dd($score);
            
            $is_correct=$score>0?1:0;
            //return $score;
        }
        $data=[
            'mock_test_id'=>$mock_test_id,
            'question_id'=>$question_id,
            'question_no'=>$question_no,
            'answer_type'=>$answer_type,
            'answer'=>@implode(",",$answer),
            'is_correct'=>$is_correct,
            'score'=>$score,
        ];
        $stQuest=\App\StudentTestQuestionResult::updateOrCreate(
            ['mock_test_id' =>  $mock_test_id,'question_id'=>$question_id],
            $data
        );

        $ques_no=$question_no+1;

        $data_msg['allquestions']=StudentTestQuestionResult::where('mock_test_id',$mock_test_id)
          ->where('question_no',$ques_no)      
          ->first();
        $student_mock_test=StudentMockTest::find($mock_test_id);
        $subject=$student_mock_test->subject->subject_name;
        //return $subject;

          $data_msg['subject']=$subject;
      
          $data_msg['noofques']=StudentTestQuestionResult::where('mock_test_id',$mock_test_id)->count();
          $data_msg['answeredQues']=StudentTestQuestionResult::where('mock_test_id',$mock_test_id)->where('answer_type',2)->count();
          $data_msg['draftQues']=StudentTestQuestionResult::where('mock_test_id',$mock_test_id)->where('answer_type',1)->count();
          $data_msg['unanswered']=StudentTestQuestionResult::where(['mock_test_id'=>$mock_test_id])
              ->where(function($query) {
              
                  return $query->where('answer_type', '0')
                      ->orWhere('answer_type',NULL);
              })->count();

        
        $data_msg['mock_test_id']=$mock_test_id;
       

        $data_msg['q_count']=$ques_no;    
        if($data_msg['noofques']>=$ques_no){
            

            $returnHTML = view('frontend.paid-mock-test._nextquestions',$data_msg)->render();

            
            return response()->json( array('success' => true, 'html'=>$returnHTML) );
        }
        if($answer_type==1){
            $data_msg['allquestions']=StudentTestQuestionResult::where('mock_test_id',$mock_test_id)
            //->where('question_no',1)      
            ->first();
            $data_msg['noofques']=StudentTestQuestionResult::where('mock_test_id',$mock_test_id)->count();
            $data_msg['answeredQues']=StudentTestQuestionResult::where('mock_test_id',$mock_test_id)->where('answer_type',2)->count();
            $data_msg['draftQues']=StudentTestQuestionResult::where('mock_test_id',$mock_test_id)->where('answer_type',1)->count();
            $data_msg['unanswered']=StudentTestQuestionResult::where(['mock_test_id'=>$mock_test_id])
                ->where(function($query) {
                
                    return $query->where('answer_type', '0')
                        ->orWhere('answer_type',NULL);
                })->count();
                //dd($data_msg['allquestions']);
                $returnHTML = view('frontend.paid-mock-test._nextquestions',$data_msg)->render();
                return response()->json( array('success' => true, 'html'=>$returnHTML) );
        }
        return response()->json( array('success' => true) );

       
                

       
       
        
    }

    public function submitUnmarkedStudentAnwser(Request $request) 
    {
        //$question_type=['skip'];
       
        $mock_test_id = $request->session()->get('mock_test_id');
        $question_id=$request->question_id;
        $question_no=$request->question_no;
        $answer_type=$request->answer_type;
        $answer=$request->answer;
        $score='';

        $studentMockTest=StudentMockTest::find($mock_test_id);

        $prev_response_datetime = Carbon::parse($studentMockTest->last_response_datetime);
        $current_response_datetime = Carbon::parse(date('Y-m-d H:i:s'));
        
        $totalDuration = $current_response_datetime->diffInSeconds($prev_response_datetime);
        $request->session()->put([
            'last_countdown_sec' => $totalDuration,
            'question_no'=>$question_no
            
        ]);


        $studentMockTest->countdown=$studentMockTest->countdown-$totalDuration;
        $studentMockTest->last_response_datetime=date('Y-m-d H:i:s');
        $studentMockTest->save();

        $is_correct=0;

        if($answer_type==2){
            $score=$this->calculateScore($request,$mock_test_id,$question_id,$answer);
            $is_correct=$score>0?1:0;
            //return $score;
        }

        $data=[
            'mock_test_id'=>$mock_test_id,
            'question_id'=>$question_id,
            'question_no'=>$question_no,
            'answer_type'=>$answer_type,
            'answer'=>$answer,
            'is_correct'=>$is_correct,
            'score'=>$score,
        ];
        
        $stQuest=\App\StudentTestQuestionResult::updateOrCreate(
            ['mock_test_id' =>  $mock_test_id,'question_id'=>$question_id],
            $data
        );

        $ques_no=$question_no;

        $data_msg['allquestions']=StudentTestQuestionResult::where('mock_test_id',$mock_test_id)
          ->where('question_no',$ques_no)      
          ->first();
        $student_mock_test=StudentMockTest::find($mock_test_id);
        $subject=$student_mock_test->subject->subject_name;
        //return $subject;

          $data_msg['subject']=$subject;
      
          $data_msg['noofques']=StudentTestQuestionResult::where('mock_test_id',$mock_test_id)->count();
          $data_msg['answeredQues']=StudentTestQuestionResult::where('mock_test_id',$mock_test_id)->where('answer_type',2)->count();
          $data_msg['draftQues']=StudentTestQuestionResult::where('mock_test_id',$mock_test_id)->where('answer_type',1)->count();
          $data_msg['unanswered']=StudentTestQuestionResult::where(['mock_test_id'=>$mock_test_id])
              ->where(function($query) {
              
                  return $query->where('answer_type', '0')
                      ->orWhere('answer_type',NULL);
              })->count();

        
        $data_msg['mock_test_id']=$mock_test_id;
       

        $data_msg['q_count']=$ques_no;    
        if($data_msg['noofques']>=$ques_no){
            

            $returnHTML = view('frontend.paid-mock-test._nextquestions',$data_msg)->render();

            
            return response()->json( array('success' => true, 'html'=>$returnHTML) );
        }
        if($answer_type==1){
            $data_msg['allquestions']=StudentTestQuestionResult::where('mock_test_id',$mock_test_id)
            //->where('question_no',1)      
            ->first();
            $data_msg['noofques']=StudentTestQuestionResult::where('mock_test_id',$mock_test_id)->count();
            $data_msg['answeredQues']=StudentTestQuestionResult::where('mock_test_id',$mock_test_id)->where('answer_type',2)->count();
            $data_msg['draftQues']=StudentTestQuestionResult::where('mock_test_id',$mock_test_id)->where('answer_type',1)->count();
            $data_msg['unanswered']=StudentTestQuestionResult::where(['mock_test_id'=>$mock_test_id])
                ->where(function($query) {
                
                    return $query->where('answer_type', '0')
                        ->orWhere('answer_type',NULL);
                })->count();
                //dd($data_msg['allquestions']);
                $returnHTML = view('frontend.paid-mock-test._nextquestions',$data_msg)->render();
                return response()->json( array('success' => true, 'html'=>$returnHTML) );
        }
        return response()->json( array('success' => true) );

       
                

       
       
        
    }


    public function mockTestFinalSubmit(Request $request,$mock_test_id) 
    {
       
        $mock_test_id = Hasher::decode($mock_test_id);
        $studentMockTest=StudentMockTest::find($mock_test_id);
        
        $allquestions=StudentTestQuestionResult::where('mock_test_id',$mock_test_id)->get();
        $fullmarks=$secured_marks=0;
        foreach($allquestions as $question){
            $question_id=$question->question_id;
            @$secured_marks=$secured_marks+$question->score;  


                
        }
        $studentMockTest->secured_marks=$secured_marks;
        $studentMockTest->countdown=0;

        $studentMockTest->save();

       return redirect()->route('pmt-result', ['mock_test_id'=>Hasher::encode($mock_test_id)]);

           
       
        
    }

    public function showQuestion(Request $request) 
    {
        //$question_type=['skip'];
       //return $request->all();
        $mock_test_id = $request->session()->get('mock_test_id');
        //dd($mock_test_id);
        $question_id=$request->question_id;
        $question_no=$request->question_no;
        
        $ques_no=$question_no;

        $data_msg['allquestions']=StudentTestQuestionResult::where('mock_test_id',$mock_test_id)
          ->where('question_no',$ques_no)      
          ->first();

        $student_mock_test=StudentMockTest::find($mock_test_id);
        $subject=$student_mock_test->subject->subject_name;
        //return $subject;

        $data_msg['subject']=$subject;
      
        $data_msg['noofques']=StudentTestQuestionResult::where('mock_test_id',$mock_test_id)->count();
        $data_msg['answeredQues']=StudentTestQuestionResult::where('mock_test_id',$mock_test_id)->where('answer_type',2)->count();
        $data_msg['draftQues']=StudentTestQuestionResult::where('mock_test_id',$mock_test_id)->where('answer_type',1)->count();
        $data_msg['unanswered']=StudentTestQuestionResult::where(['mock_test_id'=>$mock_test_id])
            ->where(function($query) {
            
                return $query->where('answer_type', '0')
                    ->orWhere('answer_type',NULL);
            })->count();
        
        $data_msg['mock_test_id']=$mock_test_id;
       

        $data_msg['q_count']=$ques_no;    

        //return $data_msg;
       
                
        $returnHTML = view('frontend.paid-mock-test._nextquestions',$data_msg)->render();
        
        return response()->json( array('success' => true, 'html'=>$returnHTML) );

       
       
        
    }
    
    public function updateStudentResponseTime(Request $request)
    {
        $mock_test_id = $request->session()->get('mock_test_id');
        $studentMockTest=StudentMockTest::find($mock_test_id);

        $last_countdown_sec=$defaultUpdateSec=60;
        if($request->session()->has('last_countdown_sec')){
            $last_countdown_sec =$defaultUpdateSec-$request->session()->get('last_countdown_sec');
        }
        $countdown=$studentMockTest->countdown-$last_countdown_sec;
        $log = [
        'prev_countdown'=>$studentMockTest->countdown,   
        'last_countdown_sec' => $last_countdown_sec,
        'countdown' => $countdown];

        $orderLog = new Logger('order');
        $orderLog->pushHandler(new StreamHandler(storage_path('logs/order.log')), Logger::INFO);
        $orderLog->info('OrderLog', $log);
     
        

        $studentMockTest->countdown=$countdown;
        $studentMockTest->last_response_datetime=date('Y-m-d H:i:s');
        $studentMockTest->save();
        $request->session()->forget('last_countdown_sec');
    }

    public function calculateScore($request,$mock_test_id,$question_id,$answer,$correctness)
    {
        $student_test=StudentMockTest::find($mock_test_id);
        $template_id=$student_test->template_id;

        $subject_id=$student_test->subject_id;
        $exam_id=$request->session()->get('exam_id');
        $paper_id=$request->session()->get('paper_id');

        
        $question_detail=StudentTestQuestionResult::where('question_id',$question_id)
                ->where('mock_test_id',$mock_test_id)
                ->first();

        @$level_id=$question_detail->level_id;    

        $mockTemplate=MockTemplate::find($template_id);
        $rule_id=$mockTemplate->tabulation_rule_id;
        $rule_details=MockTabulationRuleDetails::where('rule_id',$rule_id)->where('level_id',$level_id)->count();
        $templateDetails=MockTemplateDetails::where('level_id',$level_id)->where('template_id',$template_id)->first();
        //dd($templateDetails->marks_per_question);

        
        if($templateDetails->marks_per_question!="")   {
            $score=$templateDetails->marks_per_question;
        
            return $score;
        }        
        elseif($student_test){
            //$correctness=$this->checkcorrectness($question_id,$answer);
            $rule=MockTabulationRuleDetails::where('level_id',$level_id)->where('correctness',$correctness)->first();
            $score=$rule['marks'];
            //dd($score);
            return $score;

        }
    }
    private function checkcorrectness($question_id,$answer)
    {
        $questAnswers=\App\MockQuestionAnswers::where('question_id',$question_id)->where('is_correct',1)->get()->toArray();
        
        $correctansArray=[];
        $correctness=0;
        
        $choosenAnsCount=count($answer);
        if($choosenAnsCount!=count($questAnswers)){
            $correctness=0;
            return $correctness;
        }
        foreach($questAnswers as $qa ){
            $correctansArray[]=$qa['serial_no'];
        }
        if($answer==$correctansArray){
            $correctness=100;
        }
       
        return $correctness;


    }

    private function checkQuestioncorrectness($question_id,$answer)
    {
        $questAnswers=\App\MockQuestionAnswers::where('question_id',$question_id)->where('is_correct',1)->get()->toArray();
        
        $correctansArray=[];
        $correctness=0;
        
        $choosenAnsCount=count($answer);
        if($choosenAnsCount!=count($questAnswers)){
            $correctness=0;
            return $correctness;
        }
        foreach($questAnswers as $qa ){
            $correctansArray[]=$qa['serial_no'];
        }
        if($answer==$correctansArray){
            $correctness=100;
        }
       
        return $correctness;


    }

    public function getQuestionSummary(Request $request) 
    {
        //$question_type=['skip'];
       
        $mock_test_id = $request->session()->get('mock_test_id');
        
      
        $noofques=StudentTestQuestionResult::where('mock_test_id',$mock_test_id)->get();
        // return $noofques;
        // $data_msg['answeredQues']=StudentTestQuestionResult::where('answer_type',2)->count();
        // $data_msg['draftQues']=StudentTestQuestionResult::where('answer_type',1)->count();
        // $data_msg['unanswered']=StudentTestQuestionResult::where('answer_type',0)->orWhere('answer_type',NULL)->count();
        $totalQues=count($noofques);
        $answeredQues=$draftQues=$unanswered=0;
        foreach($noofques as $noofque){
            if($noofque->answer_type==2){
               $answeredQues=$answeredQues+1; 
            }
            if($noofque->answer_type==1){
                $draftQues=$draftQues+1; 
            }
            if($noofque->answer_type==0 || $noofque->answer_type==NULL){
                $unanswered=$unanswered+1; 
            }
        }
            //return $draftQues;
           $html="<li ><span class='answered'></span><div class='ansText'>".$answeredQues."</div> answered</li>";
           $html.="<li ><span class='mark'></span><div class='markText'>".$draftQues."</div> marked</li>";
           $html.="<li ><span class='unanswered'></span><div class='unansText'>".$unanswered."</div> unanswered</li>";
        
        return response()->json( array('success' => true, 'html'=>$html) );

       
       
        
    }


    public function showResult(Request $request,$mock_test_id)
    {
        $mock_test_id=Hasher::decode($mock_test_id);
        //$exam_id=Hasher::decode($mock_test_id);
        // echo $mock_test_id;
        
        if (Auth::check()) {  
            $data_msg = array();
            $meta_array['meta_title']='Mock Test Result | ' .env('APP_NAME','IIPARS');
            $meta_array['meta_desc']='' .env('APP_NAME','IIPARS');
            $meta_array['meta_keyword']='' .env('APP_NAME','IIPARS');
            $meta_array['meta_robots']='' .env('APP_NAME','IIPARS');
            $data_msg['page_metadata'] = (object)$meta_array;

            $total_correct_answer=$total_incorrect_answer=$total_attempt_answer=0;
            
            $mock_test=StudentMockTest::find($mock_test_id);
            $mockTestDetails=$mock_test->studentResult;

            
            $exam_id = $request->session()->get('exam_id');
            $paper_id = $request->session()->get('paper_id');
            $subject_id = $mock_test->subject_id;
           
            $templateInfos=$mock_test->template->templateDetails;
            $checklevel=[];
            $qlevel=[];
            foreach($mockTestDetails as $mockTestDetail){
                if($mockTestDetail->is_correct==1){

                    $total_correct_answer=$total_correct_answer+1;
                }
                if($mockTestDetail->answer!=NULL && $mockTestDetail->is_correct==0){

                    $total_incorrect_answer=$total_incorrect_answer+1;
                }
                if($mockTestDetail->answer_type==2){

                    $total_attempt_answer=$total_attempt_answer+1;
                }

                $question_id=$mockTestDetail->question_id;
                $mockQues=$this->getQuestionLevel($exam_id,$paper_id,$subject_id,$question_id);
                
            }

            $data_msg['mock_test_id']=$mock_test_id;
            $data_msg['total_questions']=count($mockTestDetails);
            $data_msg['total_attempt_answer']=$total_attempt_answer;
            $data_msg['total_incorrect_answer']=$total_incorrect_answer;
            $data_msg['total_correct_answer']=$total_correct_answer;
            $data_msg['templateInfos']=$templateInfos;
            
           // dd($data_msg);

           $template_id = $mock_test->template_id;
           
           
           //$this->getQuestionLevel($request,$template_id);
           $allquestions=StudentTestQuestionResult::where('mock_test_id',$mock_test_id)->paginate(1)->appends($mock_test_id);
        //    dd($allquestions);
           $data_msg['mock_test']=$mock_test;
            $data_msg['allquestions']=$allquestions;

        
            return view('frontend.paid-mock-test.result', $data_msg);
                
            
        } else {
            return redirect()->route('loginAction');
        }
    }

    public function goToPage(Request $request)
    {
        $items = $request->items ?? 10;      // get the pagination number or a default

        $club = Club::findOrFail(session('club'));

        $members = $club->members()->paginate($items);
        $allquestions=StudentTestQuestionResult::where('mock_test_id',$mock_test_id)->paginate(1);

       
        return view('club.' . config('app.locale') . '.index')
            ->withClub($club)
            ->withMembers($members)
            ->withItems($items);
    }

    public function getQuestionLevel($exam_id,$paper_id,$subject_id,$question_id)
    {
       

        $mocktemplate=\App\MockQuestionDetailsMaster::where([
            'question_id'=>$question_id,
            'exam_id'=>$exam_id,
            'paper_id'=>$paper_id,
            'subject_id'=>$subject_id
        ])->first();
        
        return $mocktemplate;
        

        //dd($templateDetails);
    }

   

    public function settings() {
        $lang = \App::getLocale();
        $data_msg = array();
        $data_msg['lang'] = $lang;
        if (Auth::guard('admins')->check()) {
            $data_msg['menu_parent'] = 'mock-test';
            $data_msg['menu_child'] = 'mock-settings';
            $data_msg['form_url'] = route('settingsAction');

            $setting = \App\MockTestSettings::where([['status', '1'],])->orderBy('display_order', 'asc')->get();
            $data_msg['setting'] = $setting;
			
			
			
            	return view('admin.settings.mock-test.addedit', $data_msg);
			
			
			
        } else {
            //return redirect()->intended('admin/login');
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function settingsAction(Request $request) {
        //$lang = \App::getLocale();

        $setting = \App\MockTestSettings::where([['status', '1'],])->get();

        foreach ($setting as $v) {

            $data = [
                'content' => $request->input($v->setting_id),
            ];
            \App\MockTestSettings::find($v->id)->update($data);
        }


        \Session::flash('messageClass', 'alert alert-success');
        \Session::flash('message', 'Setting updated successfully'); //trans('categories.insert_message')       
        return back();
    }
    
    public function showMockExamList()
    {
        //dd(\App\ArticleCategory::find(1)->articles);
        $data_msg = array();
        if (Auth::guard('admins')->check())
        {
            $data_msg['menu_parent'] = 'mock-test';
            $data_msg['menu_child'] = 'examlist';
            
            $data_msg["categories"] = QuestionCategory::where('status',1)->orderBy('updated_at', 'desc')->get();
            return view('admin.mock-test.exam.list', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function ajaxMockExamList(Request $request)
    {

        if ($request->ajax())
        {
            $name = $request->input('name');
            $category = $request->input('category');
            $status = $request->input('status');
            $date_from = $request->input('date_from');
            $date_to = $request->input('date_to');
            
            
            $arrSearch[] =['me.status','<>',3] ;
            
            
            
            
            if ($category != '') {
                $arrSearch[] = ['category_id', $category];
            }
            if ($status != '') {
                $arrSearch[] = ['me.status',$status];
            }

            if ($date_from != '') {

                $d_p_d = explode('/', $date_from);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $date_from = $d_p_d_m;

                $arrSearch[] = ['me.datetime', '>=', $date_from];
            }

            if ($date_to != '') {

                $d_p_d = explode('/', $date_to);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $date_to = $d_p_d_m;

                $arrSearch[] = ['me.datetime', '<=', $date_to];
            }

            $items = DB::table('mock_exams as me')
            ->select('me.*','st.firstname','st.lastname')
            ->join('students as st','st.student_id','me.student')
            ->where($arrSearch);

            if ($name != '') {
                $items = $items->WhereRaw("concat(firstname, ' ', lastname) like '%$name%' ");
            }
            $items = $items->get();
            //dd($items);
            $iTotalRecords = count($items);

           
            $iDisplayLength = intval($_REQUEST['length']);
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            $iDisplayStart = intval($_REQUEST['start']);
            $sEcho = intval($_REQUEST['draw']);

            $records = array();
            $records["data"] = array();

            $end = $iDisplayStart + $iDisplayLength;
            $end = $end > $iTotalRecords ? $iTotalRecords : $end;


            $order = $request->input('order');

            $column = array( 'id','name','score','status');


            if ($order[0]['column'] != '') {
                $column_name = $column[$order[0]['column']];
            } else {
                //$column_name = $column[4];
                $column_name = 'id';
                
            }

            // if ($order[0]['dir'] != '') {
            //     $asc_desc = $order[0]['dir'];
            // } else {
            // }
            $asc_desc = 'desc';
            

            
            $items_1 = DB::table('mock_exams as me')
                ->select('me.*','st.firstname','st.lastname')
                ->join('students as st','st.student_id','me.student')
                ->where($arrSearch);

            if ($name != '') {
                $items_1 = $items_1->WhereRaw("concat(firstname, ' ', lastname) like '%$name%' ");
            }    

            $items_1 = $items_1->orderBy($column_name, $asc_desc)
                    ->skip($iDisplayStart)
                    ->take($iDisplayLength)
                    ->get();
            $sl = 1;
            foreach ($items_1 as $t)
            {
               
               
                if ($t->status == '1') {
                    $status = '<span class="label label-sm label-success"> Finished </span>';
                }else{
                    $status = '<span class="label label-sm label-warning">Pending</span>';

                }

                if ($t->result_declare_date) {
                    $result_declare_status = '<span class="label label-sm label-success"> Result Declared </span>';
                }else{
                    $result_declare_status = '<span class="label label-sm label-warning">Result Pending</span>';

                }
                
                
                $records["data"][] = array(
                    
                    $sl,
                    $t->firstname.' '.$t->lastname,
                    $t->score,
                    \Carbon\Carbon::parse($t->datetime)->format('d/m/Y'),
                    $status,
                    $t->winner_position,
                    $result_declare_status
                    //'<a href="'.route('editMockExam',['id'=>Hasher::encode($t->id)]).'" class="btn btn-sm btn-default"><i class="fa fa-eye"></i> Edit </a>'
                    
                );

                $sl++;
            }

            $records["draw"] = $sEcho;
            $records["recordsTotal"] = $iTotalRecords;
            $records["recordsFiltered"] = $iTotalRecords;

            echo json_encode($records);
            exit;
        }
    }

    public function declareMockExamResult(Request $request)
    {
        //return $request;

        $from_date=$request->from_date;
        $to_date=$request->to_date;

        if($from_date=="" && $to_date==""){
            return back()->with('messageClass', 'alert alert-danger')
                                ->with('message', 'Please select the exam date.');
        }

        

        if ($from_date != '') {

            $d_p_d = explode('/', $from_date);
            $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
            $from_date = $d_p_d_m;

            $arrSearch[] = ['datetime', '>=', $from_date];
        }

        if ($to_date != '') {

            $d_p_d = explode('/', $to_date);
            $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
            $to_date = $d_p_d_m;

            $arrSearch[] = ['datetime', '<=', $to_date];
        }

        $mock_exams=MockExam::where($arrSearch)->orderBy('score','desc')->get();
        $highest_mark=0;
        if($mock_exams){
            
            @$highest_mark=$mock_exams[0]->score;
        }
        $rank=$prevscore=0;
        foreach($mock_exams as $mock_exam){
            $mock_single_exam=MockExam::find($mock_exam->id);

            if($mock_single_exam->result_declare_date==""){

                if($highest_mark==$mock_single_exam->score){
                    $rank=1;
                }
                elseif($prevscore==$mock_exam->score){
                    $rank=$rank;
                }
                else{
                    $rank=$rank+1;
                }
                $prevscore=$mock_exam->score;
                $mock_exam_data=[
                    'winner_position'=>$rank,
                    'result_declare_date'=>date('Y-m-d H:i:s')
                ];
    
                $mock_single_exam->update($mock_exam_data);
            }

        }

        return back()->with('messageClass', 'alert alert-success')
                                ->with('message', 'Result declared successfully.');
    }

    public function editMockExam(Request $request, $id) {
        
        if (Auth::guard('admins')->check()) {

			
            $data_msg = array();

            
            $data_msg['menu_parent'] = 'mock-test';
            $data_msg['menu_child'] = 'questionslist';
            
            $question =QuestionMaster::find($id);  
            $data_msg["question"] = $question;
            
            $data_msg["categories"] = QuestionCategory::where('status',1)->orderBy('updated_at', 'desc')->get();
            
			
            return view('admin.mock-test.exam.edit', $data_msg);
			
        } else {

            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editQuestionAnswerAction(Request $request, $id) 
    {
        //return $request;
        
            $articleDetails=QuestionMaster::find($id);
            $article_data=array(
                'category_id'=>$request->input('category'),
                'question' =>  $request->input('question'),
                'status' => $request->input('status'),
               
            );

            
            $updated_user_info=$articleDetails->update($article_data);

            \Session::flash('messageClass', 'alert alert-success');
            \Session::flash('message', 'Updated successfully');
            
            return back();
       
        
    }


    //Student

    public function studentMockTests()
    {
        if (Auth::check())
        {
            $meta_array['meta_title']=env('APP_NAME','IIPARS').'- My Mock Tests';
            $meta_array['meta_desc']='' .env('APP_NAME','IIPARS');
            $meta_array['meta_keyword']='' .env('APP_NAME','IIPARS');
            $data_msg['page_metadata'] = (object)$meta_array;
            $data_msg['allProducts']=Product::where('status',1)->orderBy('name','Asc')->get();
            $user_id=Auth::id();

            $student_info=\App\Student::where('user_id',$user_id)->first();
            $student_id=$student_info->student_id;
            $data_msg['allmocktests']=StudentMockTest::where('student_id',$student_id)
                ->orderBy('start_datetime','DESC')
                ->get();
            return view('frontend.paid-mock-test.student._mocktest', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    //Demo Test
    public function demomockTest(Request $request,$course_id) {

        if (Auth::check()) { 
            $course_id=Hasher::decode($course_id);
            
            $data_msg = array();
            $meta_array['meta_title']=env('APP_NAME','IIPARS').' - Mock Test';
            $meta_array['meta_desc']='' .env('APP_NAME','IIPARS');
            $meta_array['meta_keyword']='' .env('APP_NAME','IIPARS');
            $meta_array['meta_robots']='' .env('APP_NAME','IIPARS');
            $data_msg['page_metadata'] = (object)$meta_array;

            $userArr = User::find(Auth::id());
            if (!empty($userArr)) {  

                $result =  DB::table('users')
                    ->join('students as st','st.user_id','users.id')
                    ->select('users.id', 'st.*', 'users.email')
                    ->where('users.user_type_id', '=', '2')
                    ->where('users.id', '=', Auth::id());
                $result = $result->get();

                // $purchased_mocktests=DB::table('orders')
                //         ->join('products','products.product_id','orders.course_id')
                //         ->select('orders.order_id','orders.id as tech_order_id','orders.user_id',
                //                 'products.name as product_name',
                //                 'products.product_id','products.end_date')
                //         ->where([
                //             'orders.user_id'=>Auth::id(),
                //             'orders.payment_status'=>'success',
                            
                //         ])
                //         ->where('products.end_date','>=',date('Y-m-d'))
                //         ->where('products.product_id',$course_id)      
                //         ->orderBy('orders.created_at','desc')        
                //         ->get(); 

                $purchased_mocktests=Product::where('products.end_date','>=',date('Y-m-d'))
                        ->where('products.product_id',$course_id)      
                        ->orderBy('products.created_at','desc')   
                        ->first();
                         
                //return  $purchased_mocktests;           
                $data_msg['result'] = $result;
                $data_msg['course'] = $purchased_mocktests;

                $content_info=[];
                //foreach($purchased_mocktests as $purchased_course){
                    $course_infos=CourseStructureRelation::where('product_id',$purchased_mocktests->product_id)->first();
                    $course_data=json_decode($course_infos->course_data);
                    foreach($course_data as $exam){
                        foreach($exam as $key=>$materials){
                            $content_info[]=array(
                                'exam_id'=>key($course_data),
                                'paper_id'=>$key,
                                //'material_id'=>$materials[0],
                                'subject_id'=>$materials[1]       
                             );
                        }
                    }    
                    
               // }
                //return  $content_info;
                $data_msg['templates'] =\App\MockTemplate::with('templateDetails')->where('is_active',1)->get();
                
                //$this->contributorShareCalculation($purchased_courses);           

                $data_msg['content_info']=$content_info;
                //print_r($content_info);die;
                return view('frontend.student.mocktest', $data_msg);
                
            }else {
                return redirect()->route('loginAction');
            }
        } else {
            return redirect()->route('loginAction');
        }
        
    }
    public function demoshowInstruction(Request $request)
    {
       //return $request;
        if (Auth::check()) {  
            $data_msg = array();
            $meta_array['meta_title']='Mock Test | ' .env('APP_NAME','IIPARS');
            $meta_array['meta_desc']='' .env('APP_NAME','IIPARS');
            $meta_array['meta_keyword']='' .env('APP_NAME','IIPARS');
            $meta_array['meta_robots']='' .env('APP_NAME','IIPARS');
            $data_msg['page_metadata'] = (object)$meta_array;

            $request->session()->put([
                'course_id' => $request->course_id,
                'subject_id' => $request->subject_id,
                'template_id' => $request->template_id,
                'level_id' => $request->level_id,
            ]);

            //$limitquestion=trim(getMockTestSettings('mt_noofquestion'));

            $data_msg['subject']=\App\SubjectMaster::where('id',$request->subject_id)->first(); 
            $data_msg['template_details']=MockTemplateDetails::where('template_id',$request->template_id)
                    ->where('level_id',$request->level_id)
                    ->first(); 


           
            return view('frontend.paid-mock-test.instruction', $data_msg);
                
            
        } else {
            return redirect()->route('loginAction');
        }
    }
    public function demostartExam(Request $request)
    {
        if (Auth::check()) {  
            $data_msg = array();
            $meta_array['meta_title']='Mock Test | ' .env('APP_NAME','IIPARS');
            $meta_array['meta_desc']='' .env('APP_NAME','IIPARS');
            $meta_array['meta_keyword']='' .env('APP_NAME','IIPARS');
            $meta_array['meta_robots']='' .env('APP_NAME','IIPARS');
            $data_msg['page_metadata'] = (object)$meta_array;

            $user_id=Auth::id();

            $student_info=\App\Student::where('user_id',$user_id)->first();
            $exam_start = date('Y-m-d H:i:s');
            //$exam_start->toDateTimeString();

            $template_id = $request->session()->get('template_id');
            $subject_id = $request->session()->get('subject_id');
            $course_id = $request->session()->get('course_id');
            $level_id = $request->session()->get('level_id');

            $template_info=MockTemplate::find($template_id);
            //return $template_info;

            $student_mock_test=array(
                'student' =>$student_info->student_id,
                'datetime' =>  $exam_start,
                'status'=>0,

                'student_id'=>$student_info->student_id,
                'template_id'=>$template_id,
                'subject_id'=>$subject_id,
                'course_id'=>$course_id,
                'level_id'=>$level_id,
                'start_datetime'=>date('Y-m-d H:i:s'),
                'duration'=>$template_info->duration,
                'countdown'=>'',
                'last_response_datetime'=>'',
                'full_marks'=>'',
                'secured_marks'=>'',
            );
           //return $student_mock_test;
            $mockexam=StudentMockTest::create($student_mock_test);
            
            // $request->session()->flash('messageClass', 'alert alert-success');
            // $request->session()->flash('message', 'Question successfully created');
                    
            return redirect()->intended(route('mocktest'));
        } else {
            return redirect()->route('loginAction');
        }
    }
    public function demoshowQuestionList(Request $request)
    {
        //return $value = $request->session()->all();  

        $template_id = $request->session()->get('template_id');
        $subject_id = $request->session()->get('subject_id');
        $course_id = $request->session()->get('course_id');
        $level_id = $request->session()->get('level_id');

        // $exam_id=Hasher::decode($exam_id);
        // //return $exam_id;
        // $exam_info=MockExam::where('id',$exam_id)->first();
        // if($exam_info->status==1){
        //     return redirect()->intended(route('showInstruction'));
        // }
        if (Auth::check()) {  
            $data_msg = array();
            $meta_array['meta_title']='Mock Test | ' .env('APP_NAME','IIPARS');
            $meta_array['meta_desc']='' .env('APP_NAME','IIPARS');
            $meta_array['meta_keyword']='' .env('APP_NAME','IIPARS');
            $meta_array['meta_robots']='' .env('APP_NAME','IIPARS');
            $data_msg['page_metadata'] = (object)$meta_array;

            $limitquestion=trim(getMockTestSettings('mt_noofquestion'));
            //$data_msg['allquestions']=[];
            $data_msg['allquestions']=\App\MockQuestionDetailsMaster::with('question')->with('questionOptions')->with('subject')->with('questionAnswers')
                ->where('level_id',$level_id)
                ->where('subject_id',$subject_id)   
                ->take($limitquestion)           
                ->inRandomOrder()   
                ->first();

            
           
            // print_r( $data_msg['allquestions']);die;
            $data_msg['optionsLabel']=['A','B','C','D'];        
            

            return view('frontend.paid-mock-test.questions', $data_msg);
                
            
        } else {
            return redirect()->route('loginAction');
        }
    }
    public function demosubmitStudentAnwser(Request $request) 
    {
        $user_id=Auth::id();
        $student_info=\App\Student::where('user_id',$user_id)->first();
        $exam_info=MockExam::where('student',$student_info->student_id)
            ->where('status',0)->orderBy('datetime','desc')->first();
        //dd($exam_info->id);

        $score=0;
        
        //return $request;    
        $i=0;
        foreach ($request->input('questions', []) as $key => $question) {
            
            $status = 0;
            $is_draft=0;
            $answer_id=$request->input('answer.'.$question);
            //echo $key;
            if(count($request->drafts)>0){

                if(in_array($key,$request->drafts)){
                    $is_draft=1;
                    $answer_id=0;
                }
            }

            //echo QuestionAnswer::find($request->input('answer.'.$question))->is_correct;
            if ($request->input('answer.'.$question) != null
                && QuestionAnswer::find($request->input('answer.'.$question))->is_correct
            ) {
                $status = 1;
                $score++;
            }
            $mockexam_save_data=[
                'mock_exam_id' => $exam_info->id,
                'question_id' => $question,
                'answer_id'   => $answer_id,
                'is_draft'   => $is_draft,
                'is_correct'     => $status,
            ];
            // echo "<pre>";
            // print_r($mockexam_save_data);
            MockExamStudentAnswer::create($mockexam_save_data);
        }
        //echo $i;
        //die;
        $mock_exam_data=[
            'score' => $score,
            'status'=>1
        ];
        $exam_info->update($mock_exam_data);
            
           
        \Session::flash('messageClass', 'alert alert-success');
        \Session::flash('message', 'Thanks for attending the exam.');
        
        return redirect()->intended(route('mt-result',['exam_id'=>\Hasher::encode($exam_info->id)]));
       
        
    }

    public function showAdminMockExamList()
    {
        //dd(\App\ArticleCategory::find(1)->articles);
        $data_msg = array();
        if (Auth::guard('admins')->check())
        {
            $data_msg['menu_parent'] = 'mock-test';
            $data_msg['menu_child'] = 'examlist';
            
            $data_msg["categories"] = QuestionCategory::where('status',1)->orderBy('updated_at', 'desc')->get();
            
            return view('admin.mock-test.paid-mock-test.test.list', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function ajaxAdminMockExamList(Request $request)
    {

        if ($request->ajax())
        {
            $name = $request->input('name');
            $category = $request->input('category');
            $status = $request->input('status');
            $date_from = $request->input('date_from');
            $date_to = $request->input('date_to');
            
            
            $arrSearch[] =['id','<>',0] ;
            
            
            
            
            if ($category != '') {
                $arrSearch[] = ['category_id', $category];
            }
            if ($status != '') {
                $arrSearch[] = ['me.status',$status];
            }

            if ($date_from != '') {

                $d_p_d = explode('/', $date_from);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $date_from = $d_p_d_m;

                $arrSearch[] = ['me.datetime', '>=', $date_from];
            }

            if ($date_to != '') {

                $d_p_d = explode('/', $date_to);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $date_to = $d_p_d_m;

                $arrSearch[] = ['me.datetime', '<=', $date_to];
            }

            // $items = DB::table('mock_exams as me')
            // ->select('me.*','st.firstname','st.lastname')
            // ->join('students as st','st.student_id','me.student')
            // ->where($arrSearch);
            $items=StudentMockTest::where($arrSearch);

            if ($name != '') {
                $items = $items->WhereRaw("concat(firstname, ' ', lastname) like '%$name%' ");
            }
            $items = $items->get();
            //dd($items);
            $iTotalRecords = count($items);

           
            $iDisplayLength = intval($_REQUEST['length']);
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            $iDisplayStart = intval($_REQUEST['start']);
            $sEcho = intval($_REQUEST['draw']);

            $records = array();
            $records["data"] = array();

            $end = $iDisplayStart + $iDisplayLength;
            $end = $end > $iTotalRecords ? $iTotalRecords : $end;


            $order = $request->input('order');

            $column = array( 'id','name','score','status');


            // if ($order[0]['column'] != '') {
            //     $column_name = $column[$order[0]['column']];
            // } else {
            //     //$column_name = $column[4];
            
            // }
                $column_name = 'id';
            
            // if ($order[0]['dir'] != '') {
            //     $asc_desc = $order[0]['dir'];
            // } else {
            // }
            $asc_desc = 'desc';
            

            
            $items_1 =StudentMockTest::where($arrSearch);

            if ($name != '') {
                $items_1 = $items_1->WhereRaw("concat(firstname, ' ', lastname) like '%$name%' ");
            }    

            $items_1 = $items_1->orderBy($column_name, $asc_desc)
                    ->skip($iDisplayStart)
                    ->take($iDisplayLength)
                    ->get();
            $sl = 1;
            foreach ($items_1 as $t)
            {
               
               
                if ($t->countdown >= '1') {
                    $status = '<span class="label label-sm label-warning">Pending</span>';
                }else{
                    $status = '<span class="label label-sm label-success"> Finished </span>';

                }

                if ($t->result_declare_date) {
                    $result_declare_status = '<span class="label label-sm label-success"> Result Declared </span>';
                }else{
                    $result_declare_status = '<span class="label label-sm label-warning">Result Pending</span>';

                }
                
                
                $records["data"][] = array(
                    
                    $sl,
                    $t->test_name,
                    // $t->course->exa,
                    $t->student->firstname .' '.$t->student->lastname,
                    $t->secured_marks."/".$t->full_marks,
                    \Carbon\Carbon::parse($t->start_datetime)->format('d/m/Y H:i:s'),
                    $status,
                    $t->winner_position,
                    //$result_declare_status
                    //'<a href="'.route('editMockExam',['id'=>Hasher::encode($t->id)]).'" class="btn btn-sm btn-default"><i class="fa fa-eye"></i> Edit </a>'
                    
                );

                $sl++;
            }

            $records["draw"] = $sEcho;
            $records["recordsTotal"] = $iTotalRecords;
            $records["recordsFiltered"] = $iTotalRecords;

            echo json_encode($records);
            exit;
        }
    }
   
    


    public function notFound($lng) {

        return view('errors.404');
    } 
}