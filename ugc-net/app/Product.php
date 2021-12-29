<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'product_id';

    protected $fillable = [
    	'name',
		'category_id',
		'intro_text',
    	'short_description',
    	'description',
        'important_notice',
		'price',
		'revised_percent',
		'revised_price',
		'extra_discount',
		'no_of_students',
    	'start_date',
    	'end_date',
    	'is_popular',
    	'is_preview',
    	'preview_main_course',
    	'is_reseller_charge',
    	'slug',
    	'is_combo',
    	'status',
        'image',
        'home_slider',
        'meta_key',
		'meta_title',
		'img_alt',
        'meta_description',
        'meta_robots',
		'sequence'
    ];

	public function productUnits(){
        return $this->hasMany(\App\CourseExamPaperSubjectRelation::class,'product_id','product_id');
	}

}
