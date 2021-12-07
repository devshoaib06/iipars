<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;


use Auth;
use View;
use DB;

use Validator;
use App\MockTemplateDetails;
use App\MockTemplate;
use App\MockQuestionLevel;
use Hasher;
use Illuminate\Support\Carbon;

class MockTemplateController extends Controller
{
	public function __construct() 
	{
        $shareData = array();
        
		
        
        View::share($shareData);
	}

    public function createMockTemplate(Request $request) {
    
        $data_msg = array();
       

        $data_msg['pagetitle']="Mock Test Pattern - Create";
        $data_msg['form_url']=route('createMockTemplate');
    
        $data_msg['rules']=\App\MockTabulationRule::where('is_active',1)->get();
        $data_msg["question_levels"] = \App\MockQuestionLevel::where('is_active',1)->orderBy('updated_at', 'desc')->get();
        $data_msg['templateDetails']=[];

        
        if (Auth::guard('admins')->check()) {
            try{
                $data_msg['menu_parent'] = 'mock-test';
                $data_msg['menu_child'] = 'mock-template';
                
                if ($request->method() === "POST") {
                    
                    $modelAttributes = $request->all();
                    $model = new MockTemplate($modelAttributes);
                    $model->save();
                    //return $modelAttributes;
                    
                    $levels=$modelAttributes['level_id'];
                    for($i=0;$i<count($levels);$i++){
                        $templateDetails = new MockTemplateDetails();

                        $templateDetails->template_id=$model->id;
                        $templateDetails->level_id=$modelAttributes['level_id'][$i];
                        $templateDetails->number_of_questions=$modelAttributes['number_of_questions'][$i];
                        $templateDetails->marks_per_question=$modelAttributes['marks_per_question'][$i];

                        $templateDetails->save();

                    }
                
                
                $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Mock Test Pattern successfully created');
                        
                return redirect()->intended(route('showMockTemplateList'))->with('messageClass', 'alert alert-success')
                                        ->with('message', 'Mock Test Pattern successfully created');
            }
            	   return view('admin.mock-test.template._form', $data_msg);

            }catch(\Exception $e){
                return redirect()->back()->with('messageClass', 'alert alert-danger')
                                        ->with('message', $e->getMessage())->withInput();
            }
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }
   
   
    
    public function showMockTemplateList()
    {
        $data_msg = array();
        if (Auth::guard('admins')->check())
        {
            $data_msg['menu_parent'] = 'mock-test';
            $data_msg['menu_child'] = 'mock-test-cat-list';
            //$categories=QuestionCategory::all();
            //$data_msg['categories']=$categories;
            return view('admin.mock-test.template.list',$data_msg);
            
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }
    public function ajaxMockTemplateList(Request $request)
    {

        if ($request->ajax())
        {
            $question = $request->input('question');
            $category = $request->input('category');
            $is_active = $request->input('is_active');
            
            
            $arrSearch[] =['is_active','<>',3] ;
            
            if ($question != '') {
                $arrSearch[] = ['question', 'like', '%' . $question . '%'];
            }
            
            
            if ($category != '') {
                $arrSearch[] = ['category_id', $category];
            }
            if ($is_active != '') {
                $arrSearch[] = ['is_active',$is_active];
            }

            $items = MockTemplate::where($arrSearch);

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

            $column = array( 'id','name','duration','is_active');


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
            

            
            $items_1 =MockTemplate::where($arrSearch);

            $items_1 = $items_1->orderBy($column_name, $asc_desc)
                    ->skip($iDisplayStart)
                    ->take($iDisplayLength)
                    ->get();
            $sl = 1;
            foreach ($items_1 as $t)
            {
                $level=[];
                foreach ($t->templateDetails as $templateDetail) {
                   $level[]= $templateDetail->level->name;
                } 
               //return($t->templateDetails[0]->level);die;
                if ($t->is_active == '1') {
                    $status = '<span class="label label-sm label-success"> Active </span>';
                }else{
                    $status = '<span class="label label-sm label-warning">Inactive</span>';

                }
                
                //return $t->tabRule->name;
                $records["data"][] = array(
                    
                    $sl,
                    $t->name,
                    $t->duration,
                    @$t->tabRule->name,
                    implode(', ',$level),
                    $status,
                    '<a href="'.route('editMockTemplate',['id'=>Hasher::encode($t->id)]).'" class="btn btn-sm btn-default"><i class="fa fa-eye"></i> Edit </a>'
                    
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
    public function editMockTemplate(Request $request, $id) {
        
        if (Auth::guard('admins')->check()) {
            
            $data_msg = array();
            
            $data_msg['pagetitle']="Mock Test Pattern - Edit";
            $data_msg['form_url']=route('editMockTemplateAction',['id'=>Hasher::encode($id)]);

            $data_msg['menu_parent'] = 'mock-test';
            $data_msg['menu_child'] = 'mock-template';
            
            $mocktemplate =MockTemplate::find($id);  
            
            $data_msg["mocktemplate"] = $mocktemplate;
            $data_msg['templateDetails']=$mocktemplate->templateDetails;

            $data_msg['rules']=\App\MockTabulationRule::where('is_active',1)->get();
            $data_msg["question_levels"] = \App\MockQuestionLevel::where('is_active',1)->orderBy('updated_at', 'desc')->get();
            
           
            return view('admin.mock-test.template._form', $data_msg);
			
        } else {

            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }
    public function editMockTemplateAction(Request $request, $id)
    {
        $modelAttributes = $request->all();
        //return $modelAttributes;
        $model =  MockTemplate::find($id);
        $model->update($modelAttributes);
        
        $levels=$modelAttributes['level_id'];
        $deleteMockOpt=MockTemplateDetails::where('template_id',$id)->delete();
        
        for($i=0;$i<count($levels);$i++){
            $templateDetails = new MockTemplateDetails();

            $templateDetails->template_id=$id;
            $templateDetails->level_id=$modelAttributes['level_id'][$i];
            $templateDetails->number_of_questions=$modelAttributes['number_of_questions'][$i];
            $templateDetails->marks_per_question=$modelAttributes['marks_per_question'][$i];

            $templateDetails->save();
            
           
        }

        $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Mock Test Pattern successfully created');
                        
                return redirect()->intended(route('editMockTemplate',['id'=>Hasher::encode($id)]))->with('messageClass', 'alert alert-success')
                                        ->with('message', 'Mock Test Pattern successfully created');
    }

    public function createMockTemplateDetails(Request $request) {
    
        $data_msg = array();
        $data_msg["question_levels"] = MockQuestionLevel::where('is_active',1)->orderBy('updated_at', 'desc')->get();
        $data_msg["templates"] = MockTemplate::where('is_active',1)->orderBy('updated_at', 'desc')->get();

        $data_msg['pagetitle']="Mock Test Pattern - Create";
        $data_msg['form_url']=route('createMockTemplateDetails');
    
        
        if (Auth::guard('admins')->check()) {
            try{
                $data_msg['menu_parent'] = 'mock-test';
                $data_msg['menu_child'] = 'questions-template-detail';
                
                if ($request->method() === "POST") {
                    
                    $modelAttributes = $request->all();
                    $model = new MockTemplateDetails($modelAttributes);
                    $model->save();
                
                
                $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Mock Test Pattern successfully created');
                        
                return redirect()->intended(route('showMockTemplateDetailsList'))->with('messageClass', 'alert alert-success')
                                        ->with('message', 'Mock Test Pattern successfully created');
            }
            	   return view('admin.mock-test.template_details._form', $data_msg);

            }catch(\Exception $e){
                return redirect()->back()->with('messageClass', 'alert alert-danger')
                                        ->with('message', $e->getMessage())->withInput();
            }
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }
   
   
    
    public function showMockTemplateDetailsList()
    {
        $data_msg = array();
        if (Auth::guard('admins')->check())
        {
            $data_msg['menu_parent'] = 'mock-test';
            $data_msg['menu_child'] = 'mock-test-cat-list';
            
            return view('admin.mock-test.template_details.list',$data_msg);
            
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }
    public function ajaxMockTemplateDetailsList(Request $request)
    {

        if ($request->ajax())
        {
            $question = $request->input('question');
            $category = $request->input('category');
            $is_active = $request->input('is_active');
            
            
            $arrSearch[] =['id','<>',0] ;
            
            if ($question != '') {
                $arrSearch[] = ['question', 'like', '%' . $question . '%'];
            }
            
            
            if ($category != '') {
                $arrSearch[] = ['category_id', $category];
            }
            if ($is_active != '') {
                $arrSearch[] = ['qm.is_active',$is_active];
            }

            $items = MockTemplateDetails::where($arrSearch);

            $items = $items->get();

            //dd($items[0]->template->name);
            
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

            $column = array( 'id','name','duration','is_active');


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
            

            
            $items_1 =MockTemplateDetails::where($arrSearch);

            $items_1 = $items_1->orderBy($column_name, $asc_desc)
                    ->skip($iDisplayStart)
                    ->take($iDisplayLength)
                    ->get();
            $sl = 1;
            foreach ($items_1 as $t)
            {
               
               
                if ($t->is_active == '1') {
                    $status = '<span class="label label-sm label-success"> Active </span>';
                }else{
                    $status = '<span class="label label-sm label-warning">Inactive</span>';

                }
                
                
                $records["data"][] = array(
                    
                    $sl,
                    $t->template->name,
                    $t->level->name,                    
                    $t->number_of_questions,
                    $t->marks_per_question,
                    '<a href="'.route('editMockTemplateDetails',['id'=>Hasher::encode($t->id)]).'" class="btn btn-sm btn-default"><i class="fa fa-eye"></i> Edit </a>'
                    
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
    public function editMockTemplateDetails(Request $request, $id) {
        
        if (Auth::guard('admins')->check()) {
            
            $data_msg = array();
            $data_msg['pagetitle']="Mock Test Pattern - Edit";
            $data_msg['form_url']=route('editMockTemplateDetailsAction',['id'=>Hasher::encode($id)]);
            
            $data_msg["question_levels"] = MockQuestionLevel::where('is_active',1)->orderBy('updated_at', 'desc')->get();
            $data_msg["templates"] = MockTemplate::where('is_active',1)->orderBy('updated_at', 'desc')->get();
            $data_msg['menu_parent'] = 'mock-test';
            $data_msg['menu_child'] = 'mock-template';
            
            $mocktemplate =MockTemplateDetails::find($id);  
            $data_msg["mocktemplate"] = $mocktemplate;
            
           
            return view('admin.mock-test.template_details._form', $data_msg);
			
        } else {

            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }
    public function editMockTemplateDetailsAction(Request $request, $id)
    {
        $modelAttributes = $request->all();
        //return $modelAttributes;
        $model =  MockTemplateDetails::find($id);
        $model->update($modelAttributes);

        $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Mock Test Pattern successfully updated');
                        
                return redirect()->intended(route('editMockTemplateDetails',['id'=>Hasher::encode($id)]))->with('messageClass', 'alert alert-success')
                                        ->with('message', 'Mock Test Pattern successfully updated');
    }
    
   
    


    public function notFound($lng) {

        return view('errors.404');
    } 
}