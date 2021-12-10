<?php

namespace App\Http\Controllers;

use Validator;
use Mail;
use App\Admin;
use App\User;

use App\SubjectMaster;
//use App\ModulesAction;
use Hasher;
use App\RoleTopic;
use App\UserRole;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\library\myFunctions;
use App\ExamMaster;

class SubjectController extends Controller {

    public function __construct() {
        $lang = Session::get('variableLocale');
        if ($lang != null) {
            Session::put('variableLocale', 'en');
            \App::setLocale($lang);
        }
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

    

    //User    

    public function showSubjectList() {

        if (Auth::guard('admins')->check()) {
			
            $menu_parent = 'products';
            $menu_child = 'list_subject';

            $allExams = ExamMaster::where('status', '<>', '3')
                            ->orderBy('exam_name', 'desc')->get();
           
			
            return view('admin.courses.subject.list', compact('menu_parent', 'menu_child','allExams'));
			if($permission || Auth::guard('admins')->user()->user_type == 1){

			
			}else{
				return view('admin.no-permission', $data_msg);
			}
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function ajaxSubjectList(Request $request) {

        if ($request->ajax()) {

            $subject_name = $request->input('subject_name');
            $exam_id = $request->input('exam_id');

            $date_from = $request->input('date_from');
            $date_to = $request->input('date_to');
            $status = $request->input('status');

            $arrSearch[] = ['S.status', '<>', '3'];

            if ($subject_name != '') {
                $arrSearch[] = ['subject_name', 'like', '%' . $subject_name . '%'];
            }
            if ($exam_id != '') {
                $arrSearch[] = ['S.exam_id', 'like', '%' . $exam_id . '%'];
            }

            if ($date_from != '') {

                $d_p_d = explode('/', $date_from);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $date_from = $d_p_d_m;

                $arrSearch[] = ['created_at', '>=', $date_from];
            }

            if ($date_to != '') {

                $d_p_d = explode('/', $date_to);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $date_to = $d_p_d_m;

                $arrSearch[] = ['created_at', '<=', $date_to];
            }

          
            if ($status != '') {
                $arrSearch[] = ['S.status', $status];
            }

           /* if ($testimonial_type != '') {
                $arrSearch[] = ['testimonial_type', $testimonial_type];
            }*/
            $subjects = DB::table('subject_masters AS S')
                    ->select('S.id','E.exam_name', 'S.subject_name', 'S.created_at', 'S.status')
                    ->join('exam_masters as E','E.id','S.exam_id')
                    ->where($arrSearch);

            //$coupons = $coupons->get();

            //return $users;
            //$iTotalRecords = count($videos);
            $iTotalRecords = $subjects->count();
            //$iTotalRecords = 120;
            $iDisplayLength = intval($_REQUEST['length']);
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            $iDisplayStart = intval($_REQUEST['start']);
            $sEcho = intval($_REQUEST['draw']);

            $records = array();
            $records["data"] = array();

            $end = $iDisplayStart + $iDisplayLength;
            $end = $end > $iTotalRecords ? $iTotalRecords : $end;


            $order = $request->input('order');
            
            $column = array('#', 'subject_name', 'exam_name','created_at', 'S.status', 'action');


            if ($order[0]['column'] != '') {
                $column_name = $column[$order[0]['column']];
            } else {
                $column_name = $column[4];
            }

            if ($order[0]['dir'] != '') {
                $asc_desc = $order[0]['dir'];
            } else {
                $asc_desc = 'desc';
            }

            $subjects = $subjects->orderBy($column_name, $asc_desc)
            ->skip($iDisplayStart)
            ->take($iDisplayLength)
            ->get();


            $myFunctions = new myFunctions;

            $sl = 1;
            
            foreach ($subjects as $t) {
                $status = '';
                if ($t->status == '1') {
                    $status = '<span class="label label-sm label-success"> Active </span>';
                } else {
                    $status = '<span class="label label-sm label-warning"> Inactive </span>';
                }

                
                              
                $records["data"][] = array(
                    $sl,
                    $t->subject_name,
                    $t->exam_name,
                    \Carbon\Carbon::parse($t->created_at)->format('d/m/Y'),
                    $status,
                    '<a href="' .route('editSubject',['id'=>Hasher::encode($t->id)]) . '" class="btn btn-sm btn-default"><i class="fa fa-edit"></i> Edit </a>'
                        
                );

                $sl++;
            }

            $records["draw"] = $sEcho;
            $records["recordsTotal"] = $iTotalRecords;
            $records["recordsFiltered"] = $iTotalRecords;


            echo json_encode($records);
        }
    }

    protected function validatorRegisterGeneral(array $data) {
        //dd($data);
        $validate = [
            'subject_name' => 'required|max:255',
            'status' => 'required',
        ];

       /*if( $data['testimonial_type'] == 1 ) {
            $validate = [  
                'video_url' => 'required|is_url' 
            ];
        }

        if( $data['testimonial_type'] == 2 ) {
            $validate['testimonial_text'] = 'required';
        }*/

        return Validator::make($data, $validate);
    }

    public function createSubjects(Request $request) {
        $data_msg = array();

        if (Auth::guard('admins')->check()) {
            
            $data_msg['menu_parent'] = 'products';
            $data_msg['menu_child'] = 'add_subjects';

            $allExams = ExamMaster::where('status', '<>', '3')
                            ->orderBy('exam_name', 'desc')->get()->toArray();
            $data_msg["allExams"] = $allExams;
            if ($request->method() === "POST") {
            //return  $request->ip();

                $subject_name = $request->input('subject_name');
                $exam_id = $request->input('exam_id');

                $status = $request->input('status');

                $data_subject_details = array(					
                    'subject_name' => $subject_name,
                    'exam_id' => $exam_id,
                    'status' => $status
                );

               				
                $validator = $this->validatorRegisterGeneral($data_subject_details);
                
                if ($validator->fails()) {
                    $val = $validator->errors();
                   // dd($val);
                    return redirect()->intended(config("constants.admin_prefix") . '/' . 'subjects/create')->withErrors($val)->withInput();
                }

				
				
				
				$user_id=SubjectMaster::create($data_subject_details)->id;
                             
                $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Subjects successfully added');
                
                return redirect()->intended(route('subjects'))->with('messageClass', 'alert alert-success')
                                ->with('message', 'Subjects successfully added');
            }
			
            return view('admin.courses.subject.create', $data_msg);
							
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editSubject(Request $request, $id) {
        
        if (Auth::guard('admins')->check()) {
			
            $data_msg = array();

            $subject = SubjectMaster::where('status','<>',3)->where(['id'=> $id])->first();
            $allExams = ExamMaster::where('status', '<>', '3')
                            ->orderBy('exam_name', 'desc')->get()->toArray();
            $data_msg["allExams"] = $allExams;
            $data_msg['allPapers'] = DB::table('paper_masters AS pm')
                    ->select('pm.id as paper_id', 'E.exam_name', 'pm.paper_name')
                    ->join('exam_masters as E', 'E.id', 'pm.exam_id')
                    //->join('paper_masters as pm','epmr.paper_id','pm.id')
                    ->where('pm.exam_id', 1)
                    ->where('pm.status', 1)
                    ->get();

            $data_msg["subject"] = $subject;
            $data_msg['menu_parent'] = 'products';
            $data_msg['menu_child'] = 'list_subject';
			// dd($data_msg);
            return view('admin.courses.subject.edit', $data_msg);
			
        } else {

            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editSubjectAction(Request $request, $id) {

        $data = $request->all();
        
        $validator = $this->validatorRegisterGeneral($data);
        
        if ($validator->fails()) {
            $val = $validator->errors();
            return redirect()->intended(config("constants.admin_prefix") . '/' . 'subjects/edit/'.Hasher::encode($id))->withErrors($val)->withInput();
        }
        
         $subject =  SubjectMaster::where('status','<>',3)->where(['id'=> $id])->first();



     
         $subject->update($data);

       	
        return redirect()->intended(config("constants.admin_prefix") . '/subjects')->with('messageClass', 'alert alert-success')
        ->with('message', 'Updated successfully');
	        
    }

}
