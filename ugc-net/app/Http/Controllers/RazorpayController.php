<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Razorpay\Api\Api;

class RazorpayController extends Controller{
    
	public function index(){
		$api_key = config('payment.api_key');
		$api_secret = config('payment.api_secret');
		$api = new Api($api_key, $api_secret);
		$data = array(
			'receipt' => '12323',
			'amount' => 1000,
			'payment_capture' => 1,
			'currency' => 'INR'
		);
		$order = $api->order->create($data);
		echo "<pre>";
		$pay=\App\PaymentResponse::where('order_id',1)->first();
		$unseril_data=unserialize($pay->payment_created_response);
		print_r($unseril_data->entity);

		// \App\PaymentResponse::create([
		// 	'order_id'=>1,
		// 	'payment_created_response'=>serialize($order)
		// ]);
		//print_r(serialize($order));
		/*
		Response
		===================
		{
		    "id": "order_EFKqSHbvwSt3Pp",
		    "entity": "order",
		    "amount": 50000,
		    "amount_paid": 0,
		    "amount_due": 50000,
		    "currency": "INR",
		    "receipt": "rcptid_11",
		    "status": "created",
		    "attempts": 0,
		    "notes": [],
		    "created_at": 1566986570
		}
		======================
		*/
		return view('frontend.razorpay', ['api_key'=>$api_key, 'api_secret'=>$api_secret,'details'=>$data,'order'=>$order]);
	}
	
}
