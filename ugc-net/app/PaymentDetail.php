<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    protected $fillable=[
        'order_id',
        'payment_method',
        'bank',
        'vpa',
        'wallet',
        'card_id'
    ];
}
