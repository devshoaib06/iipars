<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderContributorPaymentDetails extends Model
{
    
    protected $primaryKey = 'id';
    protected $fillable = [
        'course_id',
        'order_id',
        'contributor_id',
        'price_earn',
        
    ];

}
