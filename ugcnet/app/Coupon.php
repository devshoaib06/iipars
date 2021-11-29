<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
	protected $primaryKey = 'coupon_id';
    protected $fillable = ['coupon_name', 'discount_type', 'price', 'coupon_code', 'uses_per_student', 'start_date', 'end_date', 'status'];
}
