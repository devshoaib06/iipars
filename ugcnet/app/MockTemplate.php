<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MockTemplate extends Model
{
    //protected $primaryKey = 'product_id';
    protected $table="mock_template";

    protected $fillable = [
        'name',
        'duration',
        'tabulation_rule_id',
        'is_active',
    ];

    public function templateDetails()
    {
        return $this->hasMany('App\MockTemplateDetails','template_id','id');
    }
    public function tabRule()
    {
        return $this->belongsTo('App\MockTabulationRule','tabulation_rule_id','id');
    }
   

}
