<?php

namespace App\Http\Controllers;


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
use App\Distributor;
use App\SubjectMaster;
use App\UserBankDetail;
use Hasher;

class FrontendResellerController extends Controller {

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
        if (Auth::guard('resellers')->check()) {
            //return Auth::user();
            
            $data_msg = array();
            $data_msg['menu_parent'] = 'dashboard';
            $data_msg['menu_child'] = 'dashboard';
            $data_msg['users'] = '';
            $meta_array['meta_title']='Teachinns - Dashboard';
            $meta_array['meta_desc']='Teachinns';
            $meta_array['meta_keyword']='Teachinns';
            $meta_array['meta_robots']='Teachinns';
            
            
            
            $data_msg['page_metadata'] = (object)$meta_array;

            $distributor=Distributor::where('user_id',Auth::id())->first();
            $data_msg['distributor']=$distributor;
            $orders=\App\Order::where('reseller_id',$distributor->distributor_id);

            $total_earned= $orders->sum('commission_amount');       
           

            // $allorders= DB::table('orders as or')
            //     ->join('order_reseller_payment_details as ocpd','or.id','ocpd.order_id')  
            //     ->join('products as pr','or.course_id','pr.product_id')
            //     ->join('users as us','us.id','or.user_id')
            //     ->select(DB::raw('pr.product_id,pr.name,pr.price,us.name as username,pr.revised_price,sum(`ocpd`.`price_earn`) as total,ocpd.order_id,
            //     or.order_id as reciept_id,or.created_at'))
            //     ->where('distributor_id',$distributor->distributor_id)
            //     ->groupBy('or.id')
            //     ->whereNull('or.deleted_at')
            //     ->orderBy('or.id','desc')
            //     ->get();
           
            $allorders= DB::table('orders as or')
                //->join('order_reseller_payment_details as ocpd','or.id','ocpd.order_id')  
                ->join('products as pr','or.course_id','pr.product_id')
                ->join('users as us','us.id','or.user_id')
                ->select(DB::raw('pr.product_id,pr.name,pr.price,us.name as username,pr.revised_price,or.commission_amount,or.order_id,or.commission_percent,
                or.order_id as reciept_id,or.created_at','or.payment_status'))
                ->where('reseller_id',$distributor->distributor_id)
                ->where('or.payment_status','success')
                ->groupBy('or.id')
                ->whereNull('or.deleted_at')
                ->orderBy('or.id','desc')
                ->get();

            $data_msg['orders']= $allorders;  
            $data_msg['total_earned']= $total_earned; 
             
            return view('frontend.reseller.dashboard', $data_msg);
            

          
			
            
        } else {
            return redirect()->intended(route('contributorlogin'));
        }
    }

    public function myAccount() {       

        if (Auth::check()) {
            $data_msg = array();
            $meta_array['meta_title']='Teachinns - My Account';
            $meta_array['meta_desc']='Teachinns';
            $meta_array['meta_keyword']='Teachinns';
            $meta_array['meta_robots']='Teachinns';
            
            
            
            $data_msg['page_metadata'] = (object)$meta_array;
             
            $result =  DB::table('users')
                        ->join('distributors as ct','ct.user_id','users.id')
                        ->select('users.id', 'ct.*', 'users.email')
                        ->where('users.user_type_id', '=', '4')
                        ->where('users.id', '=', Auth::id());                   

            $userinfo = $result->first();
            
            $subject_name=[];        
            
           
            $bank_details =  DB::table('users')
                        ->join('user_bank_details as ubd','ubd.user_id','users.id')
                        ->select('users.id', 'ubd.*', 'users.email','users.user_type_id')
                        ->where('users.id', '=', Auth::id())
                        ->first();   
            
                       
            $data_msg['userinfo'] = $userinfo;            
            
            $data_msg['bank_details'] = $bank_details;
            //dd($data_msg['userinfo']);         
            
            return view('frontend.reseller.myAccount', $data_msg);
            
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
            $reseller_details=array(
                        'user_id'=>$id,
                        'firstname'=>$firstname,
                        'lastname'=>$lastname,
                        'contactnumber'=>$contactnumber
            );
            $reseller_bank_details=array(
                        'user_id'=>$id,
                        'ac_holder_name'=>$ac_holder_name,
                        'account_number'=>$account_number,
                        'bank_name'=>$bank_name,
                        'bank_branch'=>$bank_branch,
                        'ifsc_code'=>$ifsc_code
             
            );
            
            $reseller_info=Distributor::where('user_id',$id)->update($reseller_details);
            $reseller_bank_info=UserBankDetail::where('user_id',$id)->first();
            if($reseller_bank_info){
                $reseller_bank_info->update($reseller_bank_details);
            }else{
                // echo "<pre>";
                // print_r($reseller_bank_details);die;
                UserBankDetail::create($reseller_bank_details);

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
            return view('frontend.reseller.changePassword', $data_msg);
            
        } else {
            return redirect()->route('loginAction');
        }
    }

   
    public function editReseller(Request $request,$id) {
        if (Auth::guard('resellers')->check()) {
            $user_id=Hasher::decode($id);
            $data_msg = array();
            
            $meta_array['meta_title']='Teachinns - My Account';
            $meta_array['meta_desc']='Teachinns';
            $meta_array['meta_keyword']='Teachinns';
            $meta_array['meta_robots']='Teachinns';
            
            
            
            $data_msg['page_metadata'] = (object)$meta_array;
             
            $result =  DB::table('users')
                        ->join('distributors as ct','ct.user_id','users.id')
                        ->select('users.id', 'ct.*', 'users.email')
                        ->where('users.user_type_id', '=', '4')
                        ->where('users.id', '=', $user_id);                   

            $userinfo = $result->first();
            
            
           
            $bank_details =  DB::table('users')
                        ->join('user_bank_details as ubd','ubd.user_id','users.id')
                        ->select('users.id', 'ubd.*', 'users.email','users.user_type_id')
                        ->where('users.id', '=', $user_id)
                        ->first();   
            
                       
            $data_msg['userinfo'] = $userinfo;            
            
            $data_msg['bank_details'] = $bank_details;
            $data_msg['allSubjects']=SubjectMaster::where('status',1)->get();

			
            return view('frontend.reseller.editAccount', $data_msg);
			
			
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
            $distributor=Distributor::where('user_id',Auth::id())->first();
            $arrSearch[] =['ocpd.distributor_id','=',$distributor->distributor_id] ;
            
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


           
            $items =    DB::table('orders as ord')
                ->join('order_reseller_payment_details as ocpd','ord.id','ocpd.order_id')
                ->join('products as pr','ord.course_id','pr.product_id')
                ->select(DB::raw('pr.product_id,ord.user_id,pr.name,pr.price,pr.revised_price,sum(`ocpd`.`price_earn`) as total,ocpd.order_id,ord.order_id as reciept_id,ord.created_at'))
                ->where($arrSearch)
                ->orderBy('ord.id','desc')
                ->groupBy('ord.id')
                ->get();  
            $data_msg['orders']=$items;    
            $total=0;
            $recieved_till_date=[];
            foreach($items as $item){
                $total=$total+$item->total;
                $recieved_till_date[]=\App\PaymentRequestOrderDetail::where('order_id',$item->order_id)
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
            return response()->json( array('success' => true, 'html'=>$returnHTML,'total_earned'=>$total,'paid_amount'=>$paid_amount,'total_due'=>$total-$paid_amount) );
               
            //return $items;    
            
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
        $contributor=Contributor::where('user_id',Auth::id())->first();
        echo $contributor->contributor_id;
        return $request;

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

    public function saveResellerCodeSession(Request $request)
    {
        
        $reseller_code=$request->code;

        $code_exists=Distributor::where('reseller_code',$reseller_code)->first();

        if($code_exists){
            session(['reseller_code' => $reseller_code]);
            return redirect('/');
        }

        $request->session()->flash('messageClass', 'alert alert-danger');
        $request->session()->flash('message', 'Reseller Code Link is either expired/wrong.');

         return abort(404);



    }

    
}
