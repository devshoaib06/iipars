<?php

namespace App\Http\Controllers;

use Validator;
use Mail;
use App\Admin;
use App\User;

use App\Testimonial;
//use App\ModulesAction;
use Hasher;
use App\RoleTopic;
use App\UserRole;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\library\myFunctions;

class TestimonialController extends Controller {

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

    public function showVideoList() {

        if (Auth::guard('admins')->check()) {
			
            $menu_parent = 'testimonials';
            $menu_child = 'list_testimonial';
			
            return view('admin.testimonial.list', compact('menu_parent', 'menu_child'));
			if($permission || Auth::guard('admins')->user()->user_type == 1){

			
			}else{
				return view('admin.no-permission', $data_msg);
			}
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function ajaxTestimonialList(Request $request) {

        if ($request->ajax()) {

            $student_name = $request->input('student_name');
            $student_course = $request->input('student_course');
            $testimonial_type = $request->input('testimonial_type');
            $status = $request->input('status');

            $arrSearch[] = ['status', '<>', '3'];

            if ($student_name != '') {
                $arrSearch[] = ['student_name', 'like', '%' . $student_name . '%'];
            }

            if ($student_course != '') {
                $arrSearch[] = ['student_course', 'like', '%' . $student_course . '%'];
            }

          
            if ($status != '') {
                $arrSearch[] = ['status', $status];
            }

            if ($testimonial_type != '') {
                $arrSearch[] = ['testimonial_type', $testimonial_type];
            }
            $testimonials = DB::table('testimonials AS T')
                    ->select('T.id', 'T.student_name', 'T.student_course', 'T.testimonial_type', 'T.testimonial_text', 'T.video_url', 'T.status')
                    ->where($arrSearch);

           // $videos = $videos->get();

            //return $users;
            //$iTotalRecords = count($videos);
            $iTotalRecords = $testimonials->count();
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

            $column = array('#', 'student_name', 'student_course', 'testimonial_type', 'status', 'action');


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

            $testimonials = $testimonials->orderBy($column_name, $asc_desc)
            ->skip($iDisplayStart)
            ->take($iDisplayLength)
            ->get();


            $myFunctions = new myFunctions;

            $sl = 1;
            foreach ($testimonials as $t) {
                $status = '';
                if ($t->status == '1') {
                    $status = '<span class="label label-sm label-success"> Active </span>';
                } else {
                    $status = '<span class="label label-sm label-warning"> Inactive </span>';
                }

                $testimonial_type = '';
                if ($t->testimonial_type == '1') {
                    $testimonial_type = 'Video';
                } else {
                    $testimonial_type = 'Text';
                }
                              
                $records["data"][] = array(
                    $sl,
                    $t->student_name,
                    $t->student_course,
                    $testimonial_type,
                    $status,
                    '<a href="' .route('editTestimonial',['id'=>Hasher::encode($t->id)]) . '" class="btn btn-sm btn-default"><i class="fa fa-edit"></i> Edit </a>'
                        
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
            'student_name' => 'required|max:255',
            'student_course' => 'required|max:255',
            'testimonial_type' => 'required|max:255',            
            'status' => 'required',
        ];

        if( $data['testimonial_type'] == 1 ) {
            $validate = [  
                'video_url' => 'required|is_url' 
            ];
        }

        if( $data['testimonial_type'] == 2 ) {
            $validate['testimonial_text'] = 'required';
        }

        return Validator::make($data, $validate);
    }

    public function createTestimonials(Request $request) {
        $data_msg = array();

        if (Auth::guard('admins')->check()) {
            
            $data_msg['menu_parent'] = 'testimonials';
            $data_msg['menu_child'] = 'add_testimonials';

            if ($request->method() === "POST") {
            //return  $request->ip();

                $student_name = $request->input('student_name');
                $student_course = $request->input('student_course');
                $testimonial_type = $request->input('testimonial_type');
                $testimonial_text = $request->input('testimonial_text');
                $video_url = $request->input('video_url');

                $status = $request->input('status');

                $data_video_details = array(					
                    'student_name' => $student_name,
                    'student_course' => $student_course,
                    'testimonial_type' => $testimonial_type,
                    'status' => $status
                );

                if( $testimonial_type == 1 ) {
                    $data_video_details['video_url'] = $video_url;
                }

                if( $testimonial_type == 2 ) {
                    $data_video_details['testimonial_text'] = $testimonial_text;
                }

				
                $validator = $this->validatorRegisterGeneral($data_video_details);
                
                if ($validator->fails()) {
                    $val = $validator->errors();
                   // dd($val);
                    return redirect()->intended(config("constants.admin_prefix") . '/' . 'testimonials/create')->withErrors($val)->withInput();
                }

				
				
				
				$user_id=Testimonial::create($data_video_details)->id;
                             
                $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Testimonials successfully added');
                
                return redirect()->intended(route('testimonials'))->with('messageClass', 'alert alert-success')
                                ->with('message', 'Testimonials successfully added');
            }
			
            return view('admin.testimonial.create', $data_msg);
							
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editTestimonial(Request $request, $id) {
        
        if (Auth::guard('admins')->check()) {
			
            $data_msg = array();

            $testimonial = Testimonial::where('status','<>',3)->where(['id'=> $id])->first();
          
            
            $data_msg["testimonial"] = $testimonial;
            $data_msg['menu_parent'] = 'videos';
            $data_msg['menu_child'] = 'students';
			
            return view('admin.testimonial.edit', $data_msg);
			
        } else {

            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editVideoAction(Request $request, $id) {

        $data = $request->all();
        
        $validator = $this->validatorRegisterGeneral($data);
        
        if ($validator->fails()) {
            $val = $validator->errors();
            return redirect()->intended(config("constants.admin_prefix") . '/' . 'testimonials/edit/'.Hasher::encode($id))->withErrors($val)->withInput();
        }
      
        $testimonial =  Testimonial::where('status','<>',3)->where(['id'=> $id])->first();
        $testimonial->update($data);
	
        return redirect()->intended(config("constants.admin_prefix") . '/testimonials')->with('messageClass', 'alert alert-success')
        ->with('message', 'Updated successfully');
	        
    }

}
