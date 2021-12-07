<?php

namespace App\Http\Controllers;

use Validator;
use Mail;
use App\Admin;
use App\User;
use App\Contributor;
use App\Country;
use App\Student;
use Hasher;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\library\myFunctions;
use App\SubjectMaster;
use App\UserBankDetail;

class ContributorController extends Controller {

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

    public function showContributorList() {

        if (Auth::guard('admins')->check()) {
			
			// && Auth::guard('admins')->user()->user_type == 1
			
            $menu_parent = 'users';
            $menu_child = 'contributors';
			$allsubjects=SubjectMaster::where('status',1)->get();
			//$permission = getUserRolePermission(Auth::guard('admins')->user()->id,'admin-view');
            return view('admin.users.contributor.list', compact('menu_parent', 'menu_child','allsubjects'));
			if($permission || Auth::guard('admins')->user()->user_type == 1){

			
			 }else{
				return view('admin.no-permission', $data_msg);
			}
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function ajaxContributorList(Request $request) {

        //return $request;

        if ($request->ajax()) {

            $name = $request->input('name');
            $email = $request->input('email');
            $status = $request->input('status');
            $subject_id = $request->input('subject_id');


            $arrSearch[] = ['status', '<>', '3'];
            $arrSearch[] = ['user_type_id', '3'];


            if ($email != '') {
                $arrSearch[] = ['email', 'like', '%' . $email . '%'];
            }

            /* if ($sex != '') {
              $arrSearch[] = ['admin_master.sex', $sex];
              } */

            if ($status != '') {
                $arrSearch[] = ['status', $status];
            }



            $users = DB::table('users')
                    ->join('contributors as ct','ct.user_id','users.id')
                    ->select('users.id', 'ct.firstname', 'ct.lastname', 'users.email','ct.subject_list' ,'users.is_approved','users.status')
                    ->where(function($query) use($subject_id){
                        if ($subject_id != '') {
                            $query->orWhereRaw("find_in_set($subject_id,ct.subject_list)");
                        }
                    }) 
                    ->where($arrSearch);

            if ($name != '') {
                $users = $users->WhereRaw("concat(firstname, ' ', lastname) like '%$name%' ");
            }

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

            $column = array('#', 'firstname', 'email','subject_list' ,'is_approved','status', 'action');


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

            /*$users_1 = DB::table('users')->select('id', 'firstname', 'last_name', 'email', 'last_login', 'status')
                    ->where($arrSearch);*/
            $users_1 = DB::table('users')
                    ->join('contributors as ct','ct.user_id','users.id')
                    ->select('users.id', 'ct.firstname', 'ct.lastname', 'users.email','ct.subject_list' ,'users.is_approved','users.status')
                    ->where(function($query) use($subject_id){
                        if ($subject_id != '') {
                            $query->orWhereRaw("find_in_set($subject_id,ct.subject_list)");
                        }
                    }) 
                    ->where($arrSearch);

            if ($name != '') {
                $users_1 = $users_1->WhereRaw("concat(firstname, ' ', lastname) like '%$name%' ");
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
                if ($t->is_approved == '1') {
                    $is_approved = '<span class="label label-sm label-success"> Yes </span>';
                } else {
                    $is_approved = '<span class="label label-sm label-warning"> No </span>';
                }
                $subject_lists=explode(',',$t->subject_list);
                $allsubjects=array();
                foreach($subject_lists as $subject_list){
                    $subject=SubjectMaster::find($subject_list);
                    //print_r($subject['subject_name']);

                    $allsubjects[]=$subject['subject_name'];

                }
                $related_subjects= implode(",<br>",$allsubjects);
                


                $records["data"][] = array(
                    $sl,
                    $t->firstname . ' ' . $t->lastname,
                    $t->email,
                    $related_subjects,
                    $is_approved,
                    $status,
                    '<a href="' .route('editContributor',['id'=>Hasher::encode($t->id)]) . '" class="btn btn-sm btn-default"><i class="fa fa-edit"></i> Edit </a>'
                        
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
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ];

        return Validator::make($data, $validate);
    }

    public function createContributor(Request $request) {
        $data_msg = array();
        if (Auth::guard('admins')->check()) {
            
            $data_msg['menu_parent'] = 'users';
            $data_msg['menu_child'] = 'contributors';
            
            
            $data_msg['allCountries'] = Country::where('status', '<>', '3')
            ->orderBy('country_name', 'desc')->get();
            $data_msg['allSubjects']=  SubjectMaster::where('status',1)->get();              
            
            if ($request->method() === "POST") {
                
                //return $request;

                $name = $request->input('first_name').' '.$request->input('last_name');
                $email = $request->input('email');
                $password = $request->input('password');
                $user_type_id = 3;
                $status = $request->input('status');
                $is_approved =1;

                $ac_holder_name = $request->input('ac_holder_name');
                $account_number = $request->input('account_number');
                $bank_name = $request->input('bank_name');
                $bank_branch = $request->input('bank_branch');
                $ifsc_code = $request->input('ifsc_code');
	
                
                $first_name = $request->input('first_name');
                $last_name = $request->input('last_name');
                $contactnumber = $request->input('contactnumber');
                $anothercontactnumber = $request->input('anothercontactnumber');
                $gender = $request->input('gender');
                $qualification = $request->input('qualification');
                $subject_list = $request->input('subject_list');
                $address = $request->input('address');
                $country_id = $request->input('country');
                $ip_address = $request->ip();
                
                
                $data_user_details = array(					
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'country_id' => $country_id,
                    // 'sex' => $gender,
                    // 'address' => $address,
                    'email' => $email,
                    'password' => md5($password),
                );

				
                $validator = $this->validatorRegisterGeneral($data_user_details);
                
                if ($validator->fails()) {
                    $val = $validator->errors();
                    //dd($val);
                    return redirect()->intended(route('createContributor'))->withErrors($val)->withInput();
                }

				$data_user_details = array(
                    'name' => $name,
                    'email' => $email,
                    'password' => md5($password),
                    'user_type_id'=>$user_type_id,
                    'status' => $status,
                    'is_approved' => $is_approved,
                  
                );
				
				
				$user_id=User::create($data_user_details)->id;
                //$user_id=21;
                if($user_id){
                    $student_details=array(
                        'user_id'=>$user_id,
                        'firstname'=>$first_name,
                        'lastname'=>$last_name,
                        'contactnumber'=>$contactnumber,
                        'anothercontactnumber'=>$anothercontactnumber,
                        'gender'=>$gender,
                        'qualification'=>$qualification,
                        'subject_list'=>implode(",",$subject_list),
                        'address'=>$address,
                        'country_id'=>$country_id,
                        'ip_address'=>$ip_address,

                    );
                    $contributor_bank_details=array(
                        'user_id'=>$user_id,
                        'ac_holder_name'=>$ac_holder_name,
                        'account_number'=>$account_number,
                        'bank_name'=>$bank_name,
                        'bank_branch'=>$bank_branch,
                        'ifsc_code'=>$ifsc_code
                
                    );
                   // print_r($student_details);die;
                    $user = Contributor::create($student_details);
                            UserBankDetail::create($contributor_bank_details);

                    $this->sendWelcomeMail($email,$password,$first_name);
                    
                }
                $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Contributor successfully added');
                
                return redirect()->intended(route('contributors'))->with('messageClass', 'alert alert-success')
                                ->with('message', 'Contributor successfully added');
            }
			
            	return view('admin.users.contributor.create', $data_msg);
			
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function sendWelcomeMail($email,$password,$first_name)
    {
        
        try{

            $temp_data = \App\EmailTemplates::where(['mail_id'=>'welcome_email'])->first();
            $template_data = $temp_data;
            
           
    
    
            $content = $template_data->content;
            $content = str_replace("{{first_name}}", $first_name, $content);
            $content = str_replace("{{email}}", $email, $content);
            $content = str_replace("{{password}}", $password, $content);
           
    
            $emailData = array();
            $emailData['subject'] = trim($template_data->subject);
            $emailData['body'] = trim($content);
            $emailData['to_email'] = $email;
            $emailData['from_email'] = trim(getSettings('from_email'));
            $emailData['from_name'] = trim(getSettings('from_name'));
            
    
            Mail::send('frontend.emails.order', ['emailData' => $emailData], function ($message) use ($emailData) {
    
                    $message->from($emailData['from_email'], $emailData['from_name']);
    
                    $message->to($emailData['to_email'])->subject($emailData['subject']);
                    //$message->to('moutusi@karmicksolutions.com')->subject($emailData['subject']);
            });
        }catch (\Exception $e){
            return $e->getMessage();
        }


            
    }

    public function editContributor(Request $request, $id) {
        
        if (Auth::guard('admins')->check()) {

			
            $data_msg = array();

            $user_info =  DB::table('users')
                        ->join('contributors as ct','ct.user_id','users.id')
                        ->select('users.id', 'ct.*', 'users.email', 'users.is_approved','users.status')
                        ->where('id',$id)->get();
            $data_msg["user_info"] = $user_info[0];
            $data_msg['menu_parent'] = 'users';
            $data_msg['menu_child'] = 'contributors';
            $data_msg['allSubjects']=  SubjectMaster::where('status',1)->get();              
            //return $data_msg["user_info"]->subject_list;

            $data_msg['subjectlists']=explode(",",$data_msg["user_info"]->subject_list);

            $data_msg['bankdetails']=UserBankDetail::where('user_id',$id)->first();
            //return $data_msg['subjectlists'];
            $data_msg['allCountries'] = Country::where('status', '<>', '3')
                            ->orderBy('country_name', 'desc')->get();
			
			
            return view('admin.users.contributor.edit', $data_msg);
			
        } else {

            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editContributorAction(Request $request, $id) {

       
        $name = $request->input('firstname').' '.$request->input('lastname');
        $email = $request->input('email');
        $status = $request->input('status');

        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $contactnumber = $request->input('contactnumber');
        $anothercontactnumber = $request->input('anothercontactnumber');
        $qualification = $request->input('qualification');
        $gender = $request->input('gender');
        $address = $request->input('address');
        $country_id = $request->input('country');
        $subject_list = $request->input('subject_list');

      
        //return implode(",",$subject_list);
        
        $data_uer_details = array(
			'name' => $name,
            'email' => $email,
            'status' => $status
        );

        $userDetails = User::find($id);
		
		
        $updated_user_info=$userDetails->update($data_uer_details);
		
        if($updated_user_info){
            $student_details=array(
                        'user_id'=>$id,
                        'firstname'=>$firstname,
                        'lastname'=>$lastname,
                        'contactnumber'=>$contactnumber,
                        'anothercontactnumber'=>$anothercontactnumber,
                        'qualification'=>$qualification,
                        'gender'=>$gender,
                        'subject_list'=>implode(",",$subject_list),
                        'address'=>$address,
                        'country_id'=>$country_id,
             
            );
            

            $student_info=Contributor::where('user_id',$id)->update($student_details);
        }

        \Session::flash('messageClass', 'alert alert-success');
        \Session::flash('message', 'Updated successfully');
		
		
		if($userDetails->user_type_id == 4){
			return redirect(config("constants.admin_prefix") . '/provider/view/' . \Hasher::encode($id) . '#tab_1-1');
		}else{
			return redirect(route('editContributor',['id'=>\Hasher::encode($id)]). '#tab_1_3');
		}
		
        
    }
    public function contributorPasswordUpdate(Request $request, $id) {
		
		
        $password = md5($request->input('password'));
        $data_uer_details = array(
            'password' => $password
        );
        $userDetails = User::find($id);
        $userDetails->update($data_uer_details);
        $request->session()->flash('messageClass', 'alert alert-success'); //alert-danger
        $request->session()->flash('message', 'Account Info successfully updated.');
        
		
		
			return redirect(route('editContributor',['id'=>\Hasher::encode($id)]).'#tab_1_3');
		
    }
    public function contributorBankDetailUpdate(Request $request, $id) {
		
		
        $ac_holder_name = $request->input('ac_holder_name');
        $account_number = $request->input('account_number');
        $bank_branch = $request->input('bank_branch');
        $bank_name = $request->input('bank_name');
        $ifsc_code = $request->input('ifsc_code');

        $contributor_bank_details=array(
                    'user_id'=>$id,
                    'ac_holder_name'=>$ac_holder_name,
                    'account_number'=>$account_number,
                    'bank_name'=>$bank_name,
                    'bank_branch'=>$bank_branch,
                    'ifsc_code'=>$ifsc_code
            
        );
        $userDetails = User::find($id);
        $contributor_bank_info=UserBankDetail::where('user_id',$id)->first();
        if($contributor_bank_info){
            $contributor_bank_info->update($contributor_bank_details);
        }else{
            
            UserBankDetail::create($contributor_bank_details);

        }
        $request->session()->flash('messageClass', 'alert alert-success'); //alert-danger
        $request->session()->flash('message', 'Bank Details successfully updated.');
        
		
		
			return redirect(route('editContributor',['id'=>\Hasher::encode($id)]).'#tab_2-1');
		
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
  
}
