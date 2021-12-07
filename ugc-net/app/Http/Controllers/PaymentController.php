<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;
use App\Coupon;
use Razorpay\Api\Api;

use Carbon\Carbon;
use DB;
use App\Order;
use App\Country;
use App\StateMaster;
use Auth;
use App\BillingDetail;
use App\PaymentResponse;
use Hasher;
use App\CardDetail;
use PDF;
use Terbilang;
use Mail;
use App\Mail\Order\OrderMail;
use App\OrderContributorPaymentDetails;
use App\Settings;

use App\PaymentDetail;
use App\ExamMaster;
use View;

class PaymentController extends Controller {
    public $api_key;
    public $api_secret;

    public function __construct() {
        $razorpay_api_key=Settings::where('setting_id','razorpay_api_key')->first();
        $razorpay_api_secret=Settings::where('setting_id','razorpay_api_secret')->first();

       $this->api_key=$razorpay_api_key->content;
       $this->api_secret=$razorpay_api_secret->content;

       $shareData = array();
        
        $mainMenu = Product::select('name','product_id','slug')->where('status', '=', '1')->orderBy('name', 'asc')->get();
        $exams = ExamMaster::select('exam_name','id')->where('status', '=', '1')->orderBy('id', 'asc')->get();
        $combo_pack_products = Product::select('product_id','name','slug')
                        ->where(['status' => '1',
                                'is_combo'=>1
                        ])
                        ->orderBy('name', 'asc')
                        ->get();
        $newsfeed=\App\NewsFeedMaster::where('status',1)->get();                
        $articles_cat=\App\ArticleCategory::where('status',1)->get();                
        $shareData['articlecats'] = $articles_cat;    
        $shareData['newsfeed'] = $newsfeed;     
        $floatersignup=\App\FloaterSignUpMaster::where('status',1)->first();   
        $shareData['floatersignup'] = $floatersignup;           
        
        $shareData['combo_pack_products'] = $combo_pack_products;
        $shareData['mainMenu'] = $mainMenu;
        $shareData['exams'] = $exams;
        View::share($shareData);
    }

    public function showPaymentRequestList()
    {
        if (Auth::guard('admins')->check())
        {
            $data_msg['menu_parent'] = 'orders';
            $data_msg['menu_child'] = 'order-list';
            
            $data_msg['allusertypes']=\App\UserType::whereIn('id',[3,4])
                        ->get();
            //$data_msg["masterList"] = Item::orderBy('updated_at', 'desc')->get();
            return view('admin.payment-request.list', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }
    
    public function ajaxPaymentRequestList(Request $request)
    {

        if ($request->ajax())
        {
            
            $name = $request->input('name');
            $user_type_id = $request->input('user_type_id');
            
            
            $date_from = $request->input('date_from');
            
            $date_to = $request->input('date_to');
            $subject_id = $request->input('subject_id');
          
        
            
            
            $arrSearch[] =['prm.user_type_id','<>','success1'] ;
            
            
            
            if ($name != '') {
                $arrSearch[] = ['us.name', 'like', '%' . $name . '%'];
            }
            if ($user_type_id != '') {
                $arrSearch[] = ['prm.user_type_id', $user_type_id];
            }
            if ($subject_id != '') {
                $arrSearch[] = ['csr.subject_id', $subject_id];
            }
            
            
            if ($date_from != '') {
                
                $d_p_d = explode('/', $date_from);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $date_from = $d_p_d_m;
                $arrSearch[] = ['prm.requested_date', '>=', $date_from];
            }

            if ($date_to != '') {

                $d_p_d = explode('/', $date_to);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $date_to = $d_p_d_m;

                $arrSearch[] = ['prm.requested_date', '<=', $date_to];
            }
           
                
            $items = DB::table('payment_request_masters as prm')
            ->select(DB::raw('prm.id,prm.user_id,prm.user_type_id,prm.requested_date,us.name,ut.name as utname'))
                ->join('users as us','prm.user_id','us.id')
                ->join('user_types as ut','ut.id','prm.user_type_id')
                ->orderBy('prm.id','desc')
                //->join('payment_request_order_details as prod','prod.payment_request_id','prm.id')
                //->groupBy('pr.id')
                ->where($arrSearch);

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

            $column = array( '#','name','user_type_id','requested_date','action');


            if ($order[0]['column'] != '') {
                $column_name = $column[$order[0]['column']];
            } else {
                //$column_name = $column[4];
                $column_name = 'orders.id';
                
            }

            // if ($order[0]['dir'] != '') {
            //     $asc_desc = $order[0]['dir'];
            // } else {
            // }
            $asc_desc = 'desc';
            

            
            $items_1 = $items = DB::table('payment_request_masters as prm')
                ->select(DB::raw('prm.id,prm.user_id,prm.user_type_id,prm.requested_date,us.name,ut.name as utname'))
                ->join('users as us','prm.user_id','us.id')
                ->join('user_types as ut','ut.id','prm.user_type_id')
                ->where($arrSearch);

            


            $items_1 = $items_1->orderBy($column_name, $asc_desc)
                    ->skip($iDisplayStart)
                    ->take($iDisplayLength)
                    ->get();
            $sl = 1;
            foreach ($items_1 as $t)
            {
               
                $status = '';
                // if ($t->status == 'success') {
                //     $status = '<span class="label label-sm label-success"> Success </span>';
                // }else if($t->status == 'created') {
                //     $status = '<span class="label label-sm label-warning">Pending</span>';

                // }
                // else {
                //     $status = '<span class="label label-sm label-warning">'.$t->status.'  </span>';
                // }
               

               
               
                $records["data"][] = array(
                    
                    $sl,
                    $t->name,
                    $t->utname,
                    \Carbon\Carbon::parse($t->requested_date)->format('d/m/Y'),
                    '<a href="'.route('viewPaymentRequestDetails',['id'=>Hasher::encode($t->id)]).'" class="btn btn-sm btn-default"><i class="fa fa-eye"></i> View </a>'
                    //'<a href="#" data-orderid="'.$t->id.'" data-toggle="modal" data-target="#viewOrder" class="btn btn-sm btn-default viewBilling" ><i class="fa fa-eye"></i> View </a>'
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

    public function viewPaymentRequestDetails(Request $request,$id)
    {
        if (Auth::guard('admins')->check()) {
            //$id=$request->order_id;
			//return $id;
            $data_msg = array();

            $data_msg['menu_parent'] = 'orders';
            $data_msg['menu_child'] = 'order-list';

            $data_msg['order_info']= DB::table('payment_request_masters as prm')
                    ->select(DB::raw('prm.id,prm.requested_date,us.name,ut.name as utname,
                        prod.order_id,`prod`.`order_amount`,orders.order_id as order_no,products.name as course_name,
                        prod.pay_date,prod.pay_status,prod.pay_type,prod.cheque_no_neft,orders.created_at as purchase_date
                        ,products.revised_price,products.price'    
                    ))
                    ->join('users as us','prm.user_id','us.id')
                    ->join('user_types as ut','ut.id','prm.user_type_id')
                    ->join('payment_request_order_details as prod','prod.payment_request_id','prm.id')
                    ->join('orders','orders.id','prod.order_id')
                    ->join('products','products.product_id','orders.course_id')
                    ->where('prm.id',$id)
                    ->get();

            // echo "<pre>";
            // print_r($data_msg['order_info']);die;
            // $data_msg['billing_info']=BillingDetail::where('order_id',$id)->first();
            // $data_msg['card_info']=CardDetail::where('order_id',$id)->first();
            // $data_msg['state']=StateMaster::where('state_id',$data_msg['billing_info']->state)->first();
            // $data_msg['country']=Country::where('id',$data_msg['billing_info']->country)->first();
            // $data_msg['payment_details']=PaymentDetail::where('order_id',$id)->first();

            //return $data_msg;
            return view('admin.payment-request.view', $data_msg);

            $returnHTML = view('admin.payment-request.view',$data_msg)->render();// or method that you prefere to return data + RENDER is the key here
            //return $returnHTML;
            return response()->json( array('success' => true, 'html'=>$returnHTML) );
			
        } else {

            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }
    public function updatePaymentRequestDetails(Request $request,$id)
    {
        //return $id;
        if (Auth::guard('admins')->check()) {
            //$id=$request->order_id;
			//return $id;
            $data_msg = array();

            if(!$request->has('order_no')){
                $request->session()->flash('messageClass', 'alert alert-danger');
                $request->session()->flash('message', 'Please select  order.');
    
                return back();
            }

            $order_no=$request->order_no;
            $pay_date=$request->pay_date;
            $pay_types=$request->pay_types;
            $pay_no=$request->pay_no;
           
            for($i=0;$i<count($order_no);$i++){
                $order_details=\App\PaymentRequestOrderDetail::where('order_id',$order_no[$i])
                ->where('payment_request_id',$id)
                ->first();
                $d_p_d = explode('/', $pay_date[$i]);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $str = $d_p_d_m;

                $payment_data=[
                    'pay_date'=>$str,
                    'pay_type'=>$pay_types[$i],
                    'pay_status'=>2,
                    'cheque_no_neft'=>$pay_no[$i]
    
                ];
                $order_details->update($payment_data);
            }

            $request->session()->flash('messageClass', 'alert alert-success');
                        $request->session()->flash('message', 'Payment Details updated successfully');
            
                        return back();
            // return view('admin.payment-request.view', $data_msg);

            // $returnHTML = view('admin.payment-request.view',$data_msg)->render();// or method that you prefere to return data + RENDER is the key here
            // //return $returnHTML;
            // return response()->json( array('success' => true, 'html'=>$returnHTML) );
			
        } else {

            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function viewPaymentRequestInfo(Request $request)
    {
        $id=$request->order_id;

			//return $id;
            $data_msg = array();

           

            $data_msg['order_info']=DB::table('orders')
                    ->join('users','users.id','orders.user_id')
                    ->join('products','products.product_id','orders.course_id')
                    ->select('orders.*','users.name as fullname','orders.user_id','products.name as product_name',
                            'products.product_id','users.email','products.price','products.revised_price')
                    ->where('orders.id',$id)
                    ->first();
            $data_msg['order_date']=\Carbon\Carbon::parse($data_msg['order_info']->created_at)->format('d/m/Y');

            $data_msg['billing_info']=BillingDetail::where('order_id',$id)->first();
            $data_msg['card_info']=CardDetail::where('order_id',$id)->first();
            @$data_msg['state']=StateMaster::where('state_id',$data_msg['billing_info']->state)->first();
            @$data_msg['country']=Country::where('id',$data_msg['billing_info']->country)->first();
            $data_msg['invoice_url']=route('downloadInvoicePDF',$data_msg['order_info']->id);
            $data_msg['payment_details']=PaymentDetail::where('order_id',$id)->first();
                
            return response()->json($data_msg);
			
        
    }


}
