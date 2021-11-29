<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentTestQuestionResult extends Model
{
    protected $table = 'student_test_question_result';

    protected $fillable = [
        
        'mock_test_id',
        'question_id',
        'question_no',
        'answer_type',
        'level_id',
        'answer',
        'is_correct',
        'score',
        

    ];

    public function questionDetails()
    {
        return $this->belongsTo('App\MockQuestionDetailsMaster','question_id','question_id');
    }

    public function mocktest()
    {
        return $this->belongsTo('App\StudentMockTest','mock_test_id','id');
    }

   

}
