<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MockQuestionDetailsMaster extends Model
{
    //protected $primaryKey = 'product_id';
    protected $table="mock_question_master_details";

    protected $fillable = [
        'question_id',
        'level_id',
        'exam_id',
        'paper_id',
        'subject_id',
        
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
        return $this->hasMany('App\MockQuestionOptions','question_id','question_id');
    }
    public function questionMaster(){
        return $this->belongsTo('App\MockQuestionMaster','question_id','id');
    }


    public function questionAnswers(){
        return $this->hasMany('App\MockQuestionAnswers','question_id','question_id');
    }


   

}
