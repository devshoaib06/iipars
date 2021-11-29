<?php

namespace App\Http\Controllers;

use Validator;
use Mail;
use App\Admin;
use App\User;

use App\Video;
//use App\ModulesAction;
use Hasher;
use App\RoleTopic;
use App\UserRole;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\library\myFunctions;

class VideoController extends Controller {

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
			
            $menu_parent = 'videos';
            $menu_child = 'list_video';
			
            return view('admin.video.list', compact('menu_parent', 'menu_child'));
			if($permission || Auth::guard('admins')->user()->user_type == 1){

			
			}else{
				return view('admin.no-permission', $data_msg);
			}
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function ajaxVideoList(Request $request) {

        if ($request->ajax()) {

            $title = $request->input('title');
            $video_url = $request->input('video_url');
            $status = $request->input('status');

            $arrSearch[] = ['status', '<>', '3'];

            if ($title != '') {
                $arrSearch[] = ['title', 'like', '%' . $title . '%'];
            }

            if ($video_url != '') {
                $arrSearch[] = ['video_url', 'like', '%' . $video_url . '%'];
            }

          
            if ($status != '') {
                $arrSearch[] = ['status', $status];
            }
            $videos = DB::table('videos AS V')
                    ->select('V.id', 'V.title', 'V.video_url', 'V.is_home', 'V.status')
                    ->where($arrSearch);

            //$videos = $videos->get();

            //return $users;
            //$iTotalRecords = count($videos);
            $iTotalRecords = $videos->count();
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

            $column = array('#', 'title', 'video_url', 'status', 'action');


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

            $myFunctions = new myFunctions;

            $videos = $videos->orderBy($column_name, $asc_desc)
            ->skip($iDisplayStart)
            ->take($iDisplayLength)
            ->get();

            $sl = 1;
            foreach ($videos as $t) {
                $status = '';
                if ($t->status == '1') {
                    $status = '<span class="label label-sm label-success"> Active </span>';
                } else {
                    $status = '<span class="label label-sm label-warning"> Inactive </span>';
                }
                              
                $records["data"][] = array(
                    $sl,
                    $t->title,
                    $t->video_url,
                    $status,
                    '<a href="' .route('editVideo',['id'=>Hasher::encode($t->id)]) . '" class="btn btn-sm btn-default"><i class="fa fa-edit"></i> Edit </a>'
                        
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
            'title' => 'required|max:255',
            'video_url' => 'required|is_url',
            'is_home' => 'required',
            'status' => 'required',
        ];

        return Validator::make($data, $validate);
    }

    public function createVideo(Request $request) {
        $data_msg = array();

        if (Auth::guard('admins')->check()) {
            
            $data_msg['menu_parent'] = 'videos';
            $data_msg['menu_child'] = 'add_video';

            if ($request->method() === "POST") {
            //return  $request->ip();

                $title = $request->input('title');
                $video_url = $request->input('video_url');
                $is_home = $request->input('is_home');
                $status = $request->input('status');

                $data_video_details = array(					
                    'title' => $title,
                    'video_url' => $video_url,
                    'is_home' => $is_home,
                    'status' => $status
                );

				
                $validator = $this->validatorRegisterGeneral($data_video_details);
                
                if ($validator->fails()) {
                    $val = $validator->errors();
                   // dd($val);
                    return redirect()->intended(config("constants.admin_prefix") . '/' . 'videos/create')->withErrors($val)->withInput();
                }

				$data_video_details = array(
                    'title' => $title,
                    'video_url' => $video_url,
                    'is_home' => $is_home,
                    'status'=>$status                  
                );
				
				
				$user_id=Video::create($data_video_details)->id;
                             
                $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'video successfully added');
                
                return redirect()->intended(route('videos'))->with('messageClass', 'alert alert-success')
                                ->with('message', 'Video successfully added');
            }
			
            return view('admin.video.create', $data_msg);
							
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editVideo(Request $request, $id) {
        
        if (Auth::guard('admins')->check()) {
			
            $data_msg = array();

            $video = Video::where('status','<>',3)->where(['id'=> $id])->first();
            
            $data_msg["video"] = $video;
            $data_msg['menu_parent'] = 'videos';
            $data_msg['menu_child'] = 'students';
			
            return view('admin.video.edit', $data_msg);
			
        } else {

            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editVideoAction(Request $request, $id) {

        $data = $request->all();
        
        $validator = $this->validatorRegisterGeneral($data);
        
        if ($validator->fails()) {
            $val = $validator->errors();
            return redirect()->intended(config("constants.admin_prefix") . '/' . 'videos/edit/'.Hasher::encode($id))->withErrors($val)->withInput();
        }
      
        $video =  Video::where('status','<>',3)->where(['id'=> $id])->first();
        $video->update($data);
	
        return redirect()->intended(config("constants.admin_prefix") . '/videos')->with('messageClass', 'alert alert-success')
        ->with('message', 'Updated successfully');
	        
    }

}
