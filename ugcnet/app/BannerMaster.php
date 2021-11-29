<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BannerMaster extends Model
{
    //protected $primaryKey = 'product_id';

    protected $fillable = [
        
        'title',
    	'description',
		'image',
        'status',
       
    ];

   

}
