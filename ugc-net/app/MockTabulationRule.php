<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MockTabulationRule extends Model
{
    //protected $primaryKey = 'product_id';
    protected $table="mock_tabulation_rule";

    protected $fillable = [
        'name',
        'is_active',
    ];

    public function templateDetails()
    {
        return $this->hasMany('App\MockTemplateDetails');
    }
   

}
