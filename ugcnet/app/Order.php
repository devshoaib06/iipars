<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //add this line



class Order extends Model
{
   use SoftDeletes;
    protected $fillable = [
        'order_id', 
        'user_id',
        'course_id',
        'reseller_id',
        'commission_percent',
        'commission_amount',
        'payment_order_id',
        'p_gateway_payment_id',
        'course_price',
        'discount_amount',
        'reseller_code_applied',
        'student_cb_percent',
        'student_cb_amount',
        'subtotal',
        'grand_total',
        'payment_status'

    ];

   
}
