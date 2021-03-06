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
use App\Distributor;
use PDF;
use Terbilang;
use Mail;
use App\Mail\Order\OrderMail;
use App\OrderContributorPaymentDetails;
use App\Settings;

use App\PaymentDetail;
use App\ExamMaster;
use App\OrderResellerPaymentDetails;
use App\PaymentGatewaySettings;
use View;
use MPDF;
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;


class OrderController extends Controller {
    public $api_key;
    public $api_secret;

    public function __construct() {
        $razorpay_used=PaymentGatewaySettings::where('setting_id','razorpay_used')->first();
        $razorpay_used=$razorpay_used->content;
        // dd($razorpay_used);
        if($razorpay_used==1){

            $razorpay_api_key=PaymentGatewaySettings::where('setting_id','razorpay_test_api_key')->first();
            $razorpay_api_secret=PaymentGatewaySettings::where('setting_id','razorpay_test_api_secret')->first();
        }
        if($razorpay_used==2){

            $razorpay_api_key=PaymentGatewaySettings::where('setting_id','razorpay_live_api_key')->first();
            $razorpay_api_secret=PaymentGatewaySettings::where('setting_id','razorpay_live_api_secret')->first();
        }


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

        $newsfeed = DB::connection('mysql2')->table('tbl_news_feed')->where('status', 1)->get();
        $social = DB::connection('mysql2')->table('tbl_social_link')->get();
        $contact = DB::connection('mysql2')->table('tbl_contact')->get();
        $counter = DB::connection('mysql2')->table('tbl_no_of_visitor')->get();
        $shareData['newsfeed'] = $newsfeed;
        $shareData['social'] = $social;
        $shareData['contact'] = $contact;
        $shareData['counter'] = $counter;
        
        $shareData['combo_pack_products'] = $combo_pack_products;
        $shareData['mainMenu'] = $mainMenu;
        $shareData['exams'] = $exams;
        View::share($shareData);
    }

    public function index(Request $request) {
        //echo $request->session()->pull('buy_course_id');die;
        //echo ;die;
        // dd(Auth::check());
        if (Auth::check()) { 
            $meta_array['meta_title']=env('APP_NAME','IIPARS').'-Billing';
            $meta_array['meta_desc']=env('APP_NAME','IIPARS').'';
            $meta_array['meta_keyword']=env('APP_NAME','IIPARS').'';
            
            $data_msg['page_metadata'] = (object)$meta_array;
            if($request->has('product_id')){
                $product_id=$request->input('product_id');
            }
            elseif($request->session()->has('buy_course_id')){
                $product_id=\Session::get('buy_course_id');
            }

            //dd($product_id); 
            $products=Product::select('product_id','name','price','revised_price','is_reseller_charge','revised_percent','extra_discount')->find($product_id);
            $data_msg['products']=$products;
            
            $data_msg['states']=StateMaster::where('status','<>',3)->get();
            
            $lastOrder=Order::where('user_id',Auth::id())->orderBy('id','desc')->first();
            $data_msg['lastbillinfo']=[];
            if($lastOrder){
                $data_msg['lastbillinfo']=BillingDetail::where('order_id',$lastOrder->id)->first();
                
            }
            
            $revised_price=$products->revised_price!=""?$products->revised_price:$products->price;
            $discount_percentage=$products->revised_percent;
            $discount_amount=0;
            $extra_discount=$products->extra_discount;
            // dd($products);
            if($discount_percentage){
                $discount_amount= ($products->price * $discount_percentage)/100;
                $revised_price=$products->price - $discount_amount;
            }
            if($products->extra_discount){
                $revised_price=$revised_price-$products->extra_discount;
            }
            $data_msg['revised_price']=$revised_price;
            $data_msg['discount_percentage']=$discount_percentage;
            $data_msg['discount_amount']=$discount_amount;
            $data_msg['extra_discount']=$extra_discount;
            
            $data_msg['price']=$products->price;
            // dd($data_msg);
            $reseller_code= \Session::get('reseller_code');
            
            $reseller_info=Distributor::whereNotNull('reseller_code')->where('reseller_code',$reseller_code)->first();
            // dd($reseller_info);

            $data_msg['total_after_cashback']=$revised_price;
            $data_msg['cb_amount']="";
            $data_msg['reseller_code']="";



           
            if($reseller_info && $reseller_info->user->status==1){
                $data_msg['reseller_code']=$reseller_info->reseller_code;
                $student_cb_per=getSettings('student_cashback');
                $cb_amount=($price * $student_cb_per/100);
                $cb_amount=number_format((float)$cb_amount, 2, '.', '');
                $total_after_cashback=$price-$cb_amount;

                $data_msg['cb_amount']=$cb_amount;
                $data_msg['total_after_cashback']=$total_after_cashback;
                

                //dd($total_cashback);

            }
            
            $data_msg['userinfo'] =  DB::table('users')
                        ->join('students as st','st.user_id','users.id')
                        ->select('users.id', 'st.*', 'users.email')
                        //->where('users.user_type_id', '=', '2')
                        ->where('users.id', '=', Auth::id())
                        ->first();
            // if(!$data_msg['userinfo']){
            //     $data_msg['userinfo']=Auth::user();
            // }
            //     dd($data_msg['userinfo']);
            if(floor($data_msg['products']->price)=="0"){
                $latestOrder=0;
                $order_nr='IIP'.str_pad($latestOrder + 1, 5, "0", STR_PAD_LEFT);
                $latestOrder = Order::orderBy('created_at','DESC')->first();

                if($latestOrder){
                    
                    $order_nr = 'IIP'.str_pad($latestOrder->id + 1, 5, "0", STR_PAD_LEFT);
                    
                }
                $order_data=array(
                    'receipt'=> $order_nr,
                    'course_id'=> $product_id,
                    'payment_order_id'=> "",
                    'subtotal'=> "0.00",
                    'discount_amount'=> "0.00",
                    'grand_total'=> "0.00",
                    'status'=> "success",
                );

                $order_info=$this->savePreviewItemOrder($order_data);
                $order_id=$order_info->id;
                $this->savePreviewItemBillingDetails($order_id);
                $payment_data=array(
                    'order_id'=>$order_id,
                    'payment_method'=>"Free"
                   
               );
               $billinfo=PaymentDetail::create($payment_data);
                return redirect()->intended(route('thankYou',['order_id'=>Hasher::encode($order_id)]));
            }
            
            return view('frontend.course.billing.billing',$data_msg);

        } else {
            return redirect()->route('loginAction');
        }

    }

    private function savePreviewItemBillingDetails($localorderid){
        //try{
         $result =  DB::table('users')
         ->join('students as st','st.user_id','users.id')
         ->select('users.id', 'st.*', 'users.email')
         //->where('users.user_type_id', '=', '2')
         ->where('users.id', '=', Auth::id());
         $result = $result->first();
            // dd($result);
            $billing_data=array(
                 'order_id'=>$localorderid,
                 'first_name'=>$result->firstname,
                 'last_name'=>$result->lastname,
                 //'company_name'=>$result->company_name,
                 'country'=>$result->country_id?$result->country_id:100,
                 'street_address_1'=>$result->address,
                 //'street_address_2'=>$result->street_address_2,
                 //'city'=>$result->city,
                 //'state'=>$result->state,
                 //'zip'=>$result->zip,
                 'phone'=>$result->contactnumber,
                 'email'=>$result->email,
                 //'order_notes'=>$request->order_notes,
            );
            $billinfo=BillingDetail::create($billing_data);
           // DB::commit();
            return $billinfo;
 
         // }catch (\Exception $e) {
         //     DB::rollback();
         //     return $e->getMessage();
         // } 
     }

    private function savePreviewItemOrder($order){
        // DB::beginTransaction();

        // try {
            $order_data=array(
                'order_id'=>$order['receipt'],
                'user_id'=>Auth::user()->id,
                'course_id'=>$order['course_id'],
                'payment_order_id'=>$order['payment_order_id'],
                'subtotal'=>$order['subtotal'],
                'discount_amount'=>$order['discount_amount'],
                'grand_total'=>$order['grand_total'],
                'payment_status'=>$order['status'],
                
            );

            $orderinfo=Order::create($order_data);
            DB::commit();

            return $orderinfo;
        // }catch (\Exception $e) {
        //     DB::rollback();
        //     return $e->getMessage();
        // }

    }

    public function ajaxCheckCoupon(Request $request){
        $coupon_code=$request->coupon_code;
        $subtotal=(double)$request->subtotal;
        
        $couponExists=Coupon::where('coupon_code',$coupon_code)
        ->where('status',1)
        ->first();
        
        $discount_price=0.00;
        $discount=0.00;
        $result=array(
            'statusCode'=>0,
            'discount'=>$discount,
            'discount_price'=>$discount_price,
            'errorMessage'=>'Invalid Code'
        );
        if($couponExists){
            $from = strtotime($couponExists->start_date);
            $to = strtotime($couponExists->end_date);
            
            $today = strtotime(date('Y-m-d'));
            
            if(!($from<=$today && $to>=$today)){
                $result=array(
                    'statusCode'=>401,
                    'errorMessage'=>'Code Expired'
                );
                return response()->json($result);
            }
            
            $discount_type=$couponExists->discount_type;  
            switch ($discount_type) {
                case 1:
                    $discount=$couponExists->price;
                    $discount_price=$subtotal-$discount;
                break;
                case 2:
                    $discount=round(($subtotal*$couponExists->price/100),2);
                    $discount_price=round($subtotal-$discount,2);
                break;
                default:
                $discount_price;
            }   
            $result=array(
                'statusCode'=>1,
                'discount'=>$discount,
                'discount_price'=>$discount_price
            );
            
            
        }
        
        return response()->json($result);
    }
    public function ajaxResellerCode(Request $request){
        $reseller_code=$request->reseller_code;
        $price=$request->subtotal;
        $student_cb_per=getSettings('student_cashback');
        //return $student_cb_per;
       
        
        $couponExists=Distributor::where('reseller_code',$reseller_code)
        ->where('reseller_code','<>','')
        ->first();
        $couponExists=DB::table('users')
                     ->join('distributors','distributors.user_id','users.id')   
                     ->where('distributors.reseller_code',$reseller_code)
                     ->where('distributors.reseller_code','<>','')
                     ->where('users.status',1)
                     ->select('distributors.reseller_code','users.status')
                     ->first();


        
        
        $discount_price=0.00;
        $discount=0.00;
        $result=array(
            'statusCode'=>0,
            'discount'=>$discount,
            'discount_price'=>$discount_price,
            'message'=>'Invalid Code/Code Expired'
        );
        if($couponExists){
            $cb_amount=$price * $student_cb_per/100;
            $cb_amount=number_format((float)$cb_amount, 2, '.', '');
            $total_after_cashback=$price-$cb_amount;
            $total_after_cashback=number_format((float)$total_after_cashback, 2, '.', '');
            
            

            
            $result=array(
                'statusCode'=>1,
                'discount'=>$cb_amount,
                'discount_price'=>$total_after_cashback,
                'message'=>'Applied'

            );
            
            
        }
        
        return response()->json($result);
    }
    public function ajaxResellerCodeExists(Request $request){
        if ($request->ajax()) {
            $reseller_code = trim($request->input('reseller_code'));
            //$ck = Distributor::where('reseller_code', $reseller_code)->first();
            $ck = $couponExists=DB::table('users')
            ->join('distributors','distributors.user_id','users.id')   
            ->where('distributors.reseller_code',$reseller_code)
            ->where('distributors.reseller_code','<>','')
            ->where('users.status',1)
            ->select('distributors.reseller_code','users.status')
            ->first();
            
            if (!empty($ck)) {
                return "true";
            } else {
                return "false";
            }
        }
        
    }

    public function billing(Request $request)
    {
        
        try {
            $api = new Api($this->api_key, $this->api_secret);
            $latestOrder=0;
            $order_nr='IIP'.str_pad($latestOrder + 1, 5, "0", STR_PAD_LEFT);
            $latestOrder = Order::orderBy('created_at','DESC')->first();
            if($latestOrder){
                
                $order_nr = 'IIP'.str_pad($latestOrder->id + 1, 5, "0", STR_PAD_LEFT);
            }
            
            
            $amount=$request->grand_total*100;
            $data = array(
                'receipt' => $order_nr,
                'amount' => $amount,
                'payment_capture' => 1,
                'currency' => 'INR'
            );
            // dd($data);
            $order = $api->order->create($data);
            $insertedorder=$this->saveOrder($request,$order); 
            
            if($insertedorder){
                PaymentResponse::create([
                    'order_id'=>$insertedorder->id,
                    'payment_created_response'=>serialize($order)
                ]);
                $billing_details=$this->saveBillingDetails($request,$insertedorder->id);
    
                $data['order']=$insertedorder;
                $data['billing_detail_id']=$billing_details->id;
    
                $data=array(
                    'order_id'=>$insertedorder->payment_order_id,
                    'billing_detail_id'=>$billing_details->id,
                    'amount'=>$amount,
                    'currency' => 'INR',
                    'status'=>'success',
                    'api_key'=>$this->api_key,
                    'url'=>route('orderPay',['order_id'=>Hasher::encode($insertedorder->id)])
                );
                return response()->json($data);
            }

            $data=array(
                'status'=>0
            );
            return response()->json($data);
        }catch (\Exception $e) {
            $data=array(
                'result'=>'error',
                'message'=>$e->getMessage()
            );          
          return  response()->json($data);
            
        }

    }

    public function orderPay(Request $request,$order_id)
    {
        $meta_array['meta_title']=env('APP_NAME','IIPARS').'-Order Pay';
            $meta_array['meta_desc']=env('APP_NAME','IIPARS').'';
            $meta_array['meta_keyword']=env('APP_NAME','IIPARS').'';
            
            $data['page_metadata'] = (object)$meta_array;
        $order_id=Hasher::decode($order_id);
        
        $data['order']=Order::find($order_id);
        $data['billing_info']=BillingDetail::where('order_id',$order_id)->first();
        $data['api_key']=$this->api_key;
        $data['api_secret']=$this->api_secret;

        return view('frontend.course.billing.order-pay',$data);
    }

    public function paymentSuccessAction(Request $request)
    {
        $api = new Api($this->api_key, $this->api_secret);
        
        $p_gateway_payment_id=$request->razorpay_payment_id;
        $payment_order_id=$request->razorpay_order_id;
        $order_info=Order::where('payment_order_id',$payment_order_id)->first();
        $local_order_id=$order_info->id;
        $transaction_info=$request->transaction_info;
        $payment = $api->payment->fetch($p_gateway_payment_id);


        //print_r($payment);die;
        if($payment->method=="card"){
            $card_id=$payment->card_id;
            $card = $api->card->fetch($card_id);

            CardDetail::create([
                'order_id'=>$order_info->id,
                'p_gateway_payment_id'=>$p_gateway_payment_id,
                'card_id'=>$card->id,
                'entity'=>$card->entity,
                'card_user_name'=>$card->name,
                'last4digit'=>$card->last4,
                'card_network'=>$card->network,
                'card_type'=>$card->type,
                'issuer'=>$card->issuer,
            ]);
            $this->saveCardDetails($payment,$local_order_id);
        }
        if($payment->method=="upi"){
            $this->saveUPIDetails($payment,$local_order_id);
        }
        if($payment->method=="wallet"){
            $this->saveWalletDetails($payment,$local_order_id);
        }
        if($payment->method=="netbanking"){
            $this->saveBankDetails($payment,$local_order_id);
        }
       
        $order_info->p_gateway_payment_id=$p_gateway_payment_id;
        $order_info->payment_status='success';
        $order_info->save();
        

        $payment_response_info=PaymentResponse::where('order_id',$order_info->id)->first();
        $payment_response_info->payment_success_response=$transaction_info;
        $payment_response_info->save();

        $data=array(
            'order_id'=>$order_info->id,
            'status'=>'success',
            'url'=>route('thankYou',['order_id'=>Hasher::encode($order_info->id)])
        );
        return response()->json($data);

    }

    public function thankYou(Request $request,$order_id)
    {
        
        $meta_array['meta_title']=env('APP_NAME','IIPARS').'-Thank You';
        $meta_array['meta_desc']=env('APP_NAME','IIPARS').'';
        $meta_array['meta_keyword']=env('APP_NAME','IIPARS').'';
        
        $data['page_metadata'] = (object)$meta_array;
        $order_id=Hasher::decode($order_id);
        
        $data['order']=Order::find($order_id);
        $data['billing_info']=BillingDetail::where('order_id',$order_id)->first();
        $product_id=$data['order']->course_id;
        $data['state']=StateMaster::where('state_id',$data['billing_info']->state)->first();
        $data['country']=Country::where('id',$data['billing_info']->country)->first();
        $data['product']=Product::where('product_id',$product_id)->first();

        if($data['order']->payment_status=="success"){
            $data['payment_details']=PaymentDetail::where('order_id',$order_id)->first();
        }
        if(floor($data['product']->price)>0){
            $this->contributorShareCalculation($order_id);
        }
        if($data['order']->reseller_code_applied){
            $this->resellerShareCalculation($order_id,$data['order']->reseller_code_applied);
        }


        if($data['payment_details']->payment_method!="Free"){
            $this->sendOrderMail($data,$order_id);
            $this->sendAdminOrderMail($data,$order_id);
        }

        return view('frontend.course.billing.thank-you',$data);
    }

    public function sendOrderMail($data,$order_id)
    {
        try{

            $temp_data = \App\EmailTemplates::where(['mail_id'=>'order-mail'])->first();
            $template_data = $temp_data;
            $product=$data['product'];
            $order=$data['order'];
            $amount=$product->price;
            $payment=$data['payment_details'];
            $subtotal=$amount;
            if($order->discount_amount){
                $subtotal=$order->subtotal;
            }

            
            
            $email=Auth::user()->email;
            $user_name=Auth::user()->name;
            
            $order_id=$data['order']->order_id;
            $product_name=$product->name;
            $amount=$amount;
            $discount_amount=$order->discount_amount==""?'0.00':$order->discount_amount;
            $extra_discount=$order->extra_discount?$order->extra_discount:0.00;
            $subtotal=$subtotal;
            $payment_method=$payment->payment_method;
            $grand_total=$order->grand_total;
    
    
            $content = $template_data->content;
            $content = str_replace("{{user_name}}", $user_name, $content);
            $content = str_replace("{{order_id}}", $order_id, $content);
            $content = str_replace("{{amount}}", $amount, $content);
            $content = str_replace("{{product_name}}", $product_name, $content);
            $content = str_replace("{{discount_amount}}", $discount_amount, $content);
            $content = str_replace("{{extra_discount_amount}}", $extra_discount, $content);
            $content = str_replace("{{subtotal}}", $subtotal, $content);
            $content = str_replace("{{payment_method}}", $payment_method, $content);
            $content = str_replace("{{grand_total}}", $grand_total, $content);
    
            $emailData = array();
            $emailData['subject'] = trim($template_data->subject)."#".$order_id;
            $emailData['body'] = trim($content);
            $emailData['to_email'] = $email;
            $emailData['from_email'] = trim(getSettings('from_email'));
            $emailData['from_name'] = trim(getSettings('from_name'));
            //echo "<pre>"; print_r($emailData); die;
    
            Mail::send('frontend.emails.order', ['emailData' => $emailData], function ($message) use ($emailData) {
    
                    $message->from($emailData['from_email'], $emailData['from_name']);
    
                    $message->to($emailData['to_email'])->subject($emailData['subject']);
                    //$message->to('moutusi@karmicksolutions.com')->subject($emailData['subject']);
            });
        }catch (\Exception $e){
             return redirect()->intended(route('thankYou',['order_id'=>$order_id]))
                ->withError($e->getMessage())->withInput();
        }


            
    }
    public function sendAdminOrderMail($data,$order_id)
    {
        
        try{
            $temp_data = \App\EmailTemplates::where(['mail_id'=>'admin-order-mail'])->first();
            if($temp_data->status==1){

                $template_data = $temp_data;
                $product=$data['product'];
                $order=$data['order'];
                $amount=$product->revised_price!=""?$product->revised_price:$product->price;
                $payment=$data['payment_details'];
                $subtotal=$order->subtotal;
                
                $email=trim(getSettings('from_email'));
                $user_name='Admin';
                
                $order_id=$data['order']->order_id;
                $product_name=$product->name;
                $amount=$amount;
                $discount_amount=$order->discount_amount==""?'0.00':$order->discount_amount;
                $extra_discount=$order->extra_discount?$order->extra_discount:0.00;
                $subtotal=$subtotal;
                $payment_method=$payment->payment_method;
                $grand_total=$order->grand_total;
        
        
                $content = $template_data->content;
                $content = str_replace("{{user_name}}", $user_name, $content);
                $content = str_replace("{{order_id}}", $order_id, $content);
                $content = str_replace("{{amount}}", $amount, $content);
                $content = str_replace("{{product_name}}", $product_name, $content);
                $content = str_replace("{{discount_amount}}", $discount_amount, $content);
                $content = str_replace("{{extra_discount_amount}}", $extra_discount, $content);
                $content = str_replace("{{subtotal}}", $subtotal, $content);
                $content = str_replace("{{payment_method}}", $payment_method, $content);
                $content = str_replace("{{grand_total}}", $grand_total, $content);
        
                $emailData = array();
                $emailData['subject'] = trim($template_data->subject)."#".$order_id;
                $emailData['body'] = trim($content);
                $emailData['to_email'] = $email;
                $emailData['from_email'] = trim(getSettings('from_email'));
                $emailData['from_name'] = trim(getSettings('from_name'));
                // echo "<pre>"; print_r($emailData); die;
        
                
        
            
        
                Mail::send('frontend.emails.order', ['emailData' => $emailData], function ($message) use ($emailData) {

                    $message->from($emailData['from_email'], $emailData['from_name']);

                    $message->to($emailData['to_email'])->subject($emailData['subject']);
                    //$message->to('moutusi@karmicksolutions.com')->subject($emailData['subject']);
                });
            }
        }catch (\Exception $e){
            return redirect()->intended(route('thankYou'))
                    ->withError($e->getMessage())->withInput();
        }
           
    }

    public function paymentCancel(Request $request,$order_id)
    {
        $meta_array['meta_title']=env('APP_NAME','IIPARS').'-Cancel Payment';
        $meta_array['meta_desc']=env('APP_NAME','IIPARS').'';
        $meta_array['meta_keyword']=env('APP_NAME','IIPARS').'';
        
        $data['page_metadata'] = (object)$meta_array;
        $order_id=Hasher::decode($order_id);
        
        $data['order']=Order::find($order_id);
        $data['billing_info']=BillingDetail::where('order_id',$order_id)->first();
        $product_id=$data['order']->course_id;
        $data['state']=StateMaster::where('state_id',$data['billing_info']->state)->first();
        $data['country']=Country::where('id',$data['billing_info']->country)->first();
        $data['product']=Product::where('product_id',$product_id)->first();


        return view('frontend.course.billing.payment-cancel',$data);
    }
    
    private function saveOrder($request,$order){
        // DB::beginTransaction();
        $products=Product::select('product_id','name','price','revised_price','is_reseller_charge')->find($request->product_id);
        // $price=$products->revised_price!=""?$products->revised_price:$products->price;
        $price=$products->price;


        $reseller_code=isset($request->reseller_code)?$request->reseller_code:'';
        $reseller_id='';
        if($reseller_code){

            $reseller=Distributor::where('reseller_code',$reseller_code)->first();
            $reseller_id=$reseller->distributor_id;
        }
        

        // try {
            $order_data=array(
                'order_id'=>$order['receipt'],
                'user_id'=>Auth::user()->id,
                'course_id'=>$request->product_id,
                'course_price'=>$price,
                'payment_order_id'=>$order['id'],
                'subtotal'=>$request->subtotal,
                'discount_amount'=>$request->discount_amount,
                'extra_discount'=>$request->extra_discount,
                'grand_total'=>$request->grand_total,
                'reseller_code_applied'=>$reseller_code,
                'reseller_id'=>$reseller_id,
                'student_cb_percent'=>isset($request->cb_amount)?getSettings('student_cashback'):'',
                'student_cb_amount'=>isset($request->cb_amount)?$request->cb_amount:'',
                'payment_status'=>$order['status'],
                'created_at'=>$order['created_at']
            );

            $orderinfo=Order::create($order_data);
            DB::commit();

            return $orderinfo;
        // }catch (\Exception $e) {
        //     DB::rollback();
        //     return $e->getMessage();
        // }

    }
    
    private function saveCardDetails($paymentinfo,$localorderid){
       //try{
           $payment_data=array(
                'order_id'=>$localorderid,
                'payment_method'=>$paymentinfo->method,
                'card_id'=>$paymentinfo->card_id,
               
           );
           $billinfo=PaymentDetail::create($payment_data);
          // DB::commit();
           return $billinfo;

        // }catch (\Exception $e) {
        //     DB::rollback();
        //     return $e->getMessage();
        // } 
    }
    private function saveBankDetails($paymentinfo,$localorderid){
       //try{
           $payment_data=array(
                'order_id'=>$localorderid,
                'payment_method'=>$paymentinfo->method,
                'bank'=>$paymentinfo->bank,
               
           );
           $billinfo=PaymentDetail::create($payment_data);
          
           return $billinfo;

        // }catch (\Exception $e) {
        //     DB::rollback();
        //     return $e->getMessage();
        // } 
    }
    private function saveWalletDetails($paymentinfo,$localorderid){
       //try{
           $payment_data=array(
                'order_id'=>$localorderid,
                'payment_method'=>$paymentinfo->method,
                'wallet'=>$paymentinfo->wallet,
               
           );
           $billinfo=PaymentDetail::create($payment_data);
          
           return $billinfo;

        // }catch (\Exception $e) {
        //     DB::rollback();
        //     return $e->getMessage();
        // } 
    }
    private function saveUPIDetails($paymentinfo,$localorderid){
       //try{
           $payment_data=array(
                'order_id'=>$localorderid,
                'payment_method'=>$paymentinfo->method,
                'vpa'=>$paymentinfo->vpa,
               
           );
           $billinfo=PaymentDetail::create($payment_data);
          
           return $billinfo;

        // }catch (\Exception $e) {
        //     DB::rollback();
        //     return $e->getMessage();
        // } 
    }
    private function saveBillingDetails($request,$localorderid){
       //try{
        $result =  DB::table('users')
        ->join('students as st','st.user_id','users.id')
        ->select('users.id', 'st.*', 'users.email')
        ->where('users.user_type_id', '=', '2')
        ->where('users.id', '=', Auth::id());
        $result = $result->first();
       // print_r($result->country_id );die;

           $billing_data=array(
                'order_id'=>$localorderid,
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                //'company_name'=>$request->company_name,
                'country'=>$result->country_id?$result->country_id:100,
                'street_address_1'=>@$request->street_address_1,
                'street_address_2'=>@$request->street_address_2,
                'city'=>$request->city,
                'state'=>$request->state,
                'zip'=>$request->zip,
                'phone'=>$request->phone,
                'email'=>$request->email,
                //'order_notes'=>$request->order_notes,
           );
           $billinfo=BillingDetail::create($billing_data);
          // DB::commit();
           return $billinfo;

        // }catch (\Exception $e) {
        //     DB::rollback();
        //     return $e->getMessage();
        // } 
    }
    
    public function showOrderList()
    {
        if (Auth::guard('admins')->check())
        {
            $data_msg['menu_parent'] = 'orders';
            $data_msg['menu_child'] = 'order-list';
            $data_msg['allProducts']=Product::where('status',1)->orderBy('name','Asc')->get();
           
            $data_msg['allStudents'] =  $users = DB::table('users')
                                    ->join('students as st','st.user_id','users.id')
                                    ->select('users.id', 'st.firstname', 'st.lastname', 'users.email', 'users.is_approved','users.status')
                                    ->get();
            

            $data_msg['allCourses']=Product::where('status',1)->get();
            $data_msg['allsubjects']=\App\SubjectMaster::where('status',1)
                        ->orderBy('subject_name', 'Asc')
                        ->get();
            //$data_msg["masterList"] = Item::orderBy('updated_at', 'desc')->get();
            return view('admin.courses.orders.list', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }
    public function myOrders()
    {
        if (Auth::check())
        {
            $meta_array['meta_title']=env('APP_NAME','IIPARS').'-My Orders';
            $meta_array['meta_desc']=env('APP_NAME','IIPARS').'';
            $meta_array['meta_keyword']=env('APP_NAME','IIPARS').'';
           $data_msg['page_metadata'] = (object)$meta_array;
            $data_msg['allProducts']=Product::where('status',1)->orderBy('name','Asc')->get();
           
            $data_msg['allStudents'] =  $users = DB::table('users')
                                    ->join('students as st','st.user_id','users.id')
                                    ->select('users.id', 'st.firstname', 'st.lastname', 'users.email', 'users.is_approved','users.status')

                                    ->get();
            

            $data_msg['allCourses']=Product::where('status',1)->get();
            $data_msg['allsubjects']=\App\SubjectMaster::where('status',1)
                        ->orderBy('subject_name', 'Asc')
                        ->get();
            //$data_msg["masterList"] = Item::orderBy('updated_at', 'desc')->get();
            $data_msg['orders'] = DB::table('orders')
            ->select('orders.id','orders.order_id','us.id as user_id','us.name as userfullname', 'orders.course_id','products.name as product_name',
                       'orders.grand_total','products.end_date','orders.created_at','orders.payment_status as status')
                ->join('users as us','orders.user_id','us.id')
                ->join('products','products.product_id','orders.course_id')
                ->where('orders.user_id',Auth::id())
                ->where('orders.payment_status','success')
                ->whereNull('orders.deleted_at')

                ->orderBy('orders.id','DESC')
                ->get();
                
              

            return view('frontend.orders', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }
    public function ajaxOrderList(Request $request)
    {

        if ($request->ajax())
        {
            $order_number = $request->input('order_number');
            $user_id = $request->input('user_id');
            $product_id = $request->input('product_id');
            $subject_id = $request->input('subject_id');
            $payment_status = $request->input('payment_status');
            $amount = $request->input('amount');
            
            $date_from = $request->input('date_from');
            
            $date_to = $request->input('date_to');
            $purchase_date_from = $request->input('purchase_date_from');
            
            $purchase_date_to = $request->input('purchase_date_to');
            
            
            
            $arrSearch[] =['orders.payment_status','<>','success1'] ;
            
            if ($order_number != '') {
                $arrSearch[] = ['orders.order_id', 'like', '%' . $order_number . '%'];
            }
            if ($amount != '') {
                $arrSearch[] = ['orders.grand_total', 'like', '%' . $amount . '%'];
            }
            if ($user_id != '') {
                $arrSearch[] = ['orders.user_id', $user_id];
            }
            if ($product_id != '') {
                $arrSearch[] = ['orders.course_id', $product_id];
            }
            if ($subject_id != '') {
                $arrSearch[] = ['csr.subject_id', $subject_id];
            }
            if ($payment_status != '') {
                $arrSearch[] = ['orders.payment_status', $payment_status];
            }
            
            if ($date_from != '') {
                
                $d_p_d = explode('/', $date_from);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $date_from = $d_p_d_m;
                $arrSearch[] = ['products.start_date', '>=', $date_from];
            }

            if ($date_to != '') {

                $d_p_d = explode('/', $date_to);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $date_to = $d_p_d_m;

                $arrSearch[] = ['products.end_date', '<=', $date_to];
            }
            if ($purchase_date_from != '') {
                
                $d_p_d = explode('/', $purchase_date_from);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $purchase_date_from = $d_p_d_m;
                $arrSearch[] = ['orders.created_at', '>=', $purchase_date_from];
            }

            if ($purchase_date_to != '') {

                $d_p_d = explode('/', $purchase_date_to);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $purchase_date_to = $d_p_d_m;

                $arrSearch[] = ['orders.created_at', '<=', $purchase_date_to];
            }

                
            $items = DB::table('orders')
            ->select('orders.order_id','us.id as user_id','us.name as userfullname', 'orders.course_id','products.name as product_name',
                       'orders.grand_total','orders.created_at')
                ->join('users as us','orders.user_id','us.id')
                ->join('products','products.product_id','orders.course_id')
                //->distinct('orders.course_id')
                ->whereNull('deleted_at')
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

            $column = array( '#','orders.order_id','userfullname','product_name','product_name','amount','action');


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
            

            
            $items_1 = DB::table('orders')
            ->select('orders.id','orders.order_id','us.id as user_id','us.name as userfullname', 'orders.course_id','products.name as product_name',
                       'orders.grand_total','products.end_date','orders.created_at','orders.payment_status as status')
                ->join('users as us','orders.user_id','us.id')
                ->join('products','products.product_id','orders.course_id')
                //->distinct('orders.course_id')
                ->whereNull('deleted_at')
                ->where($arrSearch);

            


            $items_1 = $items_1->orderBy($column_name, $asc_desc)
                    ->skip($iDisplayStart)
                    ->take($iDisplayLength)
                    ->get();
            $sl = 1;
            foreach ($items_1 as $t)
            {
               
                $status = '';
                if ($t->status == 'success') {
                    $status = '<span class="label label-sm label-success"> Success </span>';
                }else if($t->status == 'created') {
                    $status = '<span class="label label-sm label-warning">Pending</span>';

                }
                else {
                    $status = '<span class="label label-sm label-warning">'.$t->status.'  </span>';
                }
               

                $product_subjects=DB::table('subject_masters')
                     ->join('course_exam_subject_relations as csr','subject_masters.id','csr.subject_id')
                     ->select('subject_masters.subject_name','csr.subject_id','csr.product_id')
                     ->where(['csr.product_id'=>$t->course_id])
                     ->get()->toArray();

                $subjects=[];     
                foreach($product_subjects as $product_subject){
                    $subjects[]=$product_subject->subject_name;
                }
                $relatedSubjects=implode(',',$subjects);
               
                $records["data"][] = array(
                    
                    $t->order_id,
                    $t->userfullname,
                    '<a href='.route('editCourse',['id'=>Hasher::encode($t->course_id)]).' target="blank">'.$t->product_name.'</a>',
                    //$relatedSubjects,
                    $t->grand_total,
                    \Carbon\Carbon::parse($t->created_at)->format('d/m/Y'),
                    \Carbon\Carbon::parse($t->end_date)->format('d/m/Y'),
                    $status,
                    //'<a href="'.route('viewOrderDetails',['id'=>Hasher::encode($t->id)]).'" class="btn btn-sm btn-default"><i class="fa fa-eye"></i> View </a>'
                    '<a href="#" data-orderid="'.$t->id.'" data-toggle="modal" data-target="#viewOrder" class="btn btn-sm btn-default viewBilling margin-bottom-5" ><i class="fa fa-eye"></i> View </a>
                    <a href="javascript:void(0)"  class="btn btn-sm btn-default remove-order confirmation" data-value="'.$t->id.'" ><i class="fa fa-trash"></i> Delete </a>'
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

    public function viewOrderDetails(Request $request)
    {
        if (Auth::guard('admins')->check()) {
            $id=$request->order_id;
			//return $id;
            $data_msg = array();

            $data_msg['menu_parent'] = 'orders';
            $data_msg['menu_child'] = 'order-list';

            $data_msg['order_info']=DB::table('orders')
                    ->join('users','users.id','orders.user_id')
                    ->join('products','products.product_id','orders.course_id')
                    ->select('orders.*','users.name as fullname','orders.user_id','products.name as product_name',
                            'products.product_id','users.email','products.price','products.revised_price','products.revised_percent')
                    ->where('orders.id',$id)
                    ->first();


            $data_msg['billing_info']=BillingDetail::where('order_id',$id)->first();
            $data_msg['card_info']=CardDetail::where('order_id',$id)->first();
            $data_msg['state']=StateMaster::where('state_id',$data_msg['billing_info']->state)->first();
            $data_msg['reseller_amount']=OrderResellerPaymentDetails::where('order_id',$id)->first();
            $data_msg['payment_details']=PaymentDetail::where('order_id',$id)->first();

            //return $data_msg;
            //return view('admin.courses.orders.view', $data_msg);

            $returnHTML = view('admin.courses.orders.view',$data_msg)->render();// or method that you prefere to return data + RENDER is the key here
            //return $returnHTML;
            return response()->json( array('success' => true, 'html'=>$returnHTML) );
			
        } else {

            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function viewOrderInfo(Request $request)
    {
        $id=$request->order_id;

			//return $id;
            $data_msg = array();

           

            $data_msg['order_info']=DB::table('orders')
                    ->join('users','users.id','orders.user_id')
                    ->join('products','products.product_id','orders.course_id')
                    ->select('orders.*','users.name as fullname','orders.user_id','products.name as product_name',
                            'products.product_id','users.email','products.price','products.revised_price','products.revised_percent')
                    ->where('orders.id',$id)
                    ->first();
            $data_msg['order_date']=\Carbon\Carbon::parse($data_msg['order_info']->created_at)->format('d/m/Y');

            $data_msg['billing_info']=BillingDetail::where('order_id',$id)->first();
            $data_msg['card_info']=CardDetail::where('order_id',$id)->first();
            
            $data_msg['invoice_url']=route('downloadInvoicePDF',$data_msg['order_info']->id);
            $data_msg['payment_details']=PaymentDetail::where('order_id',$id)->first();
            // dd($data_msg['payment_details']);
            // return view('frontend.orders.order_details',$data_msg);
            $returnHTML = view('frontend.orders.order_details',$data_msg)->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));  
            
            return response()->json($data_msg);
			
        
    }

    public function downloadInvoicePDF($id) {
        
        $data_msg['billing_info']=BillingDetail::where('order_id',$id)->first();
        $order_info=DB::table('orders')
                    ->join('users','users.id','orders.user_id')
                    ->join('products','products.product_id','orders.course_id')
                    ->select('orders.*','users.name as fullname','orders.user_id','products.name as product_name',
                            'products.product_id','users.email','products.price','products.revised_price','products.revised_percent')
                    ->where('orders.id',$id)
                    ->first();
        $data_msg['order_info']= $order_info;           
        @$data_msg['state']=StateMaster::where('state_id',$data_msg['billing_info']->state)->first();
        @$data_msg['country']=Country::where('id',$data_msg['billing_info']->country)->first();
        $data_msg['amount_in_words']=Terbilang::make($data_msg['order_info']->grand_total);
        $pdf = MPDF::loadView('frontend.course.billing.invoice', $data_msg, [], [
            'default_font_size'=>12,
            'default_font'=>'nikosh'
        ]);
        return $pdf->stream('document.pdf','D');
        // $mpdf=new \Mpdf\Mpdf([
        //     'default_font_size'=>12,
        //     'default_font'=>'nikosh'
        // ]);
        // $mpdf = $mpdf::loadView('pdf.document', $data_msg);
        // return $mpdf->stream('document.pdf');
        // $mpdf->writeHTML($order_info->product_name);
        // $mpdf->Output();
        // return;
        // $pdf = PDF::loadView('frontend.course.billing.invoice',$data_msg);
        

        // $filename="Order_".$order_info->order_id.'.pdf';
        

        // return $pdf->download($filename);
        return ;
    }

    public function contributorShareCalculation($order_id)
    {
        $order_id=Hasher::decode($order_id);
        $purchased_courses=$data_msg['order_info']=DB::table('orders')
                        ->join('products','products.product_id','orders.course_id')
                        ->select('orders.order_id','orders.id as IIPh_order_id','orders.user_id',
                                'products.name as product_name',
                                'products.product_id','products.end_date')
                        ->where([
                            'orders.id'=>$order_id,
                            'orders.payment_status'=>'success',
                        ])
                        ->orderBy('orders.created_at','desc')        
                        ->get(); 
        $myLibrary=new \App\library\myFunctions();
                        
                                   
       foreach ($purchased_courses as $course){
        $related_materials_info=$myLibrary->getMaterialInfo($course->product_id);
        foreach ($related_materials_info as $related_material){
            $exam_paper_material_content=\App\ExamPaperMaterialContent::where($related_material)
            ->where('status',1)
            ->first();
            if($exam_paper_material_content){

                $related_contributor_infos= \App\ExamPaperMaterialContributor::where('exam_paper_material_content_id',$exam_paper_material_content->id)->get();
                if($related_contributor_infos){

                    foreach($related_contributor_infos as $related_contributor_info ){
                        $share_payment_data=array(
                            'course_id'=>$course->product_id,
                            'order_id'=>$order_id,
                            'contributor_id'=>$related_contributor_info->contributor_id,
                            'price_earn'=>$related_contributor_info->price,
                        );
        
                        $checkorderbefore=OrderContributorPaymentDetails::where('order_id',$order_id)
                        ->where('course_id',$course->product_id)
                        ->where('contributor_id',$related_contributor_info->contributor_id)
                        ->first();
                        if($checkorderbefore){
                            $checkorderbefore->update($share_payment_data);
                        }else{

                            OrderContributorPaymentDetails::create($share_payment_data);
                        }
                    }
                }
            }
        }
       }
      
    }

    public function resellerShareCalculation($order_id,$reseller_code=null)
    {
        $order_info=Order::find($order_id);


        
        $reseller_code=$order_info->reseller_code_applied;

        //Get Count of order wth the help of reseller_id
        $total_orders=Order::where('reseller_code_applied',$reseller_code)->count();
        if($total_orders<1){
            $total_orders=1;
        }
        //Get the range n whch commson fall.
        $commission_slab=\App\ResellerCommissionMaster::where('lower_bound','<=',$total_orders)->where('upper_bound','>=',$total_orders)->first();
        //Pass that commisson to comm 
        // echo "<pre>";
        // print_r($commission_slab);die;
        $commission_percent=$commission_slab->commission;
        
        $distributor_info=Distributor::where('reseller_code',$reseller_code)->first();
        if($distributor_info){
            $distributor_id=$distributor_info->distributor_id;
            // $commission=$distributor_info->commission;
            // $commission_percent=$commission;
            // if(!$commission){
            //     $commission_percent=getSettings('reseller_commision');
                
            // }
            $course_price=$order_info->course_price;
            $commission_per_amount=$course_price * $commission_percent/100;
            $commission_per_amount=number_format((float)$commission_per_amount, 2, '.', '');
            //return $commission;
            
            $order_info->reseller_id=$distributor_id;
            $order_info->commission_percent=$commission_percent;
            $order_info->commission_amount=$commission_per_amount;
            $order_info->save();
            
    
        }
    }

    public function ajaxOrderDelete(Request $request)
    {
        $order_id=$request->order_id;
        $ordercontrbutor=\App\OrderContributorPaymentDetails::where('order_id',$order_id)->delete();
        $ordercontrbutor=\App\OrderResellerPaymentDetails::where('order_id',$order_id)->delete();


        $order=Order::where('id',$order_id)->delete();

        return $order;


    }

}
