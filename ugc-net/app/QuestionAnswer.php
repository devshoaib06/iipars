<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    //protected $primaryKey = 'product_id';

    protected $fillable = [
        'question_id',
    	'answer',    	
        'is_correct',
        'option_label',
        'status',
    ];

    public function category()
    {
        return $this->hasOne('App\QuestionCategory','id');
    }
   

}
