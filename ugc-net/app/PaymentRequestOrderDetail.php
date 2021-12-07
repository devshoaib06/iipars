<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentRequestOrderDetail extends Model
{
    
    protected $primaryKey = 'id';
    protected $fillable = [
        'payment_request_id',
        'order_id',
        'order_amount',
        'pay_date',
        'pay_status',
        'pay_type',
        'cheque_no_neft',
    ];

}
