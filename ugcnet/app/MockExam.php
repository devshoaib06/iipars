<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MockExam extends Model
{
    //protected $primaryKey = 'product_id';

    protected $fillable = [
        'student',
        'datetime',
        'score',    	
        'winner_position', 
        'result_declare_date',   	
        'status',
    ];

    
   

}
