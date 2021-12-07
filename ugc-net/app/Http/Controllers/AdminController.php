<?php

namespace App\Http\Controllers;

use Validator;
use Mail;
use App\Admin;
use App\User;
//use App\Country;
//use App\ModulesAction;

use App\RoleTopic;
use App\UserRole;
//use App\Models\City;
//use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\library\myFunctions;

class AdminController extends Controller {

    public function __construct() {
        $lang = Session::get('variableLocale');
        if ($lang != null) {
            Session::put('variableLocale', 'en');
            \App::setLocale($lang);
        }
    }

    /* protected function validatorRegisterBusiness(array $data) {
      $validate = [
      'first_name' => 'required|max:20|min:3',
      'last_name' => 'required|max:20|min:3',
      'name_prefix' => 'required|max:20|min:1',
      'company_name' => 'required|max:200|min:3',
      'display_name' => 'required|max:200|min:3',
      'country_id' => 'required|max:200|min:1',
      'sex' => 'required|max:200|min:1',
      'address' => 'required|max:200|min:3',
      'mobile_number' => 'required|max:30|unique:admin_master',
      'email' => 'required|email|max:255|unique:admin_master',
      'password' => 'required|min:6',
      ];

      return Validator::make($data, $validate);
      } */

    public function index() {

        if (Auth::guard('admins')->check()) {

            $data_msg = array();
            $data_msg['menu_parent'] = 'dashboard';
            $data_msg['menu_child'] = 'dashboard';
            $data_msg['users'] = '';

            $data_msg['result_date'] = array();
            $myLibrary=new \App\library\myFunctions;
            $visitorcount=$myLibrary->getVistiorCount();
            
            $totalStudent = User::where('user_type_id', '=', '2')->get()->count();
            $totalContrubutor = User::where('user_type_id', '=', '3')->get()->count();
            $totalDistributor = User::where('user_type_id', '=', '4')->get()->count();
            $totalCourse = \App\Product::count();
            $totalOrder = \App\Order::count();
            $totalSubscriber = \App\NewsLeterSubscriptionEmail::count();
            
            $data_msg['totalStudent'] = $totalStudent;
            $data_msg['totalContrubutor'] = $totalContrubutor;
            $data_msg['totalDistributor'] = $totalDistributor;
            $data_msg['totalCourse'] = $totalCourse;
            $data_msg['totalOrder'] = $totalOrder;
            $data_msg['totalSubscriber'] = $totalSubscriber;
            $data_msg['visitorcount'] = $visitorcount;
			
            return view('admin.dashboard', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function setLocalLang($locale)
    {
        if (is_null($locale)) {
            return redirect()->back();
        }

        Session::put('variableLocale', $locale);

        return redirect()->back();
    }

    //Admin
    public function editAdmin(Request $request)
    {
        if (Auth::guard('admins')->check()) {
            $data_msg = array();
            //$lang = \App::getLocale();
            //$myFunctions = new myFunctions;
            
            $id = Auth::guard('admins')->user()->id;
            $user_info = Admin::where('id', '=', $id)->get();
            $data_msg["user_info"] = $user_info[0];
            $data_msg['menu_parent'] = '';
            $data_msg['menu_child'] = '';
            //$data_msg['lang'] = $lang;            
            /*$data_msg['allCountries'] = Country::where('status', '<>', '3')
                            ->orderBy('country_name', 'asc')->get();*/

            return view('admin.users.admin.edit', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function adminUpdate(Request $request)
    {
        $id = Auth::guard('admins')->user()->id;
        //$country = $request->input('country');
        //$sex = $request->input('sex');
        //$first_name = $request->input('first_name');
        //$last_name = $request->input('last_name');
        $name = $request->input('name');
        $email = $request->input('email');

       /* $data_uer_details = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'country_id' => $country,
            'sex' => $sex,
            'email' => $email,
        );*/

        $data_uer_details = array(
            'name' => $name,
            'email' => $email,
        );
        $userDetails = Admin::find($id);
        $userDetails->update($data_uer_details);
        $request->session()->flash('messageClass', 'alert alert-success'); //alert-danger
        $request->session()->flash('message', 'Account Info successfully updated.');
        return redirect(config("constants.admin_prefix") . '/profile#tab_1_3');
    }

    public function adminImageUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
                    'profile_pic' => 'image|mimes:jpeg,jpg,png|dimensions:min_width=128|max:1024',
                        ], [
                    'profile_pic.image' => 'Please select image file only',
                    'profile_pic.mimes' => 'Please choose jpg or png file',
                    'profile_pic.dimensions' => 'Minimum width 128 px',
                    'profile_pic.max' => 'Image size too high, need less than 1MB',
        ]);

        if ($validator->fails()) {
            return redirect(config("constants.admin_prefix") . '/profile#tab_2-2')
                            ->withErrors($validator)->withInput();
        }

        $id = Auth::guard('admins')->user()->id;

        if ($request->hasFile('profile_pic')) {
            $profile_pic = $request->file('profile_pic');
            $myFunctions = new myFunctions;
            $size_path = array(
                array('size' => config('constants.user_image_thumb'), 'path' => config('path.absolute_path') . config('path.user_image') . 'thumb/'),
                array('size' => config('constants.user_image_preview'), 'path' => config('path.absolute_path') . config('path.user_image') . 'preview/')
            );
            $profile_image_name = $myFunctions->resize($profile_pic, $size_path);
            $image = $profile_image_name;
        } else {
            $image = 'porfilepic.jpg';
        }
        $data_uer_details = array(
            'image' => $image
        );
        $userDetails = Admin::find($id);
        $userDetails->update($data_uer_details);
        $request->session()->flash('messageClass', 'alert alert-success'); //alert-danger
        $request->session()->flash('message', 'Account Info successfully updated.');
        return redirect(config("constants.admin_prefix") . '/profile#tab_2-2');
    }

    public function adminPasswordUpdate(Request $request)
    {
        $id = Auth::guard('admins')->user()->id;

        $password = md5(trim($request->input('password')));
        $data_uer_details = array(
            'password' => $password
        );
        $userDetails = Admin::find($id);
        $userDetails->update($data_uer_details);
        $request->session()->flash('messageClass', 'alert alert-success'); //alert-danger
        $request->session()->flash('message', 'Account Info successfully updated.');
        return redirect(config("constants.admin_prefix") . '/profile#tab_3-3');
    }

    //User    

    public function showUserList()
    {
        if (Auth::guard('admins')->check()) {
			
			// && Auth::guard('admins')->user()->user_type == 1
			
            $menu_parent = 'users';
            $menu_child = 'user';
			
			$permission = getUserRolePermission(Auth::guard('admins')->user()->id,'admin-view');
			if($permission || Auth::guard('admins')->user()->user_type == 1){

            	return view('admin.users.user.list', compact('menu_parent', 'menu_child'));
			
			 }else{
				return view('admin.no-permission', $data_msg);
			}
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function ajaxUserList(Request $request)
    {

        if ($request->ajax()) {

            $name = $request->input('name');
            $email = $request->input('email');
            $status = $request->input('status');


            $arrSearch[] = ['status', '<>', '3'];
            $arrSearch[] = ['user_type', '2'];


            if ($email != '') {
                $arrSearch[] = ['email', 'like', '%' . $email . '%'];
            }

            /* if ($sex != '') {
              $arrSearch[] = ['admin_master.sex', $sex];
              } */

            if ($status != '') {
                $arrSearch[] = ['status', $status];
            }



            $users = DB::table('users')->select('id', 'first_name', 'last_name', 'email', 'last_login', 'status')
                    ->where($arrSearch);

            if ($name != '') {
                $users = $users->WhereRaw("concat(first_name, ' ', last_name) like '%$name%' ");
            }

            $users = $users->get();

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

            $column = array('#', 'first_name', 'email', 'last_login', 'status', 'action');


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
            //$myFunctions = new \App\library\myFunctions;

            $users_1 = DB::table('users')->select('id', 'first_name', 'last_name', 'email', 'last_login', 'status')
                    ->where($arrSearch);

            if ($name != '') {
                $users_1 = $users_1->WhereRaw("concat(first_name, ' ', last_name) like '%$name%' ");
            }


            $users_1 = $users_1->orderBy($column_name, $asc_desc)
                    ->skip($iDisplayStart)
                    ->take($iDisplayLength)
                    ->get();


            //->toSql();
            //dd($fundsTransactionList);
            //die;

            $sl = 1;
            foreach ($users_1 as $t) {
                $status = '';
                if ($t->status == '1') {
                    $status = '<span class="label label-sm label-success"> Active </span>';
                } else {
                    $status = '<span class="label label-sm label-warning"> Inactive </span>';
                }

                /* if ($t->sex == 'M') {
                  $gender = 'Male';
                  } elseif ($t->sex == 'F') {
                  $gender = 'Female';
                  } else {
                  $gender = '--';
                  } */



                $records["data"][] = array(
                    $sl,
                    $t->first_name . ' ' . $t->last_name,
                    $t->email,
                    $myFunctions->dateText($t->last_login, 'full_all'),
                    /* $collector,
                      $caller_add,
                      $caller_graphics, */
                    //$myFunctions->dateText($t->created_at, 'm_d_y'),
                    $status,
                    '<a href="' . url(config("constants.admin_prefix") . '/user/edit') . '/' . $t->id . '" class="btn btn-sm btn-default"><i class="fa fa-edit"></i> Edit </a>'
                        //'<a href="javascript:void(0)" class="btn btn-sm default btn-editable"><i class="fa fa-eye"></i> View</a>'
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
        $validate = [
            'first_name' => 'required|max:20|min:3',
            'last_name' => 'required|max:20|min:3',
            'country_id' => 'required',
            'sex' => 'required',
            'address' => 'required',
            //'mobile_number' => 'required|max:30|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ];

        return Validator::make($data, $validate);
    }

    public function createUser(Request $request) {
        $data_msg = array();
        //$lang = \App::getLocale();

        $myFunctions = new myFunctions;
        if (Auth::guard('admins')->check()) {
            $data_msg["form_url"] = url(config("constants.admin_prefix") . "/" . "user/create");
            $data_msg['menu_parent'] = 'users';
            $data_msg['menu_child'] = 'user';


            $data_msg['allCountries'] = Country::where('status', '<>', '3')
                            ->orderBy('country_name', 'desc')->get();

            if ($request->method() === "POST") {

                $first_name = $request->input('first_name');
                $last_name = $request->input('last_name');
                $email = $request->input('email');
                $password = $request->input('password');
                $sex = $request->input('sex');
                $country = $request->input('country');
                $address = $request->input('address');
                //$mobile_number = $request->input('mobile_number');
                $status = $request->input('status');

                if ($request->hasFile('profile_pic')) {
                    $profile_pic = $request->file('profile_pic');
                    $size_path = array(
                        array('size' => config('constants.user_image_thumb'), 'path' => config('path.absolute_path') . config('path.user_image') . 'thumb/'),
                        array('size' => config('constants.user_image_preview'), 'path' => config('path.absolute_path') . config('path.user_image') . 'preview/')
                    );
                    $profile_image_name = $myFunctions->resize($profile_pic, $size_path);
                    $image = $profile_image_name;
                } else {
                    $image = 'no_image.png'; //'porfilepic.jpg';
                }


				
				
				
				$admin_users = DB::table('users')
					->select(DB::raw('MAX(id) as max_id'))
                ->where('id','<', 1000)
                ->get();
				
				//echo $admin_users[0]->max_id;
				//echo '<br>';
				$new_id = $admin_users[0]->max_id +1;
				
				//die;
				
				
				
				
				
				
				
				
				
				

                $data_uer_details = array(					
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'country_id' => $country,
                    'sex' => $sex,
                    'address' => $address,
                    'user_type' => '2',
                    'status' => $status,
                    //'mobile_number' => '0',
                    'email' => $email,
                    'password' => md5($password),
                    'image' => $image,
					//'created_at'=> date('now'),
					//'updated_at'=> date('now'),
                );

				//echo $data_uer_details;
				//die;
                $validator = $this->validatorRegisterGeneral($data_uer_details);
                //echo $user->user_id;
				//echo $validator;
               // die;
                if ($validator->fails()) {
                    $val = $validator->errors();
                    //dd($val);
                    return redirect()->intended(config("constants.admin_prefix") . '/' . 'user/create')->withErrors($val)->withInput();
                }


				
				
				
				$data_uer_details = array(
					'id' => $new_id,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'country_id' => $country,
                    'sex' => $sex,
                    'address' => $address,
                    'user_type' => '2',
                    'status' => $status,
                    //'mobile_number' => '0',
                    'email' => $email,
                    'password' => md5($password),
                    'image' => $image
                );
				
				
				DB::table('users')->insert($data_uer_details);
				
				

                //$user = Admin::create($data_uer_details);

                //Confirmation email settings
                //$insertedId = $user->user_id;
                //if ($insertedId) {

                    $request->session()->flash('messageClass', 'alert alert-success');
                    $request->session()->flash('message', 'User successfully added');
                //}

                return redirect()->intended(config("constants.admin_prefix") . '/user/create')->with('messageClass', 'alert alert-success')
                                ->with('message', 'User successfully added');
            }
			
			$permission = getUserRolePermission(Auth::guard('admins')->user()->id,'admin-add');
			if($permission || Auth::guard('admins')->user()->user_type == 1){
			
            	return view('admin.users.user.create', $data_msg);
				
			}else{
				return view('admin.no-permission', $data_msg);
			}
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editUser(Request $request, $id) {

        if (Auth::guard('admins')->check()) {

			// && Auth::guard('admins')->user()->user_type == 1
			
            $data_msg = array();

            $user_info = Admin::where('id', '=', $id)->get();
            $data_msg["user_info"] = $user_info[0];
            $data_msg['menu_parent'] = 'users';
            $data_msg['menu_child'] = 'user';


            $data_msg['allCountries'] = Country::where('status', '<>', '3')
                            ->orderBy('country_name', 'desc')->get();
			
			$allRoleTopic = DB::table('role_topic_master')->where('status', '1')->orderBy('name', 'asc')->get();
			//$data_msg['allRoleTopic'] = RoleTopic::where('status', '<>', '3')
                           // ->orderBy('name', 'desc')->get();

            $data_msg['allRoleTopic'] = $allRoleTopic;
			
			$UserRole = DB::table('user_role')->where('user_id', $id)->get();
			
            $data_msg['UserRole'] = $UserRole;
			
			$permission = getUserRolePermission(Auth::guard('admins')->user()->id,'admin-edit');
			if($permission || Auth::guard('admins')->user()->user_type == 1){

            	return view('admin.users.user.edit', $data_msg);
			
			 }else{
				return view('admin.no-permission', $data_msg);
			}
			
        } else {

            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editUserAction(Request $request, $id) {


        //$country = $request->input('country');
        //$sex = $request->input('sex');
        //$mobile_number = $request->input('mobile_number');
        //$address = $request->input('address');
        //$first_name = $request->input('first_name');
        //$last_name = $request->input('last_name');
		$name = $request->input('name');
        $email = $request->input('email');
       // $mobile_ext = $request->input('mobile_ext');
        //$status = $request->input('status');


        $myFunctions = new myFunctions;

        $data_uer_details = array(
            //'first_name' => $first_name,
            //'last_name' => $last_name,
            //'country_id' => $country,
            //'sex' => $sex,
			'name' => $name,
            'email' => $email,
            //'mobile_ext' => $mobile_ext,
            //'mobile_number' => $mobile_number,
            //'address' => $address,
            //'status' => $status
        );

        $userDetails = User::find($id);
		
		//echo $userDetails->user_type_id;die;
		
        $userDetails->update($data_uer_details);

        \Session::flash('messageClass', 'alert alert-success');
        \Session::flash('message', 'Updateded successfully');
		
		
		if($userDetails->user_type_id == 4){
			return redirect(config("constants.admin_prefix") . '/provider/view/' . \Hasher::encode($id) . '#tab_21-1');
		}else{
			return redirect(config("constants.admin_prefix") . '/owner/view/' . \Hasher::encode($id) . '#tab_21-1');
		}
		
        
    }

    public function userImageUpdate(Request $request, $id) {

        $validator = Validator::make($request->all(), [
                    'profile_pic' => 'image|mimes:jpeg,jpg,png|dimensions:min_width=128|max:1024',
                        ], [
                    'profile_pic.image' => 'Please select image file only',
                    'profile_pic.mimes' => 'Please choose jpg or png file',
                    'profile_pic.dimensions' => 'Minimum width 128 px',
                    'profile_pic.max' => 'Image size too high, need less than 1MB',
        ]);

        if ($validator->fails()) {
            return redirect(config("constants.admin_prefix") . '/user/edit/' . $id . '#tab_2-2')
                            ->withErrors($validator)->withInput();
        }

        if ($request->hasFile('profile_pic')) {
            $profile_pic = $request->file('profile_pic');
            $myFunctions = new myFunctions;
            $size_path = array(
                array('size' => config('constants.user_image_thumb'), 'path' => config('path.absolute_path') . config('path.user_image') . 'thumb/'),
                array('size' => config('constants.user_image_preview'), 'path' => config('path.absolute_path') . config('path.user_image') . 'preview/')
            );
            $profile_image_name = $myFunctions->resize($profile_pic, $size_path);
            $image = $profile_image_name;
        } else {
            $image = 'porfilepic.jpg';
        }
        $data_uer_details = array(
            'image' => $image
        );
        $userDetails = Admin::find($id);
        $userDetails->update($data_uer_details);
        $request->session()->flash('messageClass', 'alert alert-success'); //alert-danger
        $request->session()->flash('message', 'Account Info successfully updated.');
        return redirect(config("constants.admin_prefix") . '/user/edit/' . \Hasher::encode($id) . '#tab_2-2');
    }

    public function userPasswordUpdate(Request $request, $id) {
		
		
        $password = md5($request->input('password'));
        $data_uer_details = array(
            'password' => $password
        );
        $userDetails = Admin::find($id);
        $userDetails->update($data_uer_details);
        $request->session()->flash('messageClass', 'alert alert-success'); //alert-danger
        $request->session()->flash('message', 'Account Info successfully updated.');
        
		
		if($userDetails->user_type_id == 4){
			return redirect(config("constants.admin_prefix") . '/provider/view/' . \Hasher::encode($id) . '#tab_21-1');
		}else{
			return redirect(config("constants.admin_prefix") . '/owner/view/' . \Hasher::encode($id) . '#tab_21-1');
		}
    }

    public function userAccessUpdate(Request $request, $id) {

        //die;
        $modules = $request->input('modules');
        $access = $request->input('access');


        /* $data = array(
          'access' => '',
          );

          $User = Admin::find($id);
          $User->update($data); */
        //$access_txt = "";

        $db_access = array();


        if (count($modules)) {
            foreach ($modules as $key => $value) {
                //echo $value;echo "<br>";
                if ($value) {
                    $view_val = ModulesAction::where([['module_id', $value], ['ordering', 1],])->get();
                    $view_val_id = $view_val[0]->id;
                    $db_access[] = $view_val_id;
                }
            }
        }
        //die;
        if (count($access)) {
            foreach ($access as $key => $value) {
                $db_access[] = $value;
            }
        }
        $access_txt = serialize(array_unique($db_access));
        //print_r($db_access);die;


        $data_uer_details = array(
            'access' => $access_txt,
        );

        $userDetails = Admin::find($id);
        $userDetails->update($data_uer_details);
        $request->session()->flash('messageClass', 'alert alert-success'); //alert-danger
        $request->session()->flash('message', 'Account Info successfully updated.');
        return redirect(config("constants.admin_prefix") . 'user/edit/' . $id . '#tab_1_2');
    }

    public function deletUser(Request $request) {

        if ($request->ajax()) {

            $id = $request->input('id');

            $user = Admin::find($id);
            $data = [
                'status' => '3',
            ];
            $user->update($data);

            exit;
        }
    }

    public function emailExist(Request $request) {
        if ($request->ajax()) {
            $email = $request->input('email');
            $id = $request->input('user_id');
            $user_info = DB::table('users')->where('email', '=', $email)->get();
            if (count($user_info) > 0) {
                echo "false";
            } else {
                echo "true";
            }
        }
    }

    public function emailExistUpdate(Request $request) {
        if ($request->ajax()) {
            $email = $request->input('email');
            $user_id = $request->input('user_id');
            $user_info = DB::table('users')->select()->where('email', '=', $email)->get();
            if (count($user_info) > 0) {
                if ($user_info[0]->id == $user_id) {
                    echo "true";
                } else {
                    echo "false";
                }
            } else {
                echo "true";
            }
        }
    }

    public function mobileNumberExist(Request $request) {
        if ($request->ajax()) {
            $mobile_number = $request->input('mobile_number');
            $id = $request->input('user_id');
            $user_info = DB::table('users')->where('mobile_number', '=', $mobile_number)->get();
            if (count($user_info) > 0) {
                echo "false";
            } else {
                echo "true";
            }
        }
    }

    public function mobileNumberExistUpdate(Request $request) {
        if ($request->ajax()) {
            $mobile_number = $request->input('mobile_number');
            $user_id = $request->input('user_id');
            $user_info = DB::table('users')->select()->where('mobile_number', '=', $mobile_number)->get();
            if (count($user_info) > 0) {
                if ($user_info[0]->id == $user_id) {
                    echo "true";
                } else {
                    echo "false";
                }
            } else {
                echo "true";
            }
        }
    }

    public function fetchUser(Request $request) {
        if ($request->ajax()) {
            $user_total = array();
            $all_month_array = array();
            $counter = 0;
            $zero = 0;
            $last_date = date('Y-m-t');

            for ($i = 1; $i < 6; $i++) {
                $last_month_array[] = date('Y-m-01', strtotime("-$i month"));
            }

            for ($i = 1; $i < 6; $i++) {
                $all_month_array[$i] = date('m', strtotime("-$i month"));
            }
            $all_month_array = array_reverse($all_month_array);
            $all_month_array[6] = date('m');
            $final_month = array_reverse($all_month_array);
            $users = DB::table('users')
                    ->select(DB::raw("DATE_FORMAT(created_at, '%Y') as 'year', DATE_FORMAT(created_at, '%m') as 'month', COUNT(user_id) as 'total'"))
                    ->whereRaw(DB::raw("created_at <= '" . $last_date . "' AND created_at >='" . end($last_month_array) . "' and user_type = '2' AND status <> '3' GROUP BY DATE_FORMAT(created_at, '%Y%m')"))
                    ->get();
            $containing_month = array();
            foreach ($users as $per_user) {
                //$user_total[] = date('F', mktime(0, 0, 0, $per_user->month, 10)) . "," . $per_user->month;
                $user_total[$per_user->month] = $per_user->total;
                $containing_month[] = $per_user->month;
            }
            foreach ($all_month_array as $month) {
                if (in_array($month, $containing_month)) {
                    $final_info_month[] = array(date('F', mktime(0, 0, 0, $month, 10)), (int) $user_total[$month]);
                } else {
                    $final_info_month[] = array(date('F', mktime(0, 0, 0, $month, 10)), (int) $zero);
                }
            }
            echo json_encode($final_info_month);
        }
    }

    public function changeUserStatus(Request $request) {

        if ($request->ajax()) {

            $user_id = $request->input('user_id');
            $status = $request->input('status');
            if ($status) {
                $status = '1';
            } else {
                $status = '0';
            }

            $data = [
                'status' => $status,
            ];

            $user = User::find($user_id);
            $user->update($data);


            if ($user) {
                return 1;
            } else {
                return 0;
            }
        }
    }    
    
    public function changeUserComplain(Request $request) {

        if ($request->ajax()) {

            $user_id = $request->input('user_id');
            $certificate = $request->input('has_valid_complain');
            if ($certificate) {
                $certificate = 1;
            } else {
                $certificate = 0;
            }

            $data = [
                'has_valid_complain' => $certificate,
            ];

            $user = User::find($user_id);
            $user->update($data);


            if ($user) {
                return 1;
            } else {
                return 0;
            }
        }
    }
    
    

    //Owner


    public function showOwnerList() {


        if (Auth::guard('admins')->check()) {

            $data_msg = array();

            
            $data_msg["allLocations"] = array();


            $data_msg['menu_parent'] = 'users';
            $data_msg['menu_child'] = 'owner';



            $allState = \App\State::where('status', '<>', '3')->orderBy('name', 'asc')->get();
            $data_msg['allState'] = $allState;

            

            $allCategory = \App\Category::where('type', '=', 'P')->where('parent_id', '=', null)->orderBy('name', 'asc')->get();
            $data_msg['allCategory'] = $allCategory;



			

            return view('admin.users.owner.list', $data_msg);
			
			
			
        } else {
            return redirect()->intended('admin/login');
        }
    }

    public function ajaxOwnerList(Request $request) {

        if ($request->ajax()) {

            $myFunctions = new \App\library\myFunctions;

            $name = $request->input('name');
            $email = $request->input('email');
            $state_id = $request->input('state_id');
            $city = $request->input('city');            
            $phone = $request->input('phone');
            

            $pet = $request->input('pet');

            $date_from = $request->input('date_from');
            $date_to = $request->input('date_to');

            //$profile_status = $request->input('profile_status');
            //$status = $request->input('status');
			//$aaa_certificate = $request->input('aaa_certificate');
            

            //ActualCode
            /*if (isset($email)) {
                session(['ses_email' => $email]);
            } else {
                $email = Session::get('ses_email');
            }*/
            //ActualCode

           
            $arrSearch[] = ['users.user_type_id', '3'];

            if ($date_from != '') {

                $d_p_d = explode('/', $date_from);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[0] . '-' . $d_p_d[1];
                $date_from = $d_p_d_m . ' 00:00:00';
                $date_from = $myFunctions->dateTextUserToServer($date_from, 'dt_tm');
                $arrSearch[] = ['users.created_at', '>=', $date_from];
            }

            if ($date_to != '') {

                $d_p_d = explode('/', $date_to);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[0] . '-' . $d_p_d[1];
                $date_to = $d_p_d_m . ' 23:59:00';
                $date_to = $myFunctions->dateTextUserToServer($date_to, 'dt_tm');
                $arrSearch[] = ['users.created_at', '<=', $date_to];
            }

           
            
            if ($state_id != '') {
                $arrSearch[] = ['users.state_id', $state_id];
            }

            if ($city != '') {
                $arrSearch[] = ['users.city', $city];
            }

            if ($phone != '') {
                $arrSearch[] = ['phone', 'like', '%' . $phone . '%'];
            }

            if ($pet != '') {
                $arrSearch[] = ['child_cat.parent_id', $pet];
            }


            


            
            /*if ($status != '') {
                $arrSearch[] = ['users.status', $status];
            }
			
			if ($aaa_certificate != '') {
				if($aaa_certificate == '5'){
					$arrSearch[] = ['users.applied_certificate', '1'];
				}else{
                $arrSearch[] = ['users.aaa_certificate', $aaa_certificate];
				}
            }*/



            /*   $users = DB::table('users')->select('first_name', 'last_name', 'sex', 'username', 'postcode', 'region', 'city', 'email',  'users.created_at', 'users.id', 'users.status')

              ->where($arrSearch); */

            $users = DB::table('users')->distinct()->select('users.name as user_name', 'email', 'states.name as state_name', 'city', 'phone', 'users.created_at', 'users.id as user_id')
                    ->leftJoin('states', 'users.state_id', '=', 'states.id')
                    ->leftJoin('pets', 'users.id', '=', 'pets.user_id')
                    ->leftJoin('categories as child_cat', 'child_cat.id', '=', 'pets.category_id')
                    ->leftJoin('categories as parent_cat', 'child_cat.parent_id', '=', 'parent_cat.id')
                    ->where($arrSearch);

            

            

            $users = $users->where(function ($query) use ($name) {
                if ($name != '') {
                    $query->orWhere('users.name', 'like', '%' . $name . '%');
                }
            });

            $users = $users->where(function ($query) use ($email) {
                if ($email != '') {
                    $query->orWhere('email', 'like', '%' . $email . '%');
                }
            });


            //$users = $users->groupBy('users.id');

            $users = $users->get();

            $iTotalRecords = count($users);



            //$iTotalRecords = 120;
            $iDisplayLength = intval($_REQUEST['length']);
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            session(['ses_frl_length' => $iDisplayLength]);

            $iDisplayStart = intval($_REQUEST['start']);
            session(['ses_frl_start' => $iDisplayStart]);

            $sEcho = intval($_REQUEST['draw']);

            $records = array();
            $records["data"] = array();

            $end = $iDisplayStart + $iDisplayLength;
            $end = $end > $iTotalRecords ? $iTotalRecords : $end;


            $order = $request->input('order');
            session(['ses_frl_order' => $order]);


            $column = array('#', 'user_name', 'email','state_name', 'city',  'phone','pet','users.created_at', 'action');



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



      

            $users_1 = DB::table('users')->distinct()->select('users.id as u_id','users.name as user_name', 'email', 'states.name as state_name', 'city', 'phone', 'users.created_at', 'users.id as user_id')
                    ->leftJoin('states', 'users.state_id', '=', 'states.id')
                    ->leftJoin('pets', 'users.id', '=', 'pets.user_id')
                    ->leftJoin('categories as child_cat', 'child_cat.id', '=', 'pets.category_id')
                    ->leftJoin('categories as parent_cat', 'child_cat.parent_id', '=', 'parent_cat.id')
                    ->where($arrSearch);        
            


            $users_1 = $users_1->where(function ($query) use ($name) {
                if ($name != '') {
                    $query->orWhere('users.name', 'like', '%' . $name . '%');
                }
            });

            $users_1 = $users_1->where(function ($query) use ($email) {
                if ($email != '') {
                    $query->orWhere('email', 'like', '%' . $email . '%');
                }
            });


            $users_1 = $users_1->orderBy($column_name, $asc_desc)
                    ->skip($iDisplayStart)
                    ->take($iDisplayLength);
            

            $sql_tot = $users_1->toSql();
            
            //$sql = $users_1->toSql();

            //$users_1 = $users_1->groupBy('users.id');

            $users_1 = $users_1->get();



            
            //dd($sql);
            //die;
            //$sl = 1;
            $sl = $iDisplayStart;
            foreach ($users_1 as $t) {
                $profile_status = '';

                



                $status = '';
                
				
				$aaa_certificate = '';
				

                


                $records["data"][] = array(
                    ++$sl,
                    $t->user_name,
                    $t->email,
                    $t->state_name,
                    $t->city,
					$t->phone,  
                    getUserPetCategory($t->u_id),                
                    $myFunctions->dateText($t->created_at, 'm_d_y'),                    
                   //'<a href="javascript:void(0)" class="btn btn-sm default btn-editable"><i class="fa fa-eye"></i> View</a>'
                    '<a href="' . url(config("constants.admin_prefix") . '/owner/view') . '/' . \Hasher::encode($t->user_id) . '" class="btn btn-sm default btn-editable"><i class="fa fa-eye"></i> View</a>'
                );

                //$sl++;
            }


            $records["draw"] = $sEcho;
            $records["recordsTotal"] = $iTotalRecords;
            $records["recordsFiltered"] = $iTotalRecords;
            $records["sql_tot"] = $sql_tot;
            //$records["name"] = $name;
            //$records["sess_name"] = Session::get('ses_frl_name');
            


            echo json_encode($records);
        }
    }

    public function viewOwner($id) {
        //echo $id; die;

        if (Auth::guard('admins')->check()) {

            
            $data_msg = array();
            $data_msg['menu_parent'] = 'users';
            $data_msg['menu_child'] = 'owner';


            $userDetails = User::find($id);
            $data_msg['userDetails'] = $userDetails;


            
            
          
            
            
            /*$total_referral_earning = DB::table('user_referral_history')
                ->select(DB::raw('SUM(amount_earn) as total_amount_earn'))
                ->where('user_id', '=', $id)    
                //->groupBy('department')
                //->havingRaw('SUM(price) > ?', [2500])
                ->get();*/

            $data_msg['total_referral_earning'] = 1;

           // $data_msg['connect_history'] = ConnectHistory::where(['user_id' => $id, 'status' => 1])->get();

            //$data_msg['connect_history'] = ConnectHistory::where(['user_id' => $id, 'status' => 1])->get();
            /*$query = "SELECT * from ( (SELECT user_id,connect as tot_connect,messages_to,dr_or_cr,promocode,add_connect_by,DATE_FORMAT(created_at,'%y-%m-%d') AS posted_at FROM connect_history WHERE dr_or_cr <> 1 AND user_id = $id AND status = 1) UNION ALL (SELECT user_id,sum(connect) as tot_connect,messages_to,dr_or_cr,null,null, DATE_FORMAT(created_at,'%y-%m-%d') as posted_at FROM connect_history  WHERE  dr_or_cr = 1 AND status = 1 AND user_id = $id GROUP BY messages_to,posted_at ) ) a ORDER BY posted_at ASC";

            $query = "SELECT * FROM `connect_history` where  user_id = $id AND status = 1 ORDER BY created_at  ASC";

            $results = DB::select($query);*/

            $data_msg['connect_history'] = array();

            //print_r($data_msg); die;
            
            //$permission = getUserRolePermission(Auth::guard('admins')->user()->id,'member-edit');
            //if($permission || Auth::guard('admins')->user()->user_type == 1){
            
            return view('admin.users.owner.edit', $data_msg);
            
            //}else{
                //return view('admin.no-permission', $data_msg);
            //}
            
        } else {
            return redirect()->intended('admin/login');
        }
    }
    

   

    
    //Provider

    public function showProviderList() {


        if (Auth::guard('admins')->check()) {

            $data_msg = array();

            
            


            $data_msg['menu_parent'] = 'users';
            $data_msg['menu_child'] = 'provider';




            $allState = \App\State::where('status', '<>', '3')->orderBy('name', 'asc')->get();
            $data_msg['allState'] = $allState;

            

            $allCategory = \App\Category::where('type', '=', 'S')->where('parent_id', '=', null)->orderBy('name', 'asc')->get();
            $data_msg['allCategory'] = $allCategory;

            

                return view('admin.users.provider.list', $data_msg);
            
            
            
        } else {
            return redirect()->intended('admin/login');
        }
    }

    public function ajaxProviderList(Request $request) {

        if ($request->ajax()) {

            $myFunctions = new \App\library\myFunctions;

            $name = $request->input('name');
            $email = $request->input('email');
            $state_id = $request->input('state_id');
            $city = $request->input('city');      
            $contact_per = $request->input('contact_per');        
            $certificate = $request->input('certificate');                  
            $category = $request->input('category');
            

            $date_from = $request->input('date_from');
            $date_to = $request->input('date_to');

            //$profile_status = $request->input('profile_status');
            //$status = $request->input('status');
           
            

            //ActualCode
            /*if (isset($email)) {
                session(['ses_email' => $email]);
            } else {
                $email = Session::get('ses_email');
            }*/
            //ActualCode

           
            $arrSearch[] = ['users.user_type_id', '4'];

            if ($date_from != '') {

                $d_p_d = explode('/', $date_from);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[0] . '-' . $d_p_d[1];
                $date_from = $d_p_d_m . ' 00:00:00';
                $date_from = $myFunctions->dateTextUserToServer($date_from, 'dt_tm');
                $arrSearch[] = ['users.created_at', '>=', $date_from];
            }

            if ($date_to != '') {

                $d_p_d = explode('/', $date_to);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[0] . '-' . $d_p_d[1];
                $date_to = $d_p_d_m . ' 23:59:00';
                $date_to = $myFunctions->dateTextUserToServer($date_to, 'dt_tm');
                $arrSearch[] = ['users.created_at', '<=', $date_to];
            }

           
            
            if ($state_id != '') {
                $arrSearch[] = ['users.state_id', $state_id];
            }

            if ($city != '') {
                $arrSearch[] = ['users.city', $city];
            }

            if ($contact_per != '') {
                $arrSearch[] = ['users.contact_per', $contact_per];
            }

            if ($certificate != '') {
                $arrSearch[] = ['users.certificate', $certificate];
            }

            if ($category != '') {
                $arrSearch[] = ['store_categories.category_id', $category];
            }


            
            /*if ($status != '') {
                $arrSearch[] = ['users.status', $status];
            }
            
          */



            /*   $users = DB::table('users')->select('first_name', 'last_name', 'sex', 'username', 'postcode', 'region', 'city', 'email',  'users.created_at', 'users.id', 'users.status')

              ->where($arrSearch); */

            $users = DB::table('users')->distinct()->select('users.name as user_name', 'email', 'states.name as state_name', 'users.city',  'contact_per','users.created_at', 'users.id as user_id','certificate')
                    ->leftJoin('states', 'users.state_id', '=', 'states.id')
                    ->leftJoin('stores', 'users.id', '=', 'stores.user_id')
                    ->leftJoin('store_categories', 'stores.id', '=', 'store_categories.store_id')
                    ->where($arrSearch);

            $users = $users->where(function ($query) use ($name) {
                if ($name != '') {
                    $query->orWhere('users.name', 'like', '%' . $name . '%');
                }
            });

            $users = $users->where(function ($query) use ($email) {
                if ($email != '') {
                    $query->orWhere('email', 'like', '%' . $email . '%');
                }
            });



            //$users = $users->groupBy('users.id');

            $users = $users->get();

           

            $iTotalRecords = count($users);



            //$iTotalRecords = 120;
            $iDisplayLength = intval($_REQUEST['length']);
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            session(['ses_frl_length' => $iDisplayLength]);

            $iDisplayStart = intval($_REQUEST['start']);
            session(['ses_frl_start' => $iDisplayStart]);

            $sEcho = intval($_REQUEST['draw']);

            $records = array();
            $records["data"] = array();

            $end = $iDisplayStart + $iDisplayLength;
            $end = $end > $iTotalRecords ? $iTotalRecords : $end;


            $order = $request->input('order');
            session(['ses_frl_order' => $order]);


            $column = array('#', 'user_name', 'email','state_name', 'city',  'contact_per','category' , 'certificate','users.created_at',  'action');



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



      

            $users_1 = DB::table('users')->distinct()->select('users.id as u_id','users.name as user_name', 'email', 'states.name as state_name', 'users.city', 'contact_per', 'users.created_at', 'users.id as user_id','certificate')
                    ->leftJoin('states', 'users.state_id', '=', 'states.id')
                    ->leftJoin('stores', 'users.id', '=', 'stores.user_id')
                    ->leftJoin('store_categories', 'stores.id', '=', 'store_categories.store_id')
                    ->where($arrSearch);        
            
            $users_1 = $users_1->where(function ($query) use ($name) {
                if ($name != '') {
                    $query->orWhere('users.name', 'like', '%' . $name . '%');
                }
            });         

            $users_1 = $users_1->where(function ($query) use ($email) {
                if ($email != '') {
                    $query->orWhere('email', 'like', '%' . $email . '%');
                }
            });


            $users_1 = $users_1->orderBy($column_name, $asc_desc)
                    ->skip($iDisplayStart)
                    ->take($iDisplayLength);
            

            //$users_1 = $users_1->groupBy('users.id');        

            $sql_tot = $users_1->toSql();
            
            //$sql = $users_1->toSql();
            $users_1 = $users_1->get();



            
            //dd($sql);
            //die;
            //$sl = 1;
            $sl = $iDisplayStart;
            foreach ($users_1 as $t) {
                $profile_status = '';

                



                $status = '';
                
                
                $aaa_certificate = '';
                

                
                $certificate = '<input type="checkbox" class="make-switch" data-on-text="Yes" data-off-text="No"';

                if ($t->certificate == '1') {
                $certificate .= ' checked ';
                }
            $certificate .= 'data-on-color="success" data-off-color="warning" data-size="small" onChange="change_certificate('.$t->u_id.')" name="certificate" id="certificate_'.$t->u_id.'" >'; 

                //$certificate = 'Yes';


                $records["data"][] = array(
                    ++$sl,
                    $t->user_name,
                    $t->email,
                    $t->state_name,
                    $t->city,
                    $t->contact_per,                    
                    getUserStoreCategory($t->u_id),  
                    $certificate,
                    $myFunctions->dateText($t->created_at, 'm_d_y'),
                  /* '<a href="javascript:void(0)" class="btn btn-sm default btn-editable"><i class="fa fa-eye"></i> View</a>'*/
                    '<a href="' . url(config("constants.admin_prefix") . '/provider/view') . '/' . \Hasher::encode($t->user_id) . '" class="btn btn-sm default btn-editable"><i class="fa fa-eye"></i> View</a>'
                );

                //$sl++;
            }


            $records["draw"] = $sEcho;
            $records["recordsTotal"] = $iTotalRecords;
            $records["recordsFiltered"] = $iTotalRecords;
            $records["sql_tot"] = $sql_tot;
            //$records["name"] = $name;
            //$records["sess_name"] = Session::get('ses_frl_name');
            


            echo json_encode($records);
        }
    }

    public function viewProvider($id) {
        //echo $id; die;

        if (Auth::guard('admins')->check()) {

            
            $data_msg = array();
            $data_msg['menu_parent'] = 'users';
            $data_msg['menu_child'] = 'provider';


            $userDetails = User::find($id);
            $data_msg['userDetails'] = $userDetails;         
            
           

            $data_msg['total_referral_earning'] = 1;          

            $data_msg['connect_history'] = array();
            
            
            return view('admin.users.provider.edit', $data_msg);
            
           
            
        } else {
            return redirect()->intended('admin/login');
        }
    }

    public function changeUserCertificate(Request $request) {

        if ($request->ajax()) {

            $user_id = $request->input('user_id');
            $status = $request->input('status');
            if ($status) {
                $status = '1';
            } else {
                $status = '0';
            }

            $data = [
                'certificate' => $status,
            ];

            $user = User::find($user_id);
            $user->update($data);


            if ($user) {
                return 1;
            } else {
                return 0;
            }
        }
    }



    //Common

    public function ajaxReportAbuse(Request $request, $uid) {

        if ($request->ajax()) {

            $myFunctions = new \App\library\myFunctions;

            $date_from = $request->input('date_from');
            $date_to = $request->input('date_to');            
            

            $arrSearch[] = ['report_abuses.status', '<>', '3'];
            $arrSearch[] = ['report_abuses.source_id', $uid];

            if ($date_from != '') {

                $d_p_d = explode('/', $date_from);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[0] . '-' . $d_p_d[1];
                $date_from = $d_p_d_m . ' 00:00:00';
                $date_from = $myFunctions->dateTextUserToServer($date_from, 'dt_tm');
                $arrSearch[] = ['report_abuses.created_at', '>=', $date_from];
            }

            if ($date_to != '') {

                $d_p_d = explode('/', $date_to);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[0] . '-' . $d_p_d[1];
                $date_to = $d_p_d_m . ' 23:59:00';
                $date_to = $myFunctions->dateTextUserToServer($date_to, 'dt_tm');
                $arrSearch[] = ['report_abuses.created_at', '<=', $date_to];
            }

            

            $users = DB::table('report_abuses')->select('report_abuses.reason','users.name','report_abuses.created_at','report_abuses.id') 
                    ->leftJoin('users', 'users.id', '=', 'report_abuses.user_id')
                    ->where($arrSearch);



            $users = $users->get();

            $iTotalRecords = count($users);



            //$iTotalRecords = 120;
            $iDisplayLength = intval($_REQUEST['length']);
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            session(['ses_frl_length' => $iDisplayLength]);

            $iDisplayStart = intval($_REQUEST['start']);
            session(['ses_frl_start' => $iDisplayStart]);

            $sEcho = intval($_REQUEST['draw']);

            $records = array();
            $records["data"] = array();

            $end = $iDisplayStart + $iDisplayLength;
            $end = $end > $iTotalRecords ? $iTotalRecords : $end;


            $order = $request->input('order');
            session(['ses_frl_order' => $order]);


            $column = array('#', 'created_at', 'type','username','complaint');



            if ($order[0]['column'] != '') {
                $column_name = $column[$order[0]['column']];
            } else {
                $column_name = $column[1];
            }

            if ($order[0]['dir'] != '') {
                $asc_desc = $order[0]['dir'];
            } else {
                $asc_desc = 'desc';
            }


            
             $users_1 = DB::table('report_abuses')->select('report_abuses.reason','users.name','report_abuses.created_at','report_abuses.id') 
                    ->leftJoin('users', 'users.id', '=', 'report_abuses.user_id')
                    ->where($arrSearch);


            
          
              

            $users_1 = $users_1->orderBy($column_name, $asc_desc)
                    ->skip($iDisplayStart)
                    ->take($iDisplayLength);
            //->get();

            $sql_tot = $users_1->toSql();
            //die;
            $users_1 = $users_1->get();



            //->toSql();
            //dd($fundsTransactionList);
            //die;
            $sl = 0;
            $sl = $iDisplayStart;
            foreach ($users_1 as $t) {                 
                
                

                $records["data"][] = array(
                    ++$sl,
                   
                    
                    $myFunctions->dateText($t->created_at, 'm_d_y'),   
                    $t->name,  
                    $t->reason, 
                   
                                    
                    '<a href="javascript:void(0)" onclick="delete_complaint('.$t->id.')" class="btn btn-sm default btn-editable"><i class="fa fa-trash"></i> Delete</a>'
                    
                );

                //$sl++;
            }


            $records["draw"] = $sEcho;
            $records["recordsTotal"] = $iTotalRecords;
            $records["recordsFiltered"] = $iTotalRecords;
            //$records["sql_tot"] = $sql_tot;
            $records["from_date"] = $date_from;
            $records["to_date"] = $date_to;
            


            echo json_encode($records);
        }
    }


    public function ajaxReview(Request $request, $uid) {

        if ($request->ajax()) {

            $myFunctions = new \App\library\myFunctions;

            $date_from = $request->input('date_from');
            $date_to = $request->input('date_to');            
            

            $arrSearch[] = ['reviews.status', '<>', '3'];
            $arrSearch[] = ['reviews.to_user_id', $uid];

            if ($date_from != '') {

                $d_p_d = explode('/', $date_from);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[0] . '-' . $d_p_d[1];
                $date_from = $d_p_d_m . ' 00:00:00';
                $date_from = $myFunctions->dateTextUserToServer($date_from, 'dt_tm');
                $arrSearch[] = ['reviews.created_at', '>=', $date_from];
            }

            if ($date_to != '') {

                $d_p_d = explode('/', $date_to);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[0] . '-' . $d_p_d[1];
                $date_to = $d_p_d_m . ' 23:59:00';
                $date_to = $myFunctions->dateTextUserToServer($date_to, 'dt_tm');
                $arrSearch[] = ['reviews.created_at', '<=', $date_to];
            }

            

            $users = DB::table('reviews')->select('reviews.comments','reviews.rate','users.name','reviews.created_at','reviews.id') 
                    ->leftJoin('users', 'users.id', '=', 'reviews.by_user_id')
                    ->where($arrSearch);



            $users = $users->get();

            $iTotalRecords = count($users);



            //$iTotalRecords = 120;
            $iDisplayLength = intval($_REQUEST['length']);
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            session(['ses_frl_length' => $iDisplayLength]);

            $iDisplayStart = intval($_REQUEST['start']);
            session(['ses_frl_start' => $iDisplayStart]);

            $sEcho = intval($_REQUEST['draw']);

            $records = array();
            $records["data"] = array();

            $end = $iDisplayStart + $iDisplayLength;
            $end = $end > $iTotalRecords ? $iTotalRecords : $end;


            $order = $request->input('order');
            session(['ses_frl_order' => $order]);


            $column = array('#', 'created_at', 'type','username','complaint');



            if ($order[0]['column'] != '') {
                $column_name = $column[$order[0]['column']];
            } else {
                $column_name = $column[1];
            }

            if ($order[0]['dir'] != '') {
                $asc_desc = $order[0]['dir'];
            } else {
                $asc_desc = 'desc';
            }


            


            $users_1 = DB::table('reviews')->select('reviews.comments','reviews.rate','users.name','reviews.created_at','reviews.id') 
                    ->leftJoin('users', 'users.id', '=', 'reviews.by_user_id')
                    ->where($arrSearch);

            
          
              

            $users_1 = $users_1->orderBy($column_name, $asc_desc)
                    ->skip($iDisplayStart)
                    ->take($iDisplayLength);
            //->get();

            $sql_tot = $users_1->toSql();
            //die;
            $users_1 = $users_1->get();



            //->toSql();
            //dd($fundsTransactionList);
            //die;
            $sl = 0;
            $sl = $iDisplayStart;
            foreach ($users_1 as $t) {                 
                
                

                $records["data"][] = array(
                    ++$sl,
                   
                    
                    $myFunctions->dateText($t->created_at, 'm_d_y'),   
                    $t->name,  
                    $t->comments, 
                    getRateingAdmin($t->rate), 
                   
                                    
                    '<a href="javascript:void(0)" onclick="delete_complaint('.$t->id.')" class="btn btn-sm default btn-editable"><i class="fa fa-trash"></i> Delete</a>'
                    
                );

                //$sl++;
            }


            $records["draw"] = $sEcho;
            $records["recordsTotal"] = $iTotalRecords;
            $records["recordsFiltered"] = $iTotalRecords;
            //$records["sql_tot"] = $sql_tot;
            $records["from_date"] = $date_from;
            $records["to_date"] = $date_to;
            


            echo json_encode($records);
        }
    }











    public function ajaxMembersActiveLog(Request $request, $uid) {

        if ($request->ajax()) {

            $myFunctions = new \App\library\myFunctions;

            $date_from = $request->input('date_from');
            $date_to = $request->input('date_to');            
            

            $arrSearch[] = ['user_activity_log.status', '<>', '3'];
            $arrSearch[] = ['user_activity_log.user', $uid];

            if ($date_from != '') {

                $d_p_d = explode('/', $date_from);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[0] . '-' . $d_p_d[1];
                $date_from = $d_p_d_m . ' 00:00:00';
                $date_from = $myFunctions->dateTextUserToServer($date_from, 'dt_tm');
                $arrSearch[] = ['user_activity_log.created_at', '>=', $date_from];
            }

            if ($date_to != '') {

                $d_p_d = explode('/', $date_to);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[0] . '-' . $d_p_d[1];
                $date_to = $d_p_d_m . ' 23:59:00';
                $date_to = $myFunctions->dateTextUserToServer($date_to, 'dt_tm');
                $arrSearch[] = ['user_activity_log.created_at', '<=', $date_to];
            }

            

            $users = DB::table('user_activity_log')->select('*')                    
                    ->where($arrSearch);



            $users = $users->get();

            $iTotalRecords = count($users);



            //$iTotalRecords = 120;
            $iDisplayLength = intval($_REQUEST['length']);
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            session(['ses_frl_length' => $iDisplayLength]);

            $iDisplayStart = intval($_REQUEST['start']);
            session(['ses_frl_start' => $iDisplayStart]);

            $sEcho = intval($_REQUEST['draw']);

            $records = array();
            $records["data"] = array();

            $end = $iDisplayStart + $iDisplayLength;
            $end = $end > $iTotalRecords ? $iTotalRecords : $end;


            $order = $request->input('order');
            session(['ses_frl_order' => $order]);


            $column = array('#', 'created_at', 'note');



            if ($order[0]['column'] != '') {
                $column_name = $column[$order[0]['column']];
            } else {
                $column_name = $column[1];
            }

            if ($order[0]['dir'] != '') {
                $asc_desc = $order[0]['dir'];
            } else {
                $asc_desc = 'desc';
            }



            $users_1 = DB::table('user_activity_log')->select('*')
                    
                    ->where($arrSearch);           

            $users_1 = $users_1->orderBy($column_name, $asc_desc)
                    ->skip($iDisplayStart)
                    ->take($iDisplayLength);
            //->get();

            $sql_tot = $users_1->toSql();
            //die;
            $users_1 = $users_1->get();



            //->toSql();
            //dd($fundsTransactionList);
            //die;
            $sl = 0;
            $sl = $iDisplayStart;
            foreach ($users_1 as $t) {  

                $records["data"][] = array(
                    ++$sl,
                    $myFunctions->dateText($t->created_at, 'm_d_y'),
                    $t->note,                    
                );

                //$sl++;
            }


            $records["draw"] = $sEcho;
            $records["recordsTotal"] = $iTotalRecords;
            $records["recordsFiltered"] = $iTotalRecords;
            //$records["sql_tot"] = $sql_tot;
            $records["from_date"] = $date_from;
            $records["to_date"] = $date_to;
            


            echo json_encode($records);
        }
    }
    
    public function ajaxMembersReferralHistory(Request $request, $uid) {

        if ($request->ajax()) {

            $myFunctions = new \App\library\myFunctions;

            $date_from = $request->input('date_from');
            $date_to = $request->input('date_to');            
            

            $arrSearch[] = ['user_referral_history.status', '<>', '3'];
            $arrSearch[] = ['user_referral_history.user_id', $uid];

            if ($date_from != '') {

                $d_p_d = explode('/', $date_from);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[0] . '-' . $d_p_d[1];
                $date_from = $d_p_d_m . ' 00:00:00';
                $date_from = $myFunctions->dateTextUserToServer($date_from, 'dt_tm');
                $arrSearch[] = ['user_referral_history.created_at', '>=', $date_from];
            }

            if ($date_to != '') {

                $d_p_d = explode('/', $date_to);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[0] . '-' . $d_p_d[1];
                $date_to = $d_p_d_m . ' 23:59:00';
                $date_to = $myFunctions->dateTextUserToServer($date_to, 'dt_tm');
                $arrSearch[] = ['user_referral_history.created_at', '<=', $date_to];
            }

            

            $users = DB::table('user_referral_history')->select('username','user_referral_history.created_at','payment_history_id','amount_spend','referral_percentage','amount_earn') 
					->leftJoin('users', 'users.id', '=', 'user_referral_history.member_id')
                    ->where($arrSearch);



            $users = $users->get();

            $iTotalRecords = count($users);



            //$iTotalRecords = 120;
            $iDisplayLength = intval($_REQUEST['length']);
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            session(['ses_frl_length' => $iDisplayLength]);

            $iDisplayStart = intval($_REQUEST['start']);
            session(['ses_frl_start' => $iDisplayStart]);

            $sEcho = intval($_REQUEST['draw']);

            $records = array();
            $records["data"] = array();

            $end = $iDisplayStart + $iDisplayLength;
            $end = $end > $iTotalRecords ? $iTotalRecords : $end;


            $order = $request->input('order');
            session(['ses_frl_order' => $order]);


            $column = array('#', 'created_at', 'username','amount_spend','referral_percentage','amount_earn');



            if ($order[0]['column'] != '') {
                $column_name = $column[$order[0]['column']];
            } else {
                $column_name = $column[1];
            }

            if ($order[0]['dir'] != '') {
                $asc_desc = $order[0]['dir'];
            } else {
                $asc_desc = 'desc';
            }


			
            $users_1 = DB::table('user_referral_history')->select('username','user_referral_history.created_at','payment_history_id','amount_spend','referral_percentage','amount_earn') 
					->leftJoin('users', 'users.id', '=', 'user_referral_history.member_id')
                    ->where($arrSearch);
              

            $users_1 = $users_1->orderBy($column_name, $asc_desc)
                    ->skip($iDisplayStart)
                    ->take($iDisplayLength);
            //->get();

            $sql_tot = $users_1->toSql();
            //die;
            $users_1 = $users_1->get();



            //->toSql();
            //dd($fundsTransactionList);
            //die;
            $sl = 0;
            $sl = $iDisplayStart;
            foreach ($users_1 as $t) {  
                
                $btn = '<a href="' . url(config("constants.admin_prefix") . '/transaction-details') . '/' . $t->payment_history_id . '" class="btn btn-sm default btn-editable"><i class="fa fa-eye"></i> View</a>';
                
                
                $btn .= '<a href="javascript:void(0)" onClick="release('.$t->payment_history_id.')" class="btn btn-sm default btn-editable"><span aria-hidden="true" class="icon-wallet"></span>  </span> Wallet</a>';
                
               

                $records["data"][] = array(
                    ++$sl,
                    $myFunctions->dateText($t->created_at, 'm_d_y'),                    
                    $t->username,
                    $t->amount_spend,
                    $t->referral_percentage,
                    $t->amount_earn, 
                    $btn,
                    
                );

                //$sl++;
            }


            $records["draw"] = $sEcho;
            $records["recordsTotal"] = $iTotalRecords;
            $records["recordsFiltered"] = $iTotalRecords;
            //$records["sql_tot"] = $sql_tot;
            $records["from_date"] = $date_from;
            $records["to_date"] = $date_to;
            


            echo json_encode($records);
        }
    }
    
    public function ajaxMembersComplaintLog(Request $request, $uid) {

        if ($request->ajax()) {

            $myFunctions = new \App\library\myFunctions;

            $date_from = $request->input('date_from');
            $date_to = $request->input('date_to');            
            

            $arrSearch[] = ['user_complaint.status', '<>', '3'];
            $arrSearch[] = ['user_complaint.member_id', $uid];

            if ($date_from != '') {

                $d_p_d = explode('/', $date_from);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[0] . '-' . $d_p_d[1];
                $date_from = $d_p_d_m . ' 00:00:00';
                $date_from = $myFunctions->dateTextUserToServer($date_from, 'dt_tm');
                $arrSearch[] = ['user_complaint.created_at', '>=', $date_from];
            }

            if ($date_to != '') {

                $d_p_d = explode('/', $date_to);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[0] . '-' . $d_p_d[1];
                $date_to = $d_p_d_m . ' 23:59:00';
                $date_to = $myFunctions->dateTextUserToServer($date_to, 'dt_tm');
                $arrSearch[] = ['user_complaint.created_at', '<=', $date_to];
            }

            

            $users = DB::table('user_complaint')->select('username','user_complaint.type','complaint','user_complaint.created_at') 
					->leftJoin('users', 'users.id', '=', 'user_complaint.user_id')
                    ->where($arrSearch);



            $users = $users->get();

            $iTotalRecords = count($users);



            //$iTotalRecords = 120;
            $iDisplayLength = intval($_REQUEST['length']);
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            session(['ses_frl_length' => $iDisplayLength]);

            $iDisplayStart = intval($_REQUEST['start']);
            session(['ses_frl_start' => $iDisplayStart]);

            $sEcho = intval($_REQUEST['draw']);

            $records = array();
            $records["data"] = array();

            $end = $iDisplayStart + $iDisplayLength;
            $end = $end > $iTotalRecords ? $iTotalRecords : $end;


            $order = $request->input('order');
            session(['ses_frl_order' => $order]);


            $column = array('#', 'created_at', 'type','username','complaint');



            if ($order[0]['column'] != '') {
                $column_name = $column[$order[0]['column']];
            } else {
                $column_name = $column[1];
            }

            if ($order[0]['dir'] != '') {
                $asc_desc = $order[0]['dir'];
            } else {
                $asc_desc = 'desc';
            }


            
             $users_1 = DB::table('user_complaint')->select('complaint_id','user_complaint.type','username','complaint','user_complaint.created_at') 
					->leftJoin('users', 'users.id', '=', 'user_complaint.user_id')
                    ->where($arrSearch);


			
          
              

            $users_1 = $users_1->orderBy($column_name, $asc_desc)
                    ->skip($iDisplayStart)
                    ->take($iDisplayLength);
            //->get();

            $sql_tot = $users_1->toSql();
            //die;
            $users_1 = $users_1->get();



            //->toSql();
            //dd($fundsTransactionList);
            //die;
            $sl = 0;
            $sl = $iDisplayStart;
            foreach ($users_1 as $t) {  
                $type = '';
                if($t->type == 1){                    
                    $type = 'Complaint';
                }
                
                if($t->type == 2){
                    
                    $type = 'Sex Offender';
                }
                
                

                $records["data"][] = array(
                    ++$sl,
                    $myFunctions->dateText($t->created_at, 'm_d_y'),   
                    $type,
                    $t->username,
                    $t->complaint,                   
                    '<a href="javascript:void(0)" onclick="delete_complaint('.$t->complaint_id.')" class="btn btn-sm default btn-editable"><i class="fa fa-trash"></i> Delete</a>'
                    
                );

                //$sl++;
            }


            $records["draw"] = $sEcho;
            $records["recordsTotal"] = $iTotalRecords;
            $records["recordsFiltered"] = $iTotalRecords;
            //$records["sql_tot"] = $sql_tot;
            $records["from_date"] = $date_from;
            $records["to_date"] = $date_to;
            


            echo json_encode($records);
        }
    }

    public function editMember($id) {

        if (Auth::guard('admins')->check()) {

            /* $pwc = WorkCategory::where([['status', '<>', '3'], ['pid', '0'], ['id', '<>', $id],])
              ->orderBy('name', 'asc')
              ->get();

              return view('admin.workcategory.edit', ['workcategory' => $workcategory, 'pwc' => $pwc, 'menu_parent' => $menu_parent, 'menu_child' => $menu_child]);
             */

            $data_msg = array();
            $data_msg['menu_parent'] = 'users';
            $data_msg['menu_child'] = 'member';


            $userDetails = User::find($id);
            $data_msg['userDetails'] = $userDetails;


            /* $skill_txt = "";
              $freelancer_skill = \App\Models\FreelancerSkill::where('user_id', $id)->get();
              foreach ($freelancer_skill as $v) {

              $skill_data = SkillsMaster::where('skill_id', $v->skill_id)->get();

              $skill = $skill_data[0];

              $skill_txt .= '<li><span class="label label-default">' . $skill->skill_name . '</span> </li>';
              }



              $data_msg['skill_txt'] = $skill_txt;
             */

            
           // $total_referral_earning = \App\Models\UserReferralHistory::sum('amount_earn')->where('user_id', '=', $id);
            
            
            $total_referral_earning = DB::table('user_referral_history')
                ->select(DB::raw('SUM(amount_earn) as total_amount_earn'))
                ->where('user_id', '=', $id)    
                //->groupBy('department')
                //->havingRaw('SUM(price) > ?', [2500])
                ->get();

            $data_msg['total_referral_earning'] = $total_referral_earning;

           // $data_msg['connect_history'] = ConnectHistory::where(['user_id' => $id, 'status' => 1])->get();

            //$data_msg['connect_history'] = ConnectHistory::where(['user_id' => $id, 'status' => 1])->get();
            $query = "SELECT * from ( (SELECT user_id,connect as tot_connect,messages_to,dr_or_cr,promocode,add_connect_by,DATE_FORMAT(created_at,'%y-%m-%d') AS posted_at FROM connect_history WHERE dr_or_cr <> 1 AND user_id = $id AND status = 1) UNION ALL (SELECT user_id,sum(connect) as tot_connect,messages_to,dr_or_cr,null,null, DATE_FORMAT(created_at,'%y-%m-%d') as posted_at FROM connect_history  WHERE  dr_or_cr = 1 AND status = 1 AND user_id = $id GROUP BY messages_to,posted_at ) ) a ORDER BY posted_at ASC";

            $query = "SELECT * FROM `connect_history` where  user_id = $id AND status = 1 ORDER BY created_at  ASC";

            $results = DB::select($query);

            $data_msg['connect_history'] = $results;

            //print_r($data_msg); die;
			
			//$permission = getUserRolePermission(Auth::guard('admins')->user()->id,'member-edit');
			//if($permission || Auth::guard('admins')->user()->user_type == 1){
			
            return view('admin.users.members.edit', $data_msg);
			
			//}else{
				//return view('admin.no-permission', $data_msg);
			//}
			
        } else {
            return redirect()->intended('admin/login');
        }
    }

    public function editFreelancerAction(Request $request, $id) {
        $this->validate($request, $this->form_rules);
        $data = $this->formatData($request);
        $category = WorkCategory::find($id);


        //print_r($category);        
        //die;        

        $category->update($data);


        \Session::flash('messageClass', 'alert alert-success');
        \Session::flash('message', 'Work category updated successfully'); //trans('categories.insert_message')
        //return redirect()->route('admin.workcategory.edit', [$id]);

        return redirect('admin/workcategory/edit/' . $id);
    }

    public function approveFreelancerProfile(Request $request, $uid) {

        if (is_null($uid)) {
            //return redirect()->intended('/users-freelancer');


            $request->session()->flash('messageClass', 'alert alert-danger');
            $request->session()->flash('message', 'Portfolio approve failed.');

            return redirect()->intended('admin/users-freelancer');
        }



        $userDetails = User::find($uid);
        $user_data = [
            'profile_since' => date('Y-m-d'),
            'step_url' => 'dashboard'
        ];
        $userDetails->update($user_data);


        $freelancerDetails = FreelancerDetails::find($uid);
        $freelancer_data = [
            'profile_status' => '1'
        ];
        $freelancerDetails->update($freelancer_data);

        $request->session()->flash('messageClass', 'alert alert-success'); //alert-danger
        $request->session()->flash('message', 'Profile successfully approved.');

        return redirect('admin/freelancer/edit/' . $uid);
    }

    public function addCredit(Request $request, $uid) {

        $connect = trim($request->input('connect'));
        $res = User::where('id', '=', $uid)->increment('tot_connect', $connect);
        if ($res) {
            $ConnectHistory = new ConnectHistory;
            $ConnectHistory->user_id = $uid;
            $ConnectHistory->connect = $connect;
            $ConnectHistory->dr_or_cr = '2';
            $ConnectHistory->add_connect_by = '1';
            $ConnectHistory->status = 1;
            $ConnectHistory->save();

            return redirect(config("constants.admin_prefix") . '/member/edit/' . $uid . '#tab_2')
                            ->with('message', 'Credit updated successfully, thankyou')
                            ->with('messageClass', 'alert alert-success');
        }

        return back()
                        ->with('message', 'Something went wrong!')
                        ->with('messageClass', 'alert alert-danger');
    }

    public function editStatusFreelancerAction(Request $request, $uid) {

        $sts = 0;
        if ($request->input('admin_status') == '1') {
            $sts = 1;
        }
        $data = array(
            'admin_comment' => $request->get('admin_comment'),
            'admin_status' => $sts,
        );

        $adminDetails = User::find($uid);
        $adminDetails->update($data);
        if ($adminDetails) {
            return redirect(config("constants.admin_prefix") . '/freelancer/edit/' . $uid . '#tab_7')
                            ->with('message', 'Admin status updated successfully, thankyou')
                            ->with('messageClass', 'alert alert-success');
        }
        return back()
                        ->with('message', 'Something went wrong!')
                        ->with('messageClass', 'alert alert-danger');
        ;
    }

    public function freelancerWithdrawRequest(Request $request, $uid) {

        if ($request->ajax()) {

            $amount = $request->input('amount');
            $date_from = $request->input('date_from');
            $date_to = $request->input('date_to');
            $is_transferred = $request->input('is_transferred');
            $transfer_date_from = $request->input('transfer_date_from');
            $transfer_date_to = $request->input('transfer_date_to');


            $arrSearch[] = ['status', '1'];
            $arrSearch[] = ['user_id', $uid];

            if ($amount != '') {
                $arrSearch[] = ['amount', $amount];
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

            if ($is_transferred != '') {
                $arrSearch[] = ['is_transferred', $is_transferred];
            }

            if ($transfer_date_from != '') {

                $d_p_d = explode('/', $transfer_date_from);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $transfer_date_from = $d_p_d_m;

                $arrSearch[] = ['transfer_date', '>=', $transfer_date_from];
            }

            if ($transfer_date_to != '') {

                $d_p_d = explode('/', $transfer_date_to);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $transfer_date_to = $d_p_d_m;

                $arrSearch[] = ['transfer_date', '<=', $transfer_date_to];
            }


            $fundsWithdrawList = FundsWithdraw::where($arrSearch)
                    ->get();
            //->toSql();
            //dd($fundsTransactionList);
            //die;
            $iTotalRecords = $fundsWithdrawList->count();

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

            $column = array('amount', 'created_at', 'is_transferred', 'transfer_date', 'action');
            if ($order[0]['column'] != '') {
                $column_name = $column[$order[0]['column']];
            } else {
                $column_name = $column[1];
            }

            if ($order[0]['dir'] != '') {
                $asc_desc = $order[0]['dir'];
            } else {
                $asc_desc = 'desc';
            }


            $myFunctions = new \App\library\myFunctions;

            $fundsWithdrawList_1 = FundsWithdraw::where($arrSearch)
                    ->orderBy($column_name, $asc_desc)
                    ->skip($iDisplayStart)
                    ->take($iDisplayLength)
                    ->get();

            foreach ($fundsWithdrawList_1 as $t) {

                $status = '';
                if ($t->is_transferred == '1') {
                    $status = '<span class="label label-sm label-success"> Transferred </span>';
                } else {
                    $status = '<span class="label label-sm label-warning"> Pending </span>';
                }

                $records["data"][] = array(
                    '$' . $t->amount,
                    $myFunctions->dateText($t->created_at, 'mm/dd/yy'),
                    $status,
                    $myFunctions->dateText($t->transfer_date, 'mm/dd/yy'),
                    '<a href="' . url(config("constants.admin_prefix") . '/withdraw-request') . '/' . $t->id . '" class="btn btn-sm default btn-editable"><i class="fa fa-eye"></i> View </a>'
                );
            }

            $records["draw"] = $sEcho;
            $records["recordsTotal"] = $iTotalRecords;
            $records["recordsFiltered"] = $iTotalRecords;


            echo json_encode($records);
        }
    }

    public function withdrawRequest($id) {

        if (Auth::guard('admins')->check()) {

            $data_msg = array();
            $data_msg['menu_parent'] = 'users';
            $data_msg['menu_child'] = 'freelancer';


            $fundsWithdraw = FundsWithdraw::find($id);
            $data_msg['fundsWithdraw'] = $fundsWithdraw;

            $withdraw_user_id = $fundsWithdraw->user_id;


            $userDetails = User::find($withdraw_user_id);
            $data_msg['userDetails'] = $userDetails;

            $freelancerDetails = FreelancerDetails::find($withdraw_user_id);
            $data_msg['freelancerDetails'] = $freelancerDetails;


            return view('admin.users.freelancer.withdrawEdit', $data_msg);
        } else {
            return redirect()->intended('admin/login');
        }
    }

    public function withdrawRequestAction(Request $request, $id) {
        $payment_type_id = $request->input('payment_type_id');
        $is_transferred = $request->input('is_transferred');
        $FundsWithdraw = FundsWithdraw::find($id);

        if ($FundsWithdraw->is_transferred != '1') {
            $data = [
                'transfer_date' => date('Y-m-d H:i:s'),
                'payment_type_id' => $payment_type_id,
                'is_transferred' => $is_transferred
            ];

            $FundsWithdraw->update($data);

            \Session::flash('messageClass', 'alert alert-success');
            \Session::flash('message', 'Withdraw request updated successfully'); //trans('categories.insert_message')
            //return redirect()->route('admin.workcategory.edit', [$id]);

            return redirect('admin/withdraw-request/' . $id);
        } else {
            \Session::flash('messageClass', 'alert alert-danger');
            \Session::flash('message', 'Withdraw request cannot update'); //trans('categories.insert_message')

            return redirect('admin/withdraw-request/' . $id);
        }
    }

    //Members
    //Common
    public function fundTransaction(Request $request, $uid)
    {
        if ($request->ajax()) {

            $myFunctions = new \App\library\myFunctions;

            $date_from = $request->input('date_from');
            $date_to = $request->input('date_to');
            $description = $request->input('description');
            $amount = $request->input('amount');

            $arrSearch[] = ['status', '1'];
            $arrSearch[] = ['user_id', $uid];

            if ($date_from != '') {

                $d_p = explode(' ', $date_from);
                $d_p_d = explode('/', $d_p[0]);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[0] . '-' . $d_p_d[1];
                $d_p_t = $d_p[1] . ':00';
                //$date_from = $d_p_d_m . ' ' . $d_p_t;
                $date_from = $d_p_d_m . "00:00:00";

                $date_from = $myFunctions->dateTextUserToServer($date_from, 'dt_tm');

                $arrSearch[] = ['created_at', '>=', $date_from];
            }

            if ($date_to != '') {

                $d_p = explode(' ', $date_to);
                $d_p_d = explode('/', $d_p[0]);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[0] . '-' . $d_p_d[1];
                $d_p_t = $d_p[1] . ':00';
                //$date_to = $d_p_d_m . ' ' . $d_p_t;

                $date_to = $d_p_d_m . " 23:59:00";

                $date_to = $myFunctions->dateTextUserToServer($date_to, 'dt_tm');
                $arrSearch[] = ['created_at', '<=', $date_to];
            }

            if ($description != '') {
                $arrSearch[] = ['description', 'like', '%' . $description . '%'];
            }

            if ($amount != '') {
                $arrSearch[] = ['amount', $amount];
            }

            $fundsTransactionList = FundsTransaction::where($arrSearch)
                    ->orderBy('created_at', 'desc')
                    ->get();
            //->toSql();
            //dd($fundsTransactionList);
            //die;
            $iTotalRecords = $fundsTransactionList->count();

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
            $column = array('created_at', 'description', 'amount', 'balance_amount');
            if ($order[0]['column'] != '') {
                $column_name = $column[$order[0]['column']];
            } else {
                $column_name = $column[0];
            }

            if ($order[0]['dir'] != '') {
                $asc_desc = $order[0]['dir'];
            } else {
                $asc_desc = 'desc';
            }

            $fundsTransactionList_1 = FundsTransaction::where($arrSearch)
                    ->orderBy($column_name, $asc_desc)
                    ->skip($iDisplayStart)
                    ->take($iDisplayLength)
                    ->get();

            foreach ($fundsTransactionList_1 as $t) {
                $records["data"][] = array(
                    $myFunctions->dateText($t->created_at, 'mm/dd/yy'),
                    $t->description,
                    '$' . $t->amount,
                    '$' . $t->balance_amount
                );
            }

            $records["draw"] = $sEcho;
            $records["recordsTotal"] = $iTotalRecords;
            $records["recordsFiltered"] = $iTotalRecords;


            echo json_encode($records);
        }
    }
    
    public function deleteComplaint(Request $request)
    {
        $h_data['status'] = 1;
        if ($request->ajax()) {
            $id = $request->input('id');
            $arr_ret = array('status' => 'failed');
            if ($id) {                
                \App\Models\UserComplaint::destroy($id);
                
                $arr_ret = array('status' => 'success');
            }
            echo json_encode($arr_ret);
        }
    }
	
	
	public function userAccessUpdateAction(Request $request, $id)
    {
		//die('1');
      
		$db = UserRole::where('user_id', $id)->get();
            foreach ($db as $v) {
                $tid = $v->id;
                UserRole::destroy($tid);
            }
		
		$RoleList = RoleTopic::where('status', '<>', '3')
                            ->orderBy('updated_at', 'desc')->get();
		
		foreach($RoleList as $list)
        {
			$result = getRoleName($list->id);
            foreach($result as $list1){
                $slag_name = $list1->slag;
                $slag_val = $request->input($slag_name);
                
                if($slag_val){
                $data = array(
                    'user_id' => $id,
                    'role_slag' => $slag_name
                 );
                $user = UserRole::create($data);
                
                }
            }
		}
		
		return redirect()->intended(config("constants.admin_prefix") . '/user/edit/' . $id.'#tab_1_4')->with('messageClass', 'alert alert-success')
                                ->with('message', 'Successfully Updated');
    }
}
