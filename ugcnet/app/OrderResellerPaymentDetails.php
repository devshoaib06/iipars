<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderResellerPaymentDetails extends Model
{
    
    protected $primaryKey = 'id';
    protected $fillable = [
        'course_id',
        'order_id',
        'distributor_id',
        'price_earn',
        
    ];

}
