<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;


use Auth;
use View;
use DB;

use Validator;

use App\MockQuestionLevel;

use Hasher;
use Illuminate\Support\Carbon;

class MockQuestionLevelController extends Controller
{
	public function __construct() 
	{
        $shareData = array();
        
		
        
        View::share($shareData);
	}

    public function createQuestionLevel(Request $request) {
    
        $data_msg = array();
        

        $data_msg['pagetitle']="Mock Question Level - Create";
        $data_msg['form_url']=route('createQuestionLevel');
    
        
        if (Auth::guard('admins')->check()) {
            try{
                $data_msg['menu_parent'] = 'mock-test';
                $data_msg['menu_child'] = 'questions-level';
                
                if ($request->method() === "POST") {
                    
                    $modelAttributes = $request->all();
                    $model = new MockQuestionLevel($modelAttributes);
                    $model->save();
                
                
                $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Mock Question successfully created');
                        
                return redirect()->intended(route('showQuestionLevelList'))->with('messageClass', 'alert alert-success')
                                        ->with('message', 'Mock Question successfully created');
            }
            	   return view('admin.mock-test.question_level._form', $data_msg);

            }catch(\Exception $e){
                return redirect()->back()->with('messageClass', 'alert alert-danger')
                                        ->with('message', $e->getMessage())->withInput();
            }
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }
   
   
    
    public function showQuestionLevelList()
    {
        $data_msg = array();
        if (Auth::guard('admins')->check())
        {
            $data_msg['menu_parent'] = 'mock-test';
            $data_msg['menu_child'] = 'questions-level';
            
            //$data_msg['categories']=$categories;
            return view('admin.mock-test.question_level.list',$data_msg);
            
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }
    public function ajaxQuestionLevelList(Request $request)
    {

        if ($request->ajax())
        {
            $name = $request->input('name');
            $category = $request->input('category');
            $is_active = $request->input('is_active');
            
            
            $arrSearch[] =['is_active','<>',3] ;
            
            if ($name != '') {
                $arrSearch[] = ['name', 'like', '%' . $name . '%'];
            }
            
            
           
            if ($is_active != '') {
                $arrSearch[] = ['is_active',$is_active];
            }

            $items = MockQuestionLevel::where($arrSearch);

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
            

            
            $items_1 =MockQuestionLevel::where($arrSearch);

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
                    $t->name,
                    $status,
                    '<a href="'.route('editQuestionLevel',['id'=>Hasher::encode($t->id)]).'" class="btn btn-sm btn-default"><i class="fa fa-eye"></i> Edit </a>'
                    
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
    public function editQuestionLevel(Request $request, $id) {
        
        if (Auth::guard('admins')->check()) {
            
            $data_msg = array();
            
            $data_msg['pagetitle']="Mock Template - Edit";
            $data_msg['form_url']=route('editQuestionLevelAction',['id'=>Hasher::encode($id)]);

            $data_msg['menu_parent'] = 'mock-test';
            $data_msg['menu_child'] = 'questions-level';
            
            $QuestionLevel =MockQuestionLevel::find($id);  
            $data_msg["QuestionLevel"] = $QuestionLevel;
            
           
            return view('admin.mock-test.question_level._form', $data_msg);
			
        } else {

            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }
    public function editQuestionLevelAction(Request $request, $id)
    {
        $modelAttributes = $request->all();
        //return $modelAttributes;
        $model =  MockQuestionLevel::find($id);
        $model->update($modelAttributes);

        

        $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Mock Template successfully created');
                        
                return redirect()->intended(route('editQuestionLevel',['id'=>Hasher::encode($id)]))->with('messageClass', 'alert alert-success')
                                        ->with('message', 'Mock Template successfully created');
    }
    
   
    


    public function notFound($lng) {

        return view('errors.404');
    } 
}