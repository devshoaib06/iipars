<?php

namespace App\Http\Controllers\FrontendContributor;


use Validator;
use Mail;
use App\Admin;
use App\User;

use App\Http\Controllers\Controller;

use App\RoleTopic;
use App\UserRole;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\library\myFunctions;
use View;
use App\Contributor;
use App\SubjectMaster;
use App\UserBankDetail;
use Hasher;
use App\PaymentRequestMaster;
use App\PaymentRequestOrderDetail;

class FrontendContributorController extends Controller {

    public function __construct() 
	{
        $shareData = array();
        
        $mainMenu = \App\Product::select('name','product_id','slug')->where('status', '=', '1')->orderBy('name', 'asc')->get();
        $exams = \App\ExamMaster::select('exam_name','id')->where('status', '=', '1')->orderBy('id', 'asc')->get();
        $combo_pack_products = \App\Product::select('product_id','name','slug')
                        ->where(['status' => '1',
                                'is_combo'=>1
                        ])
                        ->orderBy('name', 'asc')
                        ->get();

        $newsfeed=\App\NewsFeedMaster::where('status',1)->get();                
        $articles_cat=\App\ArticleCategory::where('status',1)->get();
        $floatersignup=\App\FloaterSignUpMaster::where('status',1)->first();   
        $shareData['floatersignup'] = $floatersignup;                
        $shareData['articlecats'] = $articles_cat;   
        $shareData['newsfeed'] = $newsfeed;
        $shareData['combo_pack_products'] = $combo_pack_products;
        $shareData['mainMenu'] = $mainMenu;
        $shareData['exams'] = $exams;
        
        
        View::share($shareData);
	}


    public function index() {
        
        if (Auth::guard('contributors')->check()) {
            
            $data_msg = array();
            $data_msg['menu_parent'] = 'dashboard';
            $data_msg['menu_child'] = 'dashboard';
            $data_msg['users'] = '';
            $meta_array['meta_title']='Teachinns - Dashboard';
            $meta_array['meta_desc']='Teachinns';
            $meta_array['meta_keyword']='Teachinns';
            $meta_array['meta_robots']='Teachinns';
            
            $DataBag['page_metadata'] = (object)$meta_array;
            
            
            

            $contributor=Contributor::where('user_id',Auth::id())->first();
            $orders=DB::table('order_contributor_payment_details as ocpd')
            //    ->join('orders as ord','ord.id','ocpd.order_id')
            //    ->whereNotNull('ord.deleted_at')
               ->where('contributor_id',$contributor->contributor_id);

            $total_earned= $orders->sum('ocpd.price_earn');       
           

            $allorders= DB::table('orders as or')
                ->join('order_contributor_payment_details as ocpd','or.id','ocpd.order_id')  
                ->join('products as pr','or.course_id','pr.product_id')
                ->select(DB::raw('pr.product_id,pr.name,pr.price,pr.revised_price,sum(`ocpd`.`price_earn`) as total,ocpd.order_id,
                or.order_id as reciept_id,or.created_at'))
                ->where('contributor_id',$contributor->contributor_id)
                ->whereNull('or.deleted_at')
                ->groupBy('or.id')
                ->orderBy('or.id','desc')
                ->get();
           
            $data_msg['orders']= $allorders;  
            $data_msg['total_earned']= $total_earned;  
            return view('frontend.contributor.dashboard', $data_msg);
            

          
			
            
        } else {
            return redirect()->intended(route('contributorlogin'));
        }
    }

    public function myAccount() {       

        if (Auth::check()) {
            $meta_array['meta_title']='Teachinns - My Account';
            
            $meta_array['meta_desc']='Teachinns';
            $meta_array['meta_keyword']='Teachinns';
            $meta_array['meta_robots']='Teachinns';
            
            $DataBag['page_metadata'] = (object)$meta_array;
            
            $data_msg = array();
            $data_msg['page_metadata'] = (object)$meta_array;
             
            $result =  DB::table('users')
                        ->join('contributors as ct','ct.user_id','users.id')
                        ->select('users.id', 'ct.*', 'users.email')
                        ->where('users.user_type_id', '=', '3')
                        ->where('users.id', '=', Auth::id());                   

            $userinfo = $result->first();
            
            $subject_name=[];        
            if($userinfo->subject_list){
                $subjects=explode(",",$userinfo->subject_list);
                foreach($subjects as $subject){
                    $subjectInfo=SubjectMaster::find($subject);
                    $subject_name[]=$subjectInfo->subject_name;
                }
            }
           
            $bank_details =  DB::table('users')
                        ->join('user_bank_details as ubd','ubd.user_id','users.id')
                        ->select('users.id', 'ubd.*', 'users.email','users.user_type_id')
                        ->where('users.id', '=', Auth::id())
                        ->first();   
            
                       
            $data_msg['userinfo'] = $userinfo;            
            $data_msg['relatedsubject']=implode(", ",$subject_name);
            $data_msg['bank_details'] = $bank_details;
            //dd($data_msg['bank_details']);         
            
            return view('frontend.contributor.myAccount', $data_msg);
            
        }else {
            return redirect()->route('loginAction');
        }
        
        
    }

    public function myAccountAction(Request $request, $id) {


        // echo "<pre>";
        // //echo $id;
        // print_r($request->all());
        // die;
        $name = $request->input('firstname').' '.$request->input('lastname');
        $email = $request->input('email');


        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $qualification = $request->input('qualification');
        $contactnumber = $request->input('phn_no');
       
        $ac_holder_name = $request->input('ac_holder_name');
        $account_number = $request->input('account_number');
        $bank_name = $request->input('bank_name');
        $bank_branch = $request->input('bank_branch');
        $ifsc_code = $request->input('ifsc_code');

        $data_uer_details = array(
            'name' => $name,
            'email' => $email
        );

        $userDetails = User::find($id);
        
        
        $updated_user_info=$userDetails->update($data_uer_details);

        if($updated_user_info){
            $contributor_details=array(
                        'user_id'=>$id,
                        'firstname'=>$firstname,
                        'lastname'=>$lastname,
                        'contactnumber'=>$contactnumber,
                        'subject_list'=>implode(",",$request->subjects),
                        'qualification'=>$qualification
             
            );
            $contributor_bank_details=array(
                        'user_id'=>$id,
                        'ac_holder_name'=>$ac_holder_name,
                        'account_number'=>$account_number,
                        'bank_name'=>$bank_name,
                        'bank_branch'=>$bank_branch,
                        'ifsc_code'=>$ifsc_code
             
            );
            
            $contributor_info=Contributor::where('user_id',$id)->update($contributor_details);
            $contributor_bank_info=UserBankDetail::where('user_id',$id)->first();
            if($contributor_bank_info){
                $contributor_bank_info->update($contributor_bank_details);
            }else{
                // echo "<pre>";
                // print_r($contributor_bank_details);die;
                UserBankDetail::create($contributor_bank_details);

            }
                
            $request->session()->flash('messageClass', 'alert alert-success'); //alert-danger
            $request->session()->flash('message', 'Account Info Updated Successfully.');
            return back();


        }


    }

    public function changePassword() {
        $data_msg = array();
        if (Auth::check()) {   
            $meta_array['meta_title']='Teachinns-Change Password';
            $meta_array['meta_desc']='Teachinns';
            $meta_array['meta_keyword']='Teachinns';
            $meta_array['meta_robots']='Teachinns';
           $data_msg['page_metadata'] = (object)$meta_array;         
            return view('frontend.contributor.changePassword', $data_msg);
            
        } else {
            return redirect()->route('loginAction');
        }
    }

   
    public function editContributor(Request $request,$id) {
        
        if (Auth::guard('contributors')->check()) {
            $user_id=Hasher::decode($id);
            $meta_array['meta_title']='Teachinns - My Account';
            $meta_array['meta_desc']='Teachinns';
            $meta_array['meta_keyword']='Teachinns';
            $meta_array['meta_robots']='Teachinns';
            
            $data_msg = array();
            $data_msg['page_metadata'] = (object)$meta_array;
             
            $result =  DB::table('users')
                        ->join('contributors as ct','ct.user_id','users.id')
                        ->select('users.id', 'ct.*', 'users.email')
                        ->where('users.user_type_id', '=', '3')
                        ->where('users.id', '=', Auth::id());                   

            $userinfo = $result->first();
            
            $subjects=[];        
            if($userinfo->subject_list){
                $subjects=explode(",",$userinfo->subject_list);
               
            }
           
            $bank_details =  DB::table('users')
                        ->join('user_bank_details as ubd','ubd.user_id','users.id')
                        ->select('users.id', 'ubd.*', 'users.email','users.user_type_id')
                        ->where('users.id', '=', Auth::id())
                        ->first();   
            
                       
            $data_msg['userinfo'] = $userinfo;            
            $data_msg['relatedsubject']=$subjects;
            $data_msg['bank_details'] = $bank_details;
            $data_msg['allSubjects']=SubjectMaster::where('status',1)->get();

			
            return view('frontend.contributor.editAccount', $data_msg);
			
			
        } else {
            return redirect()->intended(route('contributorlogin'));

        }
    }
   
    public function ajaxpaymentFilter(Request $request)
    {
        //return Auth::id();
        if ($request->ajax())
        {
           
            
            $date_from = $request->input('date_from');
            
            $date_to = $request->input('date_to');
            $contributor=Contributor::where('user_id',Auth::id())->first();
            $arrSearch[] =['ocpd.contributor_id','=',$contributor->contributor_id] ;
            //$arrSearch[] =['ord.id','<>','0'] ;
            
            if ($date_from != '') {
                
                $d_p_d = explode('/', $date_from);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $date_from = $d_p_d_m;
                $arrSearch[] = ['ord.created_at', '>=', $date_from];
            }

            if ($date_to != '') {

                $d_p_d = explode('/', $date_to);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $date_to = $d_p_d_m;

                $arrSearch[] = ['ord.created_at', '<=', $date_to];
            }
            
            $items = DB::table('orders as ord')
                ->join('order_contributor_payment_details as ocpd','ord.id','ocpd.order_id')
                ->join('products as pr','ord.course_id','pr.product_id')
                ->select(DB::raw('pr.product_id,pr.name,pr.price,pr.revised_price,sum(`ocpd`.`price_earn`) as total,ocpd.order_id,ord.order_id as reciept_id,ord.created_at'))
                ->where($arrSearch)
                ->groupBy('ord.id')
                ->get();    
            $data_msg['orders']=$items;    
            $total=0;
            $recieved_till_date=[];
            foreach($items as $item){
                $total=$total+$item->total;
                
                $recieved_till_date[]=PaymentRequestOrderDetail::where('order_id',$item->order_id)
                    ->where('pay_status',2)
                    ->sum('order_amount');
            }
            
            $allpaid=array_filter($recieved_till_date);
            $paid_amount=0;
            foreach($allpaid as $paid){
                $paid_amount=$paid_amount+$paid;
            }
            $returnHTML = view('frontend.reseller.order-request',$data_msg)->render();// or method that you prefere to return data + RENDER is the key here
            //return $returnHTML;
            return response()->json( array('success' => true, 'html'=>$returnHTML,'total_earned'=>$total,
                'paid_amount'=>$paid_amount,'total_due'=>$total-$paid_amount) );
            echo json_encode($items);die;
            //return $items;
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


    public function paymentRequestAction(Request $request) {
        //return $request;
        try{
            if(!$request->has('checkdorders')){
                \Session::flash('messageClass', 'alert alert-danger');
                \Session::flash('message', 'Please select an order.');
                
                return back();
            }

            $user=User::select('id','user_type_id')->find(Auth::id());
            
            
            $payment_request_data=[
                'user_id'=>$user->id,
                'user_type_id'=>$user->user_type_id,
                'requested_date'=>date('Y-m-d H:i:s')
                
            ];
            DB::beginTransaction();
            $payment_master_insert=PaymentRequestMaster::create($payment_request_data);
    
            $orders = $request->input('checkdorders');
            $i=0;
            foreach($orders as $order){
                $pay_request_order_data=[
                    'payment_request_id'=>$payment_master_insert->id,
                    'order_id'=>$order,
                    'order_amount'=>$request->orderamount[$i],
                    'pay_status'=>1,
                ];
    
                PaymentRequestOrderDetail::create($pay_request_order_data);
                $i++;
            }
            DB::commit();
            
            
            \Session::flash('messageClass', 'alert alert-success');
            \Session::flash('message', 'Request Sent successfully');
            
            return back();

        }catch(\Exception $e){
            DB::rollback();
            return back()->withErrors($e->getMessage())->withInput();
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



    
    
}
