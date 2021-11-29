<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MockExamStudentAnswer extends Model
{
    protected $table = 'mock_exam_student_answers';

    protected $fillable = [
        'mock_exam_id',
        'question_id',
        'answer_id',  
        'is_draft',  	
        'is_correct'
    ];

}
