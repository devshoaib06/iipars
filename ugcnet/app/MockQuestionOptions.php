<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MockQuestionOptions extends Model
{
    //protected $primaryKey = 'product_id';
    protected $table="mock_question_options";

    protected $fillable = [
        'question_id',
        'serial_no',
        'option_text',
        'other_option_text',
        'other_option_serial_no',

    ];

    
   

}
