<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentResponse extends Model
{
    
    protected $fillable = [
        'order_id',
        'payment_created_response',
        'payment_success_response'
    ];
}
