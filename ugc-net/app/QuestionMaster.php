<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionMaster extends Model
{
    //protected $primaryKey = 'product_id';

    protected $fillable = [
        'category_id',
        'question',
        'correct_clarification',    	
        'status',
    ];

    public function category()
    {
        return $this->hasOne('App\QuestionCategory','id');
    }
   

}
