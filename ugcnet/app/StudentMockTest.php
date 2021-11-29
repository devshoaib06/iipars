<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentMockTest extends Model
{
    protected $table = 'student_mock_test';

    protected $fillable = [
        'test_name',
        'student_id',
        'template_id',
        'subject_id',
        'course_id',
        'level_id',
        'start_datetime',
        'duration',
        'countdown',
        'last_response_datetime',
        'full_marks',
        'secured_marks',

    ];

    public function studentResult()
    {
        return $this->hasMany('App\StudentTestQuestionResult','mock_test_id','id');
    }
    

    public function subject()
    {
        return $this->belongsTo('App\SubjectMaster','subject_id','id');
    }
    public function template()
    {
        return $this->belongsTo('App\MockTemplate','template_id','id');
    }
    public function course()
    {
        return $this->belongsTo('App\Product','course_id','product_id');
    }

    public function student()
    {
        return $this->belongsTo('App\Student','student_id','student_id');
    }
    
   

}
