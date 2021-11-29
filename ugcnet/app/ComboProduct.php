<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComboProduct extends Model
{
    protected $primaryKey = 'combo_id';
    protected $fillable = [
    	'name',
    	'category_id',
    	'short_description',
    	'description',
        'important_notice',
    	'price',
    	'discount_price',
    	'expiry_date',
    	'is_popular',
    	'status',
        'image',
        'home_slider',
        'meta_key'
    ];
}
