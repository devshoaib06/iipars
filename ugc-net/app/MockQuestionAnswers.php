<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MockQuestionAnswers extends Model
{
    //protected $primaryKey = 'product_id';
    protected $table="mock_question_answer";

    protected $fillable = [
        'question_id',
        'answer',
        'serial_no',
        'is_correct',
        'correct_explanation',


    ];

    public function questionMaster(){
        return $this->belongsTo('App\MockQuestionMaster','question_id','id');
    }

    
   

}
