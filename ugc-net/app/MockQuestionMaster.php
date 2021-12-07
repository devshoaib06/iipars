<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MockQuestionMaster extends Model
{
    //protected $primaryKey = 'product_id';
    protected $table="mock_question_master";

    protected $fillable = [
        'question',
        'level_id',
        'subject_id',
        'option_type',
        'correct_clarification',
        'is_active'
    ];

    public function level()
    {
        return $this->belongsTo('App\MockQuestionLevel','level_id','id');
    }

    public function subject()
    {
        return $this->belongsTo('App\SubjectMaster','subject_id','id');
    }

    public function questionOptions(){
        return $this->hasMany('App\MockQuestionOptions','question_id','id');
    }
    public function questionDetails(){
        return $this->hasMany('App\MockQuestionDetailsMaster','question_id','id');
    }

    public function questionAnswers(){
        return $this->hasMany('App\MockQuestionAnswers','question_id','id');
    }


   

}
