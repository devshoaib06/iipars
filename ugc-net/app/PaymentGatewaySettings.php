<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentGatewaySettings extends Model {
    
    protected $table = 'payment_gateway_settings';
	protected $primaryKey = "id";
	protected $fillable = [
       'setting_id',
	   'content',
	   'status',
    ];
    
}
