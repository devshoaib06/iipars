<?php

namespace App\Http\Controllers\API;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 

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
use Validator;
use Terbilang;
use Mail;
use App\Mail\Order\OrderMail;
use App\OrderContributorPaymentDetails;
use App\Settings;

use App\PaymentDetail;
use App\ExamMaster;
use App\OrderResellerPaymentDetails;

class OrderController extends Controller {
    public $api_key;
    public $api_secret;

    public function __construct() {
        $razorpay_api_key=Settings::where('setting_id','razorpay_api_key')->first();
        $razorpay_api_secret=Settings::where('setting_id','razorpay_api_secret')->first();

    //    $this->api_key=$razorpay_api_key->content;
    //    $this->api_secret=$razorpay_api_secret->content;

       $this->api_key="rzp_live_ioM2f7U7v9WcWu";
       $this->api_secret="XdUDFXCJuQrZ6fLoUzdPTZsX";

      
    }

    public function checkout(Request $request) {
        //echo $request->session()->pull('buy_course_id');die;
        //echo ;die;
        if ($request->has('logged_in_user_id') && $request->has('course_id')) { 
            
            if($request->has('course_id')){
                $product_id=$request->input('course_id');
            }
            elseif($request->session()->has('buy_course_id')){
                $product_id=\Session::get('buy_course_id');
            }
            $data_msg=[];
            //dd($product_id); 
            $product_details=Product::select('product_id','name','price','revised_price','is_reseller_charge')->find($product_id);
            if(!$product_details){
                $returnData=array(
                    'success'=>0,
                    'message'=>'No such course',
                    
                );
    
                return $returnData;
            }
            // $data_msg['countries']=Country::where('status','<>',3)->get();
            // $data_msg['states']=StateMaster::where('status','<>',3)->get();
            $user_details =  DB::table('users')
                        ->join('students as st','st.user_id','users.id')
                        ->select('users.id', 'st.*', 'users.email')
                        ->where('users.user_type_id', '=', '2')
                        ->where('users.id', '=', $request->logged_in_user_id)
                        ->first();

            $lastOrder=Order::where('user_id',$request->logged_in_user_id)->orderBy('id','desc')->first();
            $lastbillinfo='';
            if($lastOrder){
                $lastbillinfo=BillingDetail::where('order_id',$lastOrder->id)->first();
                
            }
            //return floor($data_msg['products']->price);
            if($product_details && floor($product_details->price)=="0"){
                $latestOrder=0;
                $order_nr='TEC'.str_pad($latestOrder + 1, 5, "0", STR_PAD_LEFT);
                $latestOrder = Order::orderBy('created_at','DESC')->first();

                if($latestOrder){
                    
                    $order_nr = 'TEC'.str_pad($latestOrder->id + 1, 5, "0", STR_PAD_LEFT);
                    
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

                $order_info=$this->savePreviewItemOrder($request,$order_data);
                $order_id=$order_info->id;
                $this->savePreviewItemBillingDetails($request,$order_id);
                $payment_data=array(
                    'order_id'=>$order_id,
                    'payment_method'=>"Free"
                   
               );
               $billinfo=PaymentDetail::create($payment_data);
                return redirect()->intended(route('thankYou',['order_id'=>Hasher::encode($order_id)]));
            }
            $returnData=array(
                'success'=>1,
                'message'=>'success',
                'course_details'=>$product_details,
                'user_details'=>$user_details,
                'lastbillinfo'=>$lastbillinfo
            );

            return $returnData;

        } else {
            return redirect()->route('loginAction');
        }

    }

    private function savePreviewItemBillingDetails($request,$localorderid){
        //try{
         $result =  DB::table('users')
         ->join('students as st','st.user_id','users.id')
         ->select('users.id', 'st.*', 'users.email')
         ->where('users.user_type_id', '=', '2')
         ->where('users.id', '=', $request->logged_in_user_id);
         $result = $result->first();
        //print_r($result);die;
 
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

    private function savePreviewItemOrder($request,$order){
        // DB::beginTransaction();

        // try {
            $order_data=array(
                'order_id'=>$order['receipt'],
                'user_id'=>$request->logged_in_user_id,
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

    public function checkCoupon(Request $request){
        if ($request->has('subtotal') && $request->has('coupon_code')) { 

            $coupon_code=$request->coupon_code;
            $subtotal=(double)$request->subtotal;
            
            $couponExists=Coupon::where('coupon_code',$coupon_code)
            ->where('status',1)
            ->first();
            
            $discount_price=0.00;
            $discount=0.00;
            $result=array(
                'success'=>0,
                'discount'=>$discount,
                'discount_price'=>$discount_price,
                'message'=>'Invalid Code'
            );
            if($couponExists){
                $from = strtotime($couponExists->start_date);
                $to = strtotime($couponExists->end_date);
                
                $today = strtotime(date('Y-m-d'));
                
                if(!($from<=$today && $to>=$today)){
                    $result=array(
                        'success'=>0,
                        'message'=>'Code Expired'
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
                    'success'=>1,
                    'message'=>'Success',
                    'discount'=>$discount,
                    'discount_price'=>$discount_price
                );
                
                
            }
        }else{
            $result=array(
                'success'=>1,
                'message'=>'Invalid request',
                
            );
        }
        
        return response()->json($result);
    }
    public function resellerCodeExists(Request $request){
        // $reseller_code=$request->reseller_code;
       
        
        // $couponExists=Distributor::where('reseller_code',$reseller_code)
        // ->where('reseller_code','<>','')
        // ->first();
        // $couponExists=DB::table('users')
        //              ->join('distributors','distributors.user_id','users.id')   
        //              ->where('distributors.reseller_code',$reseller_code)
        //              ->where('distributors.reseller_code','<>','')
        //              ->where('users.status',1)
        //              ->select('distributors.reseller_code','users.status')
        //              ->first();

        // $result=array(
        //     'success'=>0,
        //     'message'=>'Invalid Code/Code Expired'
        // );
        // if($couponExists){
            
        //     $result=array(
        //         'success'=>1,
        //         'message'=>'Code exists'

        //     );
            
            
        // }
        $reseller_code=$request->reseller_code;
        $product_id=$request->product_id;
        $product=DB::table('products')->where('product_id',$product_id)->select('revised_price','price')->first();
        if($product){
            $price=$product->revised_price!=""?$product->revised_price:$product->price;
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
        }
        else{
            $result=array(
                'result'=>'error',
                'message'=>'No such product'
            ); 
        }
        
        return response()->json($result);
    }
    

    public function placeorder(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'course_id' => 'required', 
            'grand_total' => 'required', 
            'sub_total' => 'required', 
            'discount_amont' => 'required', 
            // 'first_name' => 'required', 
            // 'last_name' => 'required', 
            // 'email' => 'required', 
            // 'phone' => 'required', 
            //'reseller_code'=>'required'
            //'c_password' => 'required|same:password', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['success'=>0,'error'=>$validator->errors()], 401);            
        }
        
        try {
            $api = new Api($this->api_key, $this->api_secret);
            $latestOrder=0;
            $order_nr='TEC'.str_pad($latestOrder + 1, 5, "0", STR_PAD_LEFT);
            $latestOrder = Order::orderBy('created_at','DESC')->first();
            if($latestOrder){
                
                $order_nr = 'TEC'.str_pad($latestOrder->id + 1, 5, "0", STR_PAD_LEFT);
            }
            
            
            $amount=$request->grand_total*100;
            $data = array(
                'receipt' => $order_nr,
                'amount' => $amount,
                'payment_capture' => 1,
                'currency' => 'INR'
            );
            $order = $api->order->create($data);
            
            $insertedorder=$this->saveOrder($request,$order); 
            
            //return $insertedorder;
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
                    'success'=>1,
                    'message'=>'success'
                    
                );
                return response()->json($data);
            }

            $data=array(
                'success'=>0,
                'message'=>'Something went wrong'
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
        $meta_array['meta_title']='Teachinns-Order Pay';
            $meta_array['meta_desc']='Teachinns';
            $meta_array['meta_keyword']='Teachinns';
            
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

        
        if($request->has('razorpay_payment_id') && $request->has('razorpay_order_id')){

            $p_gateway_payment_id=$request->razorpay_payment_id;
            $payment_order_id=$request->razorpay_order_id;
            $order_info=Order::where('payment_order_id',$payment_order_id)->first();
            $local_order_id=$order_info->id;
            //$transaction_info=$request->transaction_info;
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
            //$payment_response_info->payment_success_response=$transaction_info;
            $payment_response_info->save();
    
            $data=array(
                'order_id'=>$order_info->id,
                'success'=>1,
                'message'=>'success',
                
            );

            $this->thankYou($request,$order_info->id);
            // if($order_info->price>0){
            //     $this->contributorShareCalculation($order_id);
            // }
            // if($order_info->reseller_code_applied!=0 || $order_info->reseller_code_applied){
            //     $this->resellerShareCalculation($order_id,$order_info->reseller_code_applied);
            // }
            return response()->json($data);
        }else{
            $data=array(
                
                'success'=>0,
                'message'=>"Error in request."
                
            );
            return response()->json($data);
        }

    }

    public function thankYou($request,$order_id)
    {
        
        
        //$order_id=Hasher::decode($order_id);
        
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
            $this->sendOrderMail($request,$data,$order_id);
            $this->sendAdminOrderMail($request,$data,$order_id);
        }

        return view('frontend.course.billing.thank-you',$data);
    }

    public function thankYouPage(Request $request)
    {
        
        
        $order_id=$request->order_id;
        
        $data['order']=Order::find($order_id);
        $data['billing_info']=BillingDetail::where('order_id',$order_id)->first();
        $product_id=$data['order']->course_id;
        $data['state']=StateMaster::where('state_id',$data['billing_info']->state)->first();
        $data['country']=Country::where('id',$data['billing_info']->country)->first();
        $data['product']=Product::where('product_id',$product_id)->first();
        if($data['order']->payment_status=="success"){
            $data['payment_details']=PaymentDetail::where('order_id',$order_id)->first();

        }
        // if(floor($data['product']->price)>0){
        //     $this->contributorShareCalculation($order_id);
        // }
        // if($data['order']->reseller_code_applied){
        //     $this->resellerShareCalculation($order_id,$data['order']->reseller_code_applied);
        // }

        return $returnData=[
            'success'=>1,
            'message'=>"success",
            'order_info'=>$data,
        ];

        // if($data['payment_details']->payment_method!="Free"){
        //     $this->sendOrderMail($request,$data,$order_id);
        //     $this->sendAdminOrderMail($request,$data,$order_id);
        // }

        
    }

    public function sendOrderMail($request,$data,$order_id)
    {
        try{

            $temp_data = \App\EmailTemplates::where(['mail_id'=>'order-mail'])->first();
            $template_data = $temp_data;
            $product=$data['product'];
            $order=$data['order'];
            $amount=$product->revised_price!=""?$product->revised_price:$product->price;
            $payment=$data['payment_details'];
            $subtotal=$amount;
            if($order->discount_amount){
                $subtotal=$amount-$order->discount_amount;
            }

            $user_details=\App\User::where('id',$request->logged_in_user_id)->first();
    
            $email=$user_details->email;
            $user_name=$user_details->name;
            
            $order_id=$data['order']->order_id;
            $product_name=$product->name;
            $amount=$amount;
            $discount_amount=$order->discount_amount==""?'0.00':$order->discount_amount;
            $subtotal=$subtotal;
            $payment_method=$payment->payment_method;
            $grand_total=$order->grand_total;
    
    
            $content = $template_data->content;
            $content = str_replace("{{user_name}}", $user_name, $content);
            $content = str_replace("{{order_id}}", $order_id, $content);
            $content = str_replace("{{amount}}", $amount, $content);
            $content = str_replace("{{product_name}}", $product_name, $content);
            $content = str_replace("{{discount_amount}}", $discount_amount, $content);
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
                $subtotal=$amount;
                if($order->discount_amount){
                    $subtotal=$amount-$order->discount_amount;
                }
                
                $email=trim(getSettings('from_email'));
                $user_name='Admin';
                
                $order_id=$data['order']->order_id;
                $product_name=$product->name;
                $amount=$amount;
                $discount_amount=$order->discount_amount==""?'0.00':$order->discount_amount;
                $subtotal=$subtotal;
                $payment_method=$payment->payment_method;
                $grand_total=$order->grand_total;
        
        
                $content = $template_data->content;
                $content = str_replace("{{user_name}}", $user_name, $content);
                $content = str_replace("{{order_id}}", $order_id, $content);
                $content = str_replace("{{amount}}", $amount, $content);
                $content = str_replace("{{product_name}}", $product_name, $content);
                $content = str_replace("{{discount_amount}}", $discount_amount, $content);
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
            }
        }catch (\Exception $e){
            return redirect()->intended(route('thankYou'))
                    ->withError($e->getMessage())->withInput();
        }
           
    }

    public function paymentCancel(Request $request,$order_id)
    {
        $meta_array['meta_title']='Teachinns-Cancel Payment';
        $meta_array['meta_desc']='Teachinns';
        $meta_array['meta_keyword']='Teachinns';
        
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
        $products=Product::select('product_id','name','price','revised_price','is_reseller_charge')->find($request->course_id);
        $price=$products->revised_price!=""?$products->revised_price:$products->price;

        $reseller_code=isset($request->reseller_code)?$request->reseller_code:'';
        $reseller_id='';
        if($reseller_code){

            $reseller=Distributor::where('reseller_code',$reseller_code)->first();
            $reseller_id=$reseller->distributor_id;
        }

        // try {
            $order_data=array(
                'order_id'=>$order['receipt'],
                'user_id'=>$request->logged_in_user_id,
                'course_id'=>$request->course_id,
                'payment_order_id'=>$order['id'],
                'subtotal'=>$request->sub_total,
                'discount_amount'=>$request->discount_amount,
                'grand_total'=>$request->grand_total,
                'reseller_code_applied'=>$reseller_code,
                'reseller_id'=>$reseller_id,
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
        ->where('users.id', '=',$request->logged_in_user_id );
        $result = $result->first();
       
        //dd($result);

           $billing_data=array(
                'order_id'=>$localorderid,
                'first_name'=>$result->firstname,
                'last_name'=>$result->lastname,
                //'company_name'=>$request->company_name,
                'country'=>isset($result->country_id)?$result->country_id:100,
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
    
   
    public function myOrders(Request $request)
    {
       
            
            // $data_msg['allProducts']=Product::where('status',1)->orderBy('name','Asc')->get();
           
            // $data_msg['allStudents'] =  $users = DB::table('users')
            //                         ->join('students as st','st.user_id','users.id')
            //                         ->select('users.id', 'st.firstname', 'st.lastname', 'users.email', 'users.is_approved','users.status')

            //                         ->get();
            

            // $data_msg['allCourses']=Product::where('status',1)->get();
            // $data_msg['allsubjects']=\App\SubjectMaster::where('status',1)
            //             ->orderBy('subject_name', 'Asc')
            //             ->get();
            //$data_msg["masterList"] = Item::orderBy('updated_at', 'desc')->get();
            $orders= DB::table('orders')
            ->select('orders.id','orders.order_id','us.id as user_id','us.name as userfullname', 'orders.course_id','products.name as product_name',
                       'orders.grand_total','products.end_date','orders.created_at','orders.payment_status as status')
                ->join('users as us','orders.user_id','us.id')
                ->join('products','products.product_id','orders.course_id')
                ->where('orders.user_id',$request->logged_in_user_id)
                ->where('orders.payment_status','success')
                ->orderBy('orders.id','DESC')
                ->get();

            $returndata=[
                'success' => 1,
                'message'=>'Success',
                'orders'=>$orders,
                
                'logged_in_user_id'=>$request->logged_in_user_id
    
            ];
            return $returndata;    

                
            

            
            
        
    }
    

    

    public function viewOrderInfo(Request $request)
    {
        $order_id=$request->order_id;

			//return $id;
            $data_msg = array();

           

            $data_msg['order_info']=DB::table('orders')
                    ->join('users','users.id','orders.user_id')
                    ->join('products','products.product_id','orders.course_id')
                    ->select('orders.*',DB::Raw('IFNULL( `orders`.`discount_amount` , 0 ) as discount_amount'),'users.name as fullname','orders.user_id','products.name as product_name',
                            'products.product_id','users.email','products.price','products.revised_price')
                    ->where('orders.id',$order_id)
                    ->first();
            $data_msg['order_date']=\Carbon\Carbon::parse($data_msg['order_info']->created_at)->format('d/m/Y');

            $data_msg['billing_info']=BillingDetail::where('order_id',$order_id)->first();
            $data_msg['card_info']=CardDetail::where('order_id',$order_id)->first();
            @$data_msg['state']=StateMaster::where('state_id',$data_msg['billing_info']->state)->first();
            @$data_msg['country']=Country::where('id',$data_msg['billing_info']->country)->first();
            $data_msg['invoice_url']=route('downloadInvoicePDF',$data_msg['order_info']->id);
            $data_msg['payment_details']=PaymentDetail::where('order_id',$order_id)->first();
                
            $returndata=[
                'success' => 1,
                'message'=>'Success',
                'orders_details'=>$data_msg,
                
                'logged_in_user_id'=>$request->logged_in_user_id
    
            ];
            return $returndata; 
			
        
    }

    public function downloadInvoicePDF($id) {
        
        $data_msg['billing_info']=BillingDetail::where('order_id',$id)->first();
        $order_info=DB::table('orders')
                    ->join('users','users.id','orders.user_id')
                    ->join('products','products.product_id','orders.course_id')
                    ->select('orders.*','users.name as fullname','orders.user_id','products.name as product_name',
                            'products.product_id','users.email','products.price','products.revised_price')
                    ->where('orders.id',$id)
                    ->first();
        $data_msg['order_info']= $order_info;           
        @$data_msg['state']=StateMaster::where('state_id',$data_msg['billing_info']->state)->first();
        @$data_msg['country']=Country::where('id',$data_msg['billing_info']->country)->first();
        $data_msg['amount_in_words']=Terbilang::make($data_msg['order_info']->grand_total);
        
        $pdf = PDF::loadView('frontend.course.billing.invoice',$data_msg);
        

        $filename="Order_".$order_info->order_id.'.pdf';
        

        return $pdf->download($filename);
    }

    public function contributorShareCalculation($order_id)
    {
        //$order_id=Hasher::decode($order_id);
        $purchased_courses=$data_msg['order_info']=DB::table('orders')
                        ->join('products','products.product_id','orders.course_id')
                        ->select('orders.order_id','orders.id as tech_order_id','orders.user_id',
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
        
                        OrderContributorPaymentDetails::create($share_payment_data);
                    }
                }
            }
        }
       }
      
    }

    // public function resellerShareCalculation($order_id,$reseller_code=null)
    // {
    //     $order_info=Order::select('reseller_code_applied','course_id')->find($order_id);
    //     //print_r($order_info->course_id);die;
    //     $reseller_code=$order_info->reseller_code_applied;
        
        
    //     $distributor_info=Distributor::where('reseller_code',$reseller_code)->first();
    //     if($distributor_info){
    //         $distributor_id=$distributor_info->distributor_id;
    //         $commission=$distributor_info->commission;
    //         if(!$commission){
    //             $commission=getSettings('reseller-commision');
    //         }
    //         //return $commission;
    
    //         $share_payment_data=array(
    //             'course_id'=>$order_info->course_id,
    //             'order_id'=>$order_id,
    //             'distributor_id'=>$distributor_id,
    //             'price_earn'=>$commission,
    //         );
    
    //         OrderResellerPaymentDetails::create($share_payment_data);
    //     }
    // }


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
      
        $commission_percent=$commission_slab->commission;
        
        $distributor_info=Distributor::where('reseller_code',$reseller_code)->first();
        if($distributor_info){
            $distributor_id=$distributor_info->distributor_id;
            $course_price=$order_info->course_price;
            $commission_per_amount=$course_price * $commission_percent/100;
            $commission_per_amount=number_format((float)$commission_per_amount, 2, '.', '');
           
            $order_info->reseller_id=$distributor_id;
            $order_info->commission_percent=$commission_percent;
            $order_info->commission_amount=$commission_per_amount;
            $order_info->save();
            
    
        }
    }

}
