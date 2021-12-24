<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Product;
use App\ExamMaster;

use Auth;
use View;
use DB;

use Validator;
use App\ArticleMaster;
use App\QuestionMaster;
use App\QuestionAnswer;
use App\QuestionCategory;
use App\MockExam;
use App\MockExamStudentAnswer;
use Hasher;
use Illuminate\Support\Carbon;

class MockTestController extends Controller
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

        $shareData['newsfeed'] = $newsfeed;                
        
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
   
    public function showInstruction()
    {
        
        if (Auth::check()) {  
            $data_msg = array();
            $meta_array['meta_title']='Mock Test | '.env('APP_NAME','IIPARS');
            $meta_array['meta_desc']=''.env('APP_NAME','IIPARS');
            $meta_array['meta_keyword']=''.env('APP_NAME','IIPARS');
            $meta_array['meta_robots']=''.env('APP_NAME','IIPARS');
            $data_msg['page_metadata'] = (object)$meta_array;

            $limitquestion=trim(getMockTestSettings('mt_noofquestion'));

            $data_msg['allquestions']=QuestionMaster::where('status',1)
                    ->take($limitquestion)           
                    ->inRandomOrder()   
                    ->get();
            $data_msg['optionsLabel']=['A','B','C','D'];    
            dd($meta_array);    
            // echo "<pre>";
            // print_r($data_msg['allquestions']);
            // die;

            return view('frontend.mock-test.instruction', $data_msg);
                
            
        } else {
            return redirect()->route('loginAction');
        }
    }
    public function startExam(Request $request)
    {
        
        if (Auth::check()) {  
            $data_msg = array();
            $meta_array['meta_title']='Mock Test | '.env('APP_NAME','IIPARS');
            $meta_array['meta_desc']=''.env('APP_NAME','IIPARS');
            $meta_array['meta_keyword']=''.env('APP_NAME','IIPARS');
            $meta_array['meta_robots']=''.env('APP_NAME','IIPARS');
            $data_msg['page_metadata'] = (object)$meta_array;

            $user_id=Auth::id();

            $student_info=\App\Student::where('user_id',$user_id)->first();
            $exam_start = Carbon::now();
            $exam_start->toDateTimeString();

            $exam_data=array(
                'student' =>$student_info->student_id,
                'datetime' =>  $exam_start,
                'status'=>0
            );
           //return $exam_data;
            $mockexam=MockExam::create($exam_data);
            
            // $request->session()->flash('messageClass', 'alert alert-success');
            // $request->session()->flash('message', 'Question successfully created');
                    
            return redirect()->intended(route('mock-test',['exam_id'=>\Hasher::encode($mockexam->id)]));
        } else {
            return redirect()->route('loginAction');
        }
    }
    public function showQuestionList($exam_id)
    {
        $exam_id=Hasher::decode($exam_id);
        //return $exam_id;
        $exam_info=MockExam::where('id',$exam_id)->first();
        if($exam_info->status==1){
            return redirect()->intended(route('showInstruction'));
        }
        if (Auth::check()) {  
            $data_msg = array();
            $meta_array['meta_title']='Mock Test | '.env('APP_NAME','IIPARS');
            $meta_array['meta_desc']=''.env('APP_NAME','IIPARS');
            $meta_array['meta_keyword']=''.env('APP_NAME','IIPARS');
            $meta_array['meta_robots']=''.env('APP_NAME','IIPARS');
            $data_msg['page_metadata'] = (object)$meta_array;

            $limitquestion=trim(getMockTestSettings('mt_noofquestion'));
            //$data_msg['allquestions']=[];
            $data_msg['allquestions']=QuestionMaster::where('status',1)
                    ->take($limitquestion)           
                    ->inRandomOrder()   
                    ->get();
            $data_msg['optionsLabel']=['A','B','C','D'];        
            

            return view('frontend.mock-test.questions', $data_msg);
                
            
        } else {
            return redirect()->route('loginAction');
        }
    }
    public function submitStudentAnwser(Request $request) 
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
    public function showResult($exam_id)
    {
        $exam_id=Hasher::decode($exam_id);
        //echo $exam_id;
        
        if (Auth::check()) {  
            $data_msg = array();
            $meta_array['meta_title']='Mock Test Result | '.env('APP_NAME','IIPARS');
            $meta_array['meta_desc']=''.env('APP_NAME','IIPARS');
            $meta_array['meta_keyword']=''.env('APP_NAME','IIPARS');
            $meta_array['meta_robots']=''.env('APP_NAME','IIPARS');
            $data_msg['page_metadata'] = (object)$meta_array;

            

            $data_msg['total_questions']=MockExamStudentAnswer::where('mock_exam_id',$exam_id)->count();
            $data_msg['total_attempt_answer']=MockExamStudentAnswer::where('mock_exam_id',$exam_id)->
                            where('answer_id','<>','')->count();
            
            $data_msg['total_score']=MockExam::where('id',$exam_id)->first()->score;
            $limitquestion=trim(getMockTestSettings('mt_noofquestion'));
            $data_msg['exam_id']=$exam_id;

            // $data_msg['allquestions']=QuestionMaster::where('status',1)
            //         ->take($limitquestion)           
            //         //->inRandomOrder()   
            //         ->get();
            $data_msg['allquestions']=DB::table('question_masters as mes')
                                ->join('mock_exam_student_answers as mesa','mesa.question_id','mes.id')
                                ->select('mesa.question_id as id','mesa.mock_exam_id','mes.question')
                                ->where('mesa.mock_exam_id',$exam_id)
                                ->get();
            $data_msg['optionsLabel']=['A','B','C','D'];
            //$total_questions=count($exam_info);


        //    echo "<pre>";
        //    print_r($data_msg['allquestions']);die;

            return view('frontend.mock-test.result', $data_msg);
                
            
        } else {
            return redirect()->route('loginAction');
        }
    }

    public function demoshowQuestionList()
    {
       
        //if (Auth::check()) {  
            $data_msg = array();
            $meta_array['meta_title']='Mock Test | '.env('APP_NAME','IIPARS');
            $meta_array['meta_desc']=''.env('APP_NAME','IIPARS');
            $meta_array['meta_keyword']=''.env('APP_NAME','IIPARS');
            $meta_array['meta_robots']=''.env('APP_NAME','IIPARS');
            $data_msg['page_metadata'] = (object)$meta_array;

            $limitquestion=trim(getMockTestSettings('mt_noofquestion'));
            //$data_msg['allquestions']=[];
            $data_msg['allquestions']=QuestionMaster::where('status',1)
                    ->take($limitquestion)           
                    ->inRandomOrder()   
                    ->get();
            $data_msg['optionsLabel']=['A','B','C','D'];        
           // return $data_msg;

           

            return view('frontend.mock-test.demo_questions', $data_msg);
                
            
        // } else {
        //     return redirect()->route('loginAction');
        // }
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

   
    


    public function notFound($lng) {

        return view('errors.404');
    } 
}