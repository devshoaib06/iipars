<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;


use Auth;
use View;
use DB;

use Validator;
use App\MockTabulationRuleDetails;
use App\MockTabulationRule;
use App\MockQuestionLevel;
use Hasher;
use Illuminate\Support\Carbon;

class MockTabulationRuleController extends Controller
{
	public function __construct() 
	{
        $shareData = array();
        
		
        
        View::share($shareData);
	}

    public function create(Request $request) {
    
        $data_msg = array();
        

        $data_msg['pagetitle']="Mock Tabulation Rule - Create";
        $data_msg['form_url']=route('createMockTabRule');
        $data_msg["question_levels"] = MockQuestionLevel::where('is_active',1)->orderBy('updated_at', 'desc')->get();
        
        
        if (Auth::guard('admins')->check()) {
            try{
                $data_msg['menu_parent'] = 'mock-test';
                $data_msg['menu_child'] = 'tab-rule';
                
                if ($request->method() === "POST") {
                    
                    $modelAttributes = $request->all();
                    $model = new MockTabulationRule($modelAttributes);
                    $model->save();


                    // $details=[
                    //     'rule_id'=>$model->id,
                    //     'level_id'=>$request->level_id,
                    //     'correctness'=>$request->correctness,
                    //     'marks'=>$request->marks,
                    //     'is_active'=>$request->is_active,
                    // ];

                    // MockTabulationRuleDetails::create($details);

                    
                
                
                $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Mock Tabulation Rule successfully created');
                        
                return redirect()->intended(route('showMockTabRuleList'))->with('messageClass', 'alert alert-success')
                                        ->with('message', 'Mock Tabulation Rule successfully created');
            }
            	   return view('admin.mock-test.tabulation_rule._form', $data_msg);

            }catch(\Exception $e){
                return redirect()->back()->with('messageClass', 'alert alert-danger')
                                        ->with('message', $e->getMessage())->withInput();
            }
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }
   
   
    
    public function show()
    {
        $data_msg = array();
        if (Auth::guard('admins')->check())
        {
            $data_msg['menu_parent'] = 'mock-test';
            $data_msg['menu_child'] = 'tab-rule';
            //$categories=QuestionCategory::all();
            //$data_msg['categories']=$categories;
            return view('admin.mock-test.tabulation_rule.list',$data_msg);
            
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }
    public function ajaxList(Request $request)
    {

        if ($request->ajax())
        {
            $name = $request->input('name');
            
            $is_active = $request->input('is_active');
            
            
            $arrSearch[] =['is_active','<>',3] ;
            
            if ($name != '') {
                $arrSearch[] = ['name', 'like', '%' . $name . '%'];
            }
            
            
            
            if ($is_active) {
                $arrSearch[] = ['is_active',$is_active];
            }
            
            //dd($is_active);
            $items = MockTabulationRule::where($arrSearch);

            $items = $items->get();
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
            

            
            $items_1 =MockTabulationRule::where($arrSearch);

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
                    '<a href="'.route('editMockTabRule',['id'=>Hasher::encode($t->id)]).'" class="btn btn-sm btn-default"><i class="fa fa-eye"></i> Edit </a>'
                    
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
    public function edit(Request $request, $id) {
        
        if (Auth::guard('admins')->check()) {
            
            $data_msg = array();
            
            $data_msg['pagetitle']="Mock Tabulation Rule - Edit";
            $data_msg['form_url']=route('editMockTabRuleAction',['id'=>Hasher::encode($id)]);

            $data_msg['menu_parent'] = 'mock-test';
            $data_msg['menu_child'] = 'tab-rule';
            
            $mocktemplate =MockTabulationRule::find($id);  
            $data_msg["mocktemplate"] = $mocktemplate;
            
           
            return view('admin.mock-test.tabulation_rule._form', $data_msg);
			
        } else {

            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }
    public function update(Request $request, $id)
    {
        $modelAttributes = $request->all();
        //return $modelAttributes;
        $model =  MockTabulationRule::find($id);
        $model->update($modelAttributes);

        $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Mock Tabulation Rule successfully created');
                        
                return redirect()->intended(route('editMockTabRule',['id'=>Hasher::encode($id)]))->with('messageClass', 'alert alert-success')
                                        ->with('message', 'Mock Tabulation Rule successfully created');
    }

    public function createDetails(Request $request) {
    
        $data_msg = array();
        $data_msg["question_levels"] = MockQuestionLevel::where('is_active',1)->orderBy('updated_at', 'desc')->get();
        $data_msg["tabrules"] = MockTabulationRule::where('is_active',1)->orderBy('updated_at', 'desc')->get();

        $data_msg['pagetitle']="Mock Tabulation Rule - Create";
        $data_msg['form_url']=route('createMockTabRuleDetails');
    
        
        if (Auth::guard('admins')->check()) {
            try{
                $data_msg['menu_parent'] = 'mock-test';
                $data_msg['menu_child'] = 'tab-rule-detail';
                
                if ($request->method() === "POST") {
                    
                    $modelAttributes = $request->all();
                    $model = new MockTabulationRuleDetails($modelAttributes);
                    $model->save();
                
                
                $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Mock Tabulation Rule successfully created');
                        
                return redirect()->intended(route('showMockTabRuleDetailsList'))->with('messageClass', 'alert alert-success')
                                        ->with('message', 'Mock Tabulation Rule successfully created');
            }
            	   return view('admin.mock-test.tabulation_rule_details._form', $data_msg);

            }catch(\Exception $e){
                return redirect()->back()->with('messageClass', 'alert alert-danger')
                                        ->with('message', $e->getMessage())->withInput();
            }
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }
   
   
    
    public function showDetailsList()
    {
        $data_msg = array();
        if (Auth::guard('admins')->check())
        {
            $data_msg['menu_parent'] = 'mock-test';
            $data_msg['menu_child'] = 'tab-rule-detail';
            
            return view('admin.mock-test.tabulation_rule_details.list',$data_msg);
            
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }
    public function ajaxDetailsList(Request $request)
    {

        if ($request->ajax())
        {
            $name = $request->input('name');
            
            $is_active = $request->input('is_active');
            
            
            $arrSearch[] =['id','<>',0] ;
            
            if ($name != '') {
                $arrSearch[] = ['name', 'like', '%' . $name . '%'];
            }
            
            
            
            if ($is_active != '') {
                $arrSearch[] = ['is_active',$is_active];
            }

            $items = MockTabulationRuleDetails::where($arrSearch);

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
            

            
            $items_1 =MockTabulationRuleDetails::where($arrSearch);

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
                    $t->tabrule->name,
                    $t->level->name,                    
                    $t->correctness,
                    $t->marks,
                    '<a href="'.route('editMockTabRuleDetails',['id'=>Hasher::encode($t->id)]).'" class="btn btn-sm btn-default"><i class="fa fa-eye"></i> Edit </a>'
                    
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
    public function editDetails(Request $request, $id) {
        
        if (Auth::guard('admins')->check()) {
            
            $data_msg = array();
            $data_msg['pagetitle']="Mock Tabulation Rule - Edit";
            $data_msg['form_url']=route('editMockTabRuleDetailsAction',['id'=>Hasher::encode($id)]);
            
            $data_msg["question_levels"] = MockQuestionLevel::where('is_active',1)->orderBy('updated_at', 'desc')->get();
            $data_msg["tabrules"] = MockTabulationRule::where('is_active',1)->orderBy('updated_at', 'desc')->get();

            $data_msg['menu_parent'] = 'mock-test';
            $data_msg['menu_child'] = 'tab-rule-detail';
            
            $mocktemplate =MockTabulationRuleDetails::find($id);  
            $data_msg["mocktemplate"] = $mocktemplate;
            
           
            return view('admin.mock-test.tabulation_rule_details._form', $data_msg);
			
        } else {

            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }
    public function editDetailsAction(Request $request, $id)
    {
        $modelAttributes = $request->all();
        //return $modelAttributes;
        $model =  MockTabulationRuleDetails::find($id);
        $model->update($modelAttributes);

        $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Mock Tabulation Rule successfully updated');
                        
                return redirect()->intended(route('editMockTabRuleDetails',['id'=>Hasher::encode($id)]))->with('messageClass', 'alert alert-success')
                                        ->with('message', 'Mock Tabulation Rule successfully updated');
    }
    
   
    


    public function notFound($lng) {

        return view('errors.404');
    } 
}