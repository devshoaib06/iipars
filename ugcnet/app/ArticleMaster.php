<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleMaster extends Model
{
    //protected $primaryKey = 'product_id';

    protected $fillable = [
        'category_id',
    	'writer_name',
    	'writer_email',
    	'writer_phone',
        'title',
    	'description',
		'image',
        'file',
        'fileName',
        'meta_tags',
        'meta_keywords',
        'meta_title',
        'meta_description',
        'meta_robots',
        'is_featured',
        'status',
        'slug'       
      
    ];

   

}
