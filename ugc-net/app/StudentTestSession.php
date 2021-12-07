<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentTestSession extends Model
{
    protected $table = 'student_test_session';

    protected $fillable = [
        
        'mock_test_id',
        'start_datetime',
        
        

    ];

    public function mockDetails()
    {
        return $this->belongsTo('App\StudentMockTest','mock_test_id','id');
    }


   

}
