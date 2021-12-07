<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsMasters extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cms_masters';
    protected $primaryKey = "cms_id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [   
        'heading',
		'url', 
        'description',
		'status',
        'meta_title',
        'meta_keyword',
        'meta_robots',
        'meta_description'
    ];

}
