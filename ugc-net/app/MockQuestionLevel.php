<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MockQuestionLevel extends Model
{
    //protected $primaryKey = 'product_id';
    protected $table="mock_question_level";

    protected $fillable = [
        'name',
        'is_active',
    ];


    

    // public function category()
    // {
    //     return $this->hasOne('App\QuestionCategory','id');
    // }
   

}
