<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MockTemplateDetails extends Model
{
    //protected $primaryKey = 'product_id';
    protected $table="mock_template_details";

    protected $fillable = [
        'template_id',
        'level_id',
        'number_of_questions',
        'marks_per_question',

    ];

    public function template()
    {
        return $this->belongsTo('App\MockTemplate','template_id','id');
    }
    public function level()
    {
        return $this->belongsTo('App\MockQuestionLevel','level_id','id');
    }
    // public function category()
    // {
    //     return $this->hasOne('App\QuestionCategory','id');
    // }
   

}
