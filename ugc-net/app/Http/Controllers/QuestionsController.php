<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use View;
use DB;
use Validator;
use Hasher;
use App\Product;
use App\ExamMaster;
use App\QuestionCategory;
use App\QuestionMaster;
use App\MockQuestionMaster;
use App\MockQuestionOptions;
use App\MockQuestionAnswers;
use App\MockQuestionDetailsMaster;
use App\QuestionAnswer;
use Str;


class QuestionsController extends Controller
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
        
        $data_msg['pagetitle'] = 'Mock Question';

        if (Auth::guard('admins')->check()) {
            try{
            $data_msg['menu_parent'] = 'mock-test';
            $data_msg['menu_child'] = 'questionslist';

            if ($request->method() === "POST") {

                //return $request;
                $correct_option_key=$request->correct;

                if($request->$correct_option_key==""){
                    return redirect()->back()->with('messageClass', 'alert alert-danger')
                    ->with('message', 'Correct answer must not be blank')->withInput();
                    
                }
                $optionsLabel=['A','B','C','D']; 
        
                $question_data=array(
                    'category_id' =>$request->category,
                    'question' =>  $request->input('question'),
                    'correct_clarification'=>$request->correct_clarification,
                    'status'=>$request->status,
                );
                $question=QuestionMaster::create($question_data);
                    $i=0;
                foreach ($request->input() as $key => $value) {
                    if(strpos($key, 'option') !== false && $value != '') {
                        $is_correct = $request->input('correct') == $key ? 1 : 0;
                        QuestionAnswer::create([
                            'question_id' => $question->id,
                            'answer'      => $value,
                            'is_correct'     => $is_correct,
                            'status'     => $request->status,
                            'option_label'     => $optionsLabel[$i],
                        ]);
                        $i++;
                    }
                }
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

   
    public function showQuestionList()
    {
        //dd(\App\ArticleCategory::find(1)->articles);
        $data_msg = array();
        if (Auth::guard('admins')->check())
        {
            $data_msg['menu_parent'] = 'mock-test';
            $data_msg['menu_child'] = 'questionslist';
            $data_msg['pagetitle'] = 'Mock Question';

            
            $data_msg["categories"] = QuestionCategory::where('status',1)->orderBy('updated_at', 'desc')->get();
            return view('admin.mock-test.questions.list', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function ajaxQuestionList(Request $request)
    {

        if ($request->ajax())
        {
            $question = $request->input('question');
            $category = $request->input('category');
            $status = $request->input('status');
            
            
            $arrSearch[] =['qm.status','<>',3] ;
            
            if ($question != '') {
                $arrSearch[] = ['question', 'like', '%' . $question . '%'];
            }
            
            
            if ($category != '') {
                $arrSearch[] = ['category_id', $category];
            }
            if ($status != '') {
                $arrSearch[] = ['qm.status',$status];
            }

            $items = DB::table('question_masters as qm')
            ->select('qm.*','qc.name as cat_name')
            ->join('question_categories as qc','qm.category_id','qc.id')
            ->where($arrSearch);

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

            $column = array( 'id','name','category_id','status');


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
            

            
            $items_1 = DB::table('question_masters as qm')
                    ->select('qm.*','qc.name as cat_name')
                    ->join('question_categories as qc','qm.category_id','qc.id')
                    ->where($arrSearch);

            $items_1 = $items_1->orderBy($column_name, $asc_desc)
                    ->skip($iDisplayStart)
                    ->take($iDisplayLength)
                    ->get();
            $sl = 1;
            foreach ($items_1 as $t)
            {
               
               
                if ($t->status == '1') {
                    $status = '<span class="label label-sm label-success"> Active </span>';
                }else{
                    $status = '<span class="label label-sm label-warning">Inactive</span>';

                }
                
                
                $records["data"][] = array(
                    
                    $sl,
                    $t->question,
                    $t->cat_name,
                    $status,
                    '<a href="'.route('editQuestion',['id'=>Hasher::encode($t->id)]).'" class="btn btn-sm btn-default"><i class="fa fa-eye"></i> Edit </a>'
                    
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

    public function editQuestion(Request $request, $id) {
        
        if (Auth::guard('admins')->check()) {
            $data_msg = array();
            
            $data_msg['menu_parent'] = 'mock-test';
            $data_msg['menu_child'] = 'questionslist';
            
            $question =QuestionMaster::find($id);  
            $data_msg["question"] = $question;
            
            $data_msg["categories"] = QuestionCategory::where('status',1)->orderBy('updated_at', 'desc')->get();
            $data_msg['related_answers']=QuestionAnswer::where('question_id',$id)->get();
			
            return view('admin.mock-test.questions.edit', $data_msg);
			
        } else {

            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editQuestionAction(Request $request, $id) 
    {
        //return $request;
            $correct_option_key=$request->correct;
            if($request->$correct_option_key==""){
                return redirect()->back()->with('messageClass', 'alert alert-danger')
                ->with('message', 'Correct answer must not be blank')->withInput();
                
            }
        
            $question=QuestionMaster::find($id);
            $question_data=array(
                'category_id' =>$request->category,
                'question' =>  $request->input('question'),
                'correct_clarification'=>$request->correct_clarification,
                'status'=>$request->status,
            );
            $question->update($question_data);
            $optionsLabel=['A','B','C','D']; 
            QuestionAnswer::where('question_id', $question->id)->delete();
            $i=0;
            foreach ($request->input() as $key => $value) {
                if(strpos($key, 'option') !== false && $value != '') {
                    $is_correct = $request->input('correct') == $key ? 1 : 0;
                    QuestionAnswer::create([
                        'question_id' => $question->id,
                        'answer'      => $value,
                        'is_correct'     => $is_correct,
                        'status'     => $request->status,
                        'option_label'     => $optionsLabel[$i],

                    ]);
                    $i++;
                }
            }

            
           

            \Session::flash('messageClass', 'alert alert-success');
            \Session::flash('message', 'Updated successfully');
            
            return back();
       
        
    }
    
    public function showQuestionAnswerList()
    {
        //dd(\App\ArticleCategory::find(1)->articles);
        $data_msg = array();
        if (Auth::guard('admins')->check())
        {
            $data_msg['menu_parent'] = 'mock-test';
            $data_msg['menu_child'] = 'questionslist';
            
            $data_msg["categories"] = QuestionCategory::where('status',1)->orderBy('updated_at', 'desc')->get();
            return view('admin.mock-test.question-answer.list', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function ajaxQuestionAnswerList(Request $request)
    {

        if ($request->ajax())
        {
            $question = $request->input('question');
            $category = $request->input('category');
            $status = $request->input('status');
            
            
            $arrSearch[] =['qm.status','<>',3] ;
            
            if ($question != '') {
                $arrSearch[] = ['question', 'like', '%' . $question . '%'];
            }
            
            
            if ($category != '') {
                $arrSearch[] = ['category_id', $category];
            }
            if ($status != '') {
                $arrSearch[] = ['qm.status',$status];
            }

            $items = DB::table('question_masters as qm')
            ->select('qm.*','qc.name as cat_name')
            ->join('question_categories as qc','qm.category_id','qc.id')
            ->where($arrSearch);

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

            $column = array( 'id','name','category_id','status');


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
            

            
            $items_1 = DB::table('question_masters as qm')
                    ->select('qm.*','qc.name as cat_name')
                    ->join('question_categories as qc','qm.category_id','qc.id')
                    ->where($arrSearch);

            $items_1 = $items_1->orderBy($column_name, $asc_desc)
                    ->skip($iDisplayStart)
                    ->take($iDisplayLength)
                    ->get();
            $sl = 1;
            foreach ($items_1 as $t)
            {
               
               
                if ($t->status == '1') {
                    $status = '<span class="label label-sm label-success"> Active </span>';
                }else{
                    $status = '<span class="label label-sm label-warning">Inactive</span>';

                }
                
                
                $records["data"][] = array(
                    
                    $sl,
                    $t->question,
                    $t->cat_name,
                    $status,
                    '<a href="'.route('editQuestion',['id'=>Hasher::encode($t->id)]).'" class="btn btn-sm btn-default"><i class="fa fa-eye"></i> Edit </a>'
                    
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

    public function editQuestionAnswer(Request $request, $id) {
        
        if (Auth::guard('admins')->check()) {

			
            $data_msg = array();

            
            $data_msg['menu_parent'] = 'mock-test';
            $data_msg['menu_child'] = 'questionslist';
            
            $question =QuestionMaster::find($id);  
            $data_msg["question"] = $question;
            
            $data_msg["categories"] = QuestionCategory::where('status',1)->orderBy('updated_at', 'desc')->get();
            
			
            return view('admin.mock-test.question-answer.edit', $data_msg);
			
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

    protected function validatorRegisterGeneral(array $data) {
        //dd($data);
        $validate = [
            
            'email' => 'required|email|max:255',
            //'password' => 'required|min:6',
            'g-recaptcha-response' => 'required|captcha'
        ];

        return Validator::make($data, $validate);
    }

    public function showQuestioncategoryList()
    {
        $data_msg = array();
        if (Auth::guard('admins')->check())
        {
            $data_msg['menu_parent'] = 'mock-test';
            $data_msg['menu_child'] = 'mock-test-cat-list';
            $categories=QuestionCategory::all();
            $data_msg['categories']=$categories;
            return view('admin.mock-test.categories.list',$data_msg);
            
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function createQuestionCategory(Request $request) {
        $data_msg = array();
       
        if (Auth::guard('admins')->check()) {
            $data_msg['menu_parent'] = 'mock-test';
            $data_msg['menu_child'] = 'mock-test-cat-list';
            
            if ($request->method() === "POST") {
            //$slug = $this->createSlug($request->cat_name);
              
           

                $article_cat_data=array(
                    'name' =>  $request->input('cat_name'),
                    'status' =>  $request->input('status'),
                );
                
                $article_info=QuestionCategory::create($article_cat_data);

                $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Mock Test Category successfully created');
                    
                return redirect()->intended(route('showMockcategoryList'))->with('messageClass', 'alert alert-success')
                                    ->with('message', 'Mock Test Category successfully created');
            }
            	return view('admin.mock-test.categories.create', $data_msg);
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editQuestionCategory(Request $request, $id) {
        
        if (Auth::guard('admins')->check()) {

			
            $data_msg = array();

            $article_info =QuestionCategory::find($id);  
                        
            $data_msg["article_info"] = $article_info;
            $data_msg['menu_parent'] = 'mock-test';
            $data_msg['menu_child'] = 'mock-test-cat-list';
            return view('admin.mock-test.categories.edit', $data_msg);
			
        } else {

            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editQuestionCategoryAction(Request $request, $id) {
        
        $data_msg = array();
        
        if (Auth::guard('admins')->check()) {
            
            $data_msg['menu_parent'] = 'mock-test';
            $data_msg['menu_child'] = 'mock-test-cat-list';

            if ($request->method() === "POST") {
              
            $article_info=QuestionCategory::find($id);
            $slug = $this->createSlug($request->cat_name,$id);
            $article_cat_data=array(
                'name' =>  $request->input('cat_name'),
                'status' =>  $request->input('status'),
                'slug'=>$slug
            );
            
            $article_info=$article_info->update($article_cat_data);

                $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Mock Test category updated successfully ');
                    
                return redirect()->intended(route('editMockCategory',['id'=>\Hasher::encode($id)]))->with('messageClass', 'alert alert-success')
                                    ->with('message', 'Mock Test category updated successfully ');
            }
            	
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
		
		
        
    }


    // Mock Question
    public function createMockQuestion(Request $request) {
        $data_msg = array();
        $data_msg["subjects"] = \App\SubjectMaster::where('status',1)->orderBy('subject_name', 'asc')->get();
        $data_msg["exams"] = \App\ExamMaster::where('status',1)->orderBy('exam_name', 'asc')->get();
        $data_msg["papers"] = \App\PaperMaster::where('status',1)->orderBy('paper_name', 'asc')->get();
        $data_msg["question_levels"] = \App\MockQuestionLevel::where('is_active',1)->orderBy('updated_at', 'desc')->get();

        $data_msg['pagetitle'] = 'Mock Question';
        
        if (Auth::guard('admins')->check()) {
           // try{
            $data_msg['menu_parent'] = 'mock-test';
            $data_msg['menu_child'] = 'questionslist';

            if ($request->method() === "POST") {
                $modelAttributes = $request->all();
                $rules = array(
                    'question' => 'required',
                    'option_type' => 'required',
                    'is_active' => 'required'
                );
               
                $validator = Validator::make($modelAttributes, $rules);
                if ($validator->fails()) {
                    $request->merge(array('add_form_validate' => 1));
                    //print_r($request->all());die('jjj');
                    $input['add_form_validate'] = '1';
                    return redirect('createMockCategory')
                                ->withErrors($validator)
                                ->withInput();
                } 
                //return $modelAttributes;
                $model = new MockQuestionMaster();
                $model->question=$modelAttributes['question'];
                $model->option_type=$modelAttributes['option_type'];
                $model->is_active=$modelAttributes['is_active'];
                $model->save();  
                
                $exam_id=$request->input('exam_id');
                $j=0;
                foreach($exam_id as $exam){
                    $mock_data=[
                        'question_id'=>$model->id,
                        'level_id'=>$request->level_id[$j],
                        'exam_id'=>$request->exam_id[$j],
                        'paper_id'=>$request->paper_id[$j],
                        'subject_id'=>$request->subject_id[$j],
                    ];
                    MockQuestionDetailsMaster::create($mock_data);
                    $j++;
                }
                           
                $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Question successfully created');
                        
                return redirect()->intended(route('editMockQuestion',['id'=>Hasher::encode($model->id)]))->with('messageClass', 'alert alert-success')
                                        ->with('message', 'Question successfully created');
            }
            	   return view('admin.mock-test.questions_master.create', $data_msg);

            // }catch(\Exception $e){
            //     return redirect()->back()->with('messageClass', 'alert alert-danger')
            //                             ->with('message', $e->getMessage())->withInput();
            // }
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

   
    public function showMockQuestionList()
    {
        //dd(\App\ArticleCategory::find(1)->articles);
        $data_msg = array();
        if (Auth::guard('admins')->check())
        {
            $data_msg['menu_parent'] = 'mock-test';
            $data_msg['menu_child'] = 'questionslist';
            $data_msg['pagetitle'] = 'Mock Question';

            $data_msg["subjects"] = \App\SubjectMaster::where('status',1)->orderBy('subject_name', 'asc')->get();
            $data_msg["levels"] = \App\MockQuestionLevel::where('is_active',1)->orderBy('name', 'asc')->get();
            $data_msg["option_types"] = ['None','Simple','Conjugate'];
            $data_msg['allPapers'] = DB::table('paper_masters as pm')
            ->join('exam_masters as em', 'pm.exam_id', 'em.id')
            ->select('pm.id', 'pm.paper_name', 'em.exam_name')
            ->get();
            return view('admin.mock-test.questions_master.list', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function ajaxMockQuestionList(Request $request)
    {

        if ($request->ajax())
        {
            $question = $request->input('question');
            $level_id = $request->input('level_id');
            $paper_id = $request->input('paper_id');
            $subject_id = $request->input('subject_id');
            $option_type = $request->input('option_type');
            
            
            $arrSearch[] =['id','<>',0];
            $arrQDetailsSearch[] =['id','<>',0];
            
            if ($question != '') {
                $arrSearch[] = ['question', 'like', '%' . $question . '%'];
            }
            
            
            if ($level_id != '') {
                $arrSearch[] = ['level_id', $level_id];
            }
            if ($subject_id != '') {
                $arrQDetailsSearch[] = ['subject_id', $subject_id];
            }
            if ($paper_id != '') {
                $arrQDetailsSearch[] = ['paper_id', $paper_id];
            }
            if ($option_type != '') {
                $arrSearch[] = ['option_type',$option_type];
            }
            // DB::connection()->enableQueryLog();
            // $items = MockQuestionMaster::where($arrSearch);
            $items = MockQuestionMaster::whereHas('questionDetails', function($q) use ($arrQDetailsSearch){ 
                $q->where($arrQDetailsSearch);
            })->where($arrSearch);
            

            $items = $items->get();
            $queries = DB::getQueryLog();
            // dd($queries);
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

            $column = array( 'id','name','category_id','status');


            if ($order[0]['column'] != '') {
                $column_name = $column[$order[0]['column']];
            } else {
                //$column_name = $column[4];
                $column_name = 'id';
                
            }

           
            $asc_desc = 'desc';
            

            
            $items_1 = MockQuestionMaster::with('questionDetails')->where($arrSearch);

            $items_1 = $items_1->orderBy($column_name, $asc_desc)
                    ->skip($iDisplayStart)
                    ->take($iDisplayLength)
                    ->get();

            $sl = 1;
            $opt_types=['None','Simple','Conjugate'];
            // dd($paper);
            foreach ($items_1 as $t)
            {
               
               
                if ($t->status == '1') {
                    $status = '<span class="label label-sm label-success"> Active </span>';
                }else{
                    $status = '<span class="label label-sm label-warning">Inactive</span>';

                }
                //echo "<pre>";
                // dd($t->questionDetails[0]->paper);
                $level=$subject=$paper=[];
                if(isset($t->questionDetails)){
                    $count=count($t->questionDetails);
                    for($j=0;$j<$count;$j++){
                        $level[]=@$t->questionDetails[$j]->level->name;
                        $subject[]=@$t->questionDetails[$j]->subject->subject_name;
                        $paper[]=@$t->questionDetails[$j]->paper->paper_name;
                    }
                    $level=array_unique($level);
                }
                $paper=array_unique($paper);
                @$levels=implode(', ',$level);
                $subjects=implode(', ',$subject);
                $papers=implode(', ',$paper);
                //foreach($t->questionDetails as $quse);
                //die;
                
                $content=Str::limit($t->question, 150, $end='...'); 

                $records["data"][] = array(
                    
                    $sl,
                    $content,
                    @$levels,
                    @$papers,
                    @$subjects,
                   // @$t->questionDetails[0]->level->name,
                   // @$t->questionDetails[0]->subject->subject_name,
                    //$t->subject->subject_name,
                    $opt_types[$t->option_type],
                    '<a href="'.route('editMockQuestion',['id'=>Hasher::encode($t->id)]).'" class="btn btn-sm btn-default edit-btn margin-bottom-5"><i class="fa fa-eye"></i> Edit </a>
                    <a href="javascript:void(0)"  class="btn btn-sm btn-default remove-order edit-btn confirmation" data-value="'.$t->id.'" ><i class="fa fa-trash"></i> Delete </a>'
                    
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

    public function editMockQuestion(Request $request, $id) {
        
        if (Auth::guard('admins')->check()) {
            $data_msg = array();
            $data_msg["subjects"] = \App\SubjectMaster::where('status',1)->orderBy('subject_name', 'asc')->get();
            $data_msg["exams"] = \App\ExamMaster::where('status',1)->orderBy('exam_name', 'asc')->get();
            $data_msg["papers"] = \App\PaperMaster::where('status',1)->orderBy('paper_name', 'asc')->get();
            $data_msg["question_levels"] = \App\MockQuestionLevel::where('is_active',1)->orderBy('updated_at', 'desc')->get();
            
            $data_msg['menu_parent'] = 'mock-test';
            $data_msg['menu_child'] = 'questionslist';

           
            $question =MockQuestionMaster::with('questionOptions')->with('questionAnswers')->with('questionDetails')->find($id); 
            // dd($question->questionDetails); 
            $exam=$paper=$subject=$level=[];
            $data_msg['question_details']=$question->questionDetails;
            if(!empty($question_details)){
                foreach ($question_details as $question_detail) {
                   $exam[]=$question_detail->exam_id;
                   $paper[]=$question_detail->paper_id;
                   //$subject[]=$question_detail->subject_id;
                   $level[]=$question_detail->level_id;
                }

            }
            $data['exam']=$exam;
            $data['paper']=$paper;
            $data['subject']=$subject;
            $data['level']=$level;
            
            $data_msg["question"] = $question;
            
            $data_msg["pagetitle"] = 'Question';
            // dd($data_msg);
            
            return view('admin.mock-test.questions_master.edit', $data_msg);
			
        } else {

            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editMockQuestionAction(Request $request, $id) 
    {
        $modelAttributes = $request->all();
        $model = MockQuestionMaster::find($id);
        
        $model->question=$modelAttributes['question'];
        $model->option_type=$modelAttributes['option_type'];
        $model->correct_explanation=$modelAttributes['correct_explanation'];
        $model->is_active=$modelAttributes['is_active'];
        //dd($model);
        $model->save();  


        $mock_options=[];

        
            
            $i=$j=1;
            //echo "<pre>";
            $deleteMockOpt=MockQuestionOptions::where('question_id',$id)->delete();
            foreach ($request->input() as $key => $value) {
                if((strpos($key, 'option_text') !== false ) && $value != '') {
                    $serial_no=$request->input('option_no'.$i);
                    $option_col_text=$request->input('option_col_text'.$i);
                    $other_option_serial_no=$request->input('option_col_no'.$i);
                    $opton_data=[
                        'question_id' => $id,
                        'option_text' => $value,
                        'serial_no'   => $serial_no,
                        'other_option_text'=> $option_col_text,
                        'other_option_serial_no'=>$other_option_serial_no
                        
                    ];
                   //print_r($opton_data);
                    
                    MockQuestionOptions::create($opton_data);
                    $i++;
                }
            }
           // die;
            $deleteMockQueOpt=MockQuestionAnswers::where('question_id',$id)->delete();
            
            foreach ($request->input() as $key => $value) {
                if((strpos($key, 'answer') !== false ) && $value != '') {
                    $correct=$request->input('is_correct'.$j)!=""?$request->input('is_correct'.$j):0;
                    $answer_data=[
                        'question_id' => $id,
                        'serial_no'   => $request->input('ans_serial_no'.$j),
                        'answer' => $value,
                        //'correct_explanation'=>$request->input('correct_explanation'.$j),
                        'is_correct'=>$correct,
                    ];
                   //print_r($answer_data);
                    MockQuestionAnswers::create($answer_data);
                    $j++;
                }
            }
            $deleteMockDetail=MockQuestionDetailsMaster::where('question_id',$id)->delete();

            $exam_id=$request->input('exam_id');
                $j=0;
                foreach($exam_id as $exam){
                    $mock_data=[
                        'question_id'=>$model->id,
                        'level_id'=>$request->level_id[$j],
                        'exam_id'=>$request->exam_id[$j],
                        'paper_id'=>$request->paper_id[$j],
                        'subject_id'=>$request->subject_id[$j],
                    ];
                    MockQuestionDetailsMaster::create($mock_data);
                    $j++;
                }
           //die;
        \Session::flash('messageClass', 'alert alert-success');
        \Session::flash('message', 'Updated successfully');
            
            return back();
       
        
    }
    public function ajaxQuestionDelete(Request $request)
    {
        $question_id=$request->question_id;
        $model = MockQuestionMaster::find($question_id)->delete();
        $deleteMockOpt=MockQuestionOptions::where('question_id',$question_id)->delete();
        $deleteMockDetail=MockQuestionDetailsMaster::where('question_id',$question_id)->delete();


        //return $request->$model;
        return response()->json( array('success' => $model) );


    }
   


    public function notFound($lng) {

        return view('errors.404');
    } 
}