<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardDetail extends Model
{
    protected $fillable=[
        'order_id',
        'p_gateway_payment_id',
        'card_id',
        'entity',
        'card_user_name',
        'last4digit',
        'card_network',
        'card_type',
        'issuer'
        
    ];
}
