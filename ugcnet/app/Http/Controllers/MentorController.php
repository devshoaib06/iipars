<?php

namespace App\Http\Controllers;

use Validator;
use Mail;
use App\Admin;
use App\User;
use App\Student;
use App\Country;
//use App\ModulesAction;
use Hasher;
use App\RoleTopic;
use App\UserType;
//use App\Models\City;
//use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\library\myFunctions;
use App\MentorMaster;
use App\Helpers\ImageHelper;
use Storage;


class MentorController extends Controller {

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

    public function showMentorList() {

        if (Auth::guard('admins')->check()) {
			
			// && Auth::guard('admins')->user()->user_type == 1
			
            $menu_parent = 'users';
            $menu_child = 'mentors';
			
			//$permission = getUserRolePermission(Auth::guard('admins')->user()->id,'admin-view');
            return view('admin.users.mentor.list', compact('menu_parent', 'menu_child'));
			
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function ajaxMentorList(Request $request) {

        if ($request->ajax()) {

            $name = $request->input('name');
            $qualification = $request->input('qualification');
            $is_featured = $request->input('is_featured');
            $status = $request->input('status');


            $arrSearch[] = ['status', '<>', '3'];
            //$arrSearch[] = ['user_type_id', '2'];


            if ($qualification != '') {
                $arrSearch[] = ['qualification', 'like', '%' . $qualification . '%'];
            }
            if ($name != '') {
                $arrSearch[] = ['name', 'like', '%' . $name . '%'];
            }

            

            if ($is_featured != '') {
                $arrSearch[] = ['is_featured', $is_featured];
            }
            if ($status != '') {
                $arrSearch[] = ['status', $status];
            }



            $users = DB::table('mentor_masters')->where($arrSearch);
            $users = $users->get();

            //return $users;

            $iTotalRecords = count($users);



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

            $column = array('#', 'image', 'name', 'qualification','is_featured','status','action','id');


            if ($order[0]['column'] != '') {
                $column_name = $column[$order[0]['column']];
            } else {
                $column_name = $column[7];
            }

            if ($order[0]['dir'] != '') {
                $asc_desc = $order[0]['dir'];
            } else {
                $asc_desc = 'desc';
            }

            $users_1 = DB::table('mentor_masters')->where($arrSearch);

            $users_1 = $users_1->orderBy($column_name, $asc_desc)
                    ->skip($iDisplayStart)
                    ->take($iDisplayLength)
                    ->get();

            $sl = 1;
            foreach ($users_1 as $t) {
                $status = '';
                if ($t->status == '1') {
                    $status = '<span class="label label-sm label-success"> Active </span>';
                } else {
                    $status = '<span class="label label-sm label-warning"> Inactive </span>';
                }
                if ($t->is_featured == '1') {
                    $featured = '<span class="label label-sm label-success"> Yes </span>';
                } else {
                    $featured = '<span class="label label-sm label-warning"> No </span>';
                }
                $filename=$t->image;
                $imgsrc=Storage::disk(config('disk.get_mentor'))->url($filename);
                


                $records["data"][] = array(
                    $sl,
                    '<img src='.$imgsrc.' width="100px" height="100px">',
                    $t->name,
                    $t->qualification,
                    $featured,
                    $status,
                    '<a href="' .route('editMentor',['id'=>Hasher::encode($t->id)]) . '" class="btn btn-sm btn-default"><i class="fa fa-edit"></i> Edit </a>'
                        
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
            'first_name' => 'required|max:20|min:3',
            'last_name' => 'required|max:20|min:3',
            'country_id' => 'required',
            'sex' => 'required',
            'address' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ];

        return Validator::make($data, $validate);
    }

    public function createMentor(Request $request) {
        $data_msg = array();

        if (Auth::guard('admins')->check()) {
            
            $data_msg['menu_parent'] = 'users';
            $data_msg['menu_child'] = 'mentors';

            if ($request->method() === "POST") {
                $filename="";
                if($request->hasFile('image')){
                    //return $request;
                    
                    $uploadedFile = $request->image;
                    $filename=ImageHelper::savePdfForGallery($uploadedFile,config('disk.get_mentor'));
                }
                $mentor_data = array(
                    'name' => $request->name,
                    'qualification' => $request->qualification,
                    'image' => $filename,
                    'is_featured'=>$request->is_featured,
                    'status'=>$request->status
                );
                MentorMaster::create($mentor_data);

                $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Mentor successfully added');
                    
                return redirect()->intended(route('mentors'))->with('messageClass', 'alert alert-success')
                                    ->with('message', 'Mentor successfully added');
            }
            	return view('admin.users.mentor.create', $data_msg);
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editMentor(Request $request, $id) {
        
        if (Auth::guard('admins')->check()) {

			
            $data_msg = array();

            $user_info =MentorMaster::find($id);  
                        
            $data_msg["user_info"] = $user_info;
            $data_msg['menu_parent'] = 'users';
            $data_msg['menu_child'] = 'students';


            $data_msg['allCountries'] = Country::where('status', '<>', '3')
                            ->orderBy('country_name', 'desc')->get();
			
			
            return view('admin.users.mentor.edit', $data_msg);
			
        } else {

            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editMentorAction(Request $request, $id) {

       //return $request;
        $name = $request->input('name');
        $qualification = $request->input('qualification');
        $status = $request->input('status');
        $is_featured = $request->input('is_featured');

        
        $userDetails = MentorMaster::find($id);
        $filename=$userDetails->image;
        if($request->hasFile('image')){
            //return $request;
            $exists = Storage::disk(config('disk.get_mentor'))->url($filename);
            if($exists){
                Storage::disk(config('disk.get_mentor'))->delete($filename);
            }
            
            $uploadedFile = $request->image;
            $filename=ImageHelper::savePdfForGallery($uploadedFile,config('disk.get_mentor'));
        }

        $data_user_details = array(
			'name' => $name,
            'qualification' => $qualification,
            'image'=>$filename,
            'is_featured' => $is_featured,
            'status' => $status
        );

		
		
        $updated_user_info=$userDetails->update($data_user_details);
		
        

        \Session::flash('messageClass', 'alert alert-success');
        \Session::flash('message', 'Updateded successfully');
		
		return back();
		
		
        
    }
       
  
}
