<?php

namespace App\Http\Controllers;

use Validator;
use Mail;
use App\Admin;
use App\User;

use App\ExamMaster;
//use App\ModulesAction;
use Hasher;
use App\RoleTopic;
use App\UserRole;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\library\myFunctions;

class ExamController extends Controller {

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

    public function showExamList() {

        if (Auth::guard('admins')->check()) {
			
            $menu_parent = 'products';
            $menu_child = 'list_exam';
			
            return view('admin.courses.exam.list', compact('menu_parent', 'menu_child'));
			if($permission || Auth::guard('admins')->user()->user_type == 1){

			
			}else{
				return view('admin.no-permission', $data_msg);
			}
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function ajaxExamList(Request $request) {

        if ($request->ajax()) {

            $exam_name = $request->input('exam_name');
            $date_from = $request->input('date_from');
            $date_to = $request->input('date_to');
            $status = $request->input('status');

            $arrSearch[] = ['status', '<>', '3'];

            if ($exam_name != '') {
                $arrSearch[] = ['exam_name', 'like', '%' . $exam_name . '%'];
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
                $arrSearch[] = ['status', $status];
            }

           /* if ($testimonial_type != '') {
                $arrSearch[] = ['testimonial_type', $testimonial_type];
            }*/
            $exams = DB::table('exam_masters AS E')
                    ->select('E.id', 'E.exam_name', 'E.created_at', 'E.status')
                    ->where($arrSearch);

            //$coupons = $coupons->get();

            //return $users;
            //$iTotalRecords = count($videos);
            $iTotalRecords = $exams->count();
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
            
            $column = array('#', 'exam_name', 'created_at', 'status', 'action');


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

            $exams = $exams->orderBy($column_name, $asc_desc)
            ->skip($iDisplayStart)
            ->take($iDisplayLength)
            ->get();


            $myFunctions = new myFunctions;

            $sl = 1;
            
            foreach ($exams as $t) {
                $status = '';
                if ($t->status == '1') {
                    $status = '<span class="label label-sm label-success"> Active </span>';
                } else {
                    $status = '<span class="label label-sm label-warning"> Inactive </span>';
                }

                
                              
                $records["data"][] = array(
                    $sl,
                    $t->exam_name,
                    \Carbon\Carbon::parse($t->created_at)->format('d/m/Y'),
                    //$t->created_at,
                    $status,
                    '<a href="' .route('editExam',['id'=>Hasher::encode($t->id)]) . '" class="btn btn-sm btn-default"><i class="fa fa-edit"></i> Edit </a>'
                        
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
            'exam_name' => 'required|max:255',
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

    public function createExams(Request $request) {
        $data_msg = array();

        if (Auth::guard('admins')->check()) {
            
            $data_msg['menu_parent'] = 'products';
            $data_msg['menu_child'] = 'add_exams';

            if ($request->method() === "POST") {
            //return  $request->ip();

                $exam_name = $request->input('exam_name');

                $status = $request->input('status');

                $data_exam_details = array(					
                    'exam_name' => $exam_name,
                    'status' => $status
                );

               				
                $validator = $this->validatorRegisterGeneral($data_exam_details);
                
                if ($validator->fails()) {
                    $val = $validator->errors();
                   // dd($val);
                    return redirect()->intended(route('exams'))->withErrors($val)->withInput();
                }

				
				
				
				$user_id=ExamMaster::create($data_exam_details)->id;
                             
                $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Exams successfully added');
                
                return redirect()->intended(route('exams'))->with('messageClass', 'alert alert-success')
                                ->with('message', 'Exams successfully added');
            }
			
            return view('admin.courses.exam.create', $data_msg);
							
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editExam(Request $request, $id) {
        
        if (Auth::guard('admins')->check()) {
			
            $data_msg = array();

            $exam = ExamMaster::where('status','<>',3)->where(['id'=> $id])->first();
          
            
            $data_msg["exam"] = $exam;
            $data_msg['menu_parent'] = 'exams';
            $data_msg['menu_child'] = 'list_exam';
			
            return view('admin.courses.exam.edit', $data_msg);
			
        } else {

            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editExamAction(Request $request, $id) {

        $data = $request->all();
        
        $validator = $this->validatorRegisterGeneral($data);
        
        if ($validator->fails()) {
            $val = $validator->errors();
            return redirect()->intended(config("constants.admin_prefix") . '/' . 'exams/edit/'.Hasher::encode($id))->withErrors($val)->withInput();
        }
        
         $exam =  ExamMaster::where('status','<>',3)->where(['id'=> $id])->first();



     
         $exam->update($data);

       	
        return redirect()->intended(config("constants.admin_prefix") . '/exams')->with('messageClass', 'alert alert-success')
        ->with('message', 'Updated successfully');
	        
    }

}
