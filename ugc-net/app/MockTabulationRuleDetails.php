<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MockTabulationRuleDetails extends Model
{
    //protected $primaryKey = 'product_id';
    protected $table="mock_tabulation_rule_details";

    protected $fillable = [
        
        'rule_id',
        'level_id',
        'correctness',
        'marks',
        'is_active',


    ];

    public function tabrule()
    {
        return $this->belongsTo('App\MockTabulationRule','rule_id','id');
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
