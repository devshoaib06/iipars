<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionCategory extends Model
{
    //protected $primaryKey = 'product_id';

    protected $fillable = [
        'name',
        'status'
              
      
    ];
    // public function articles()
    // {
    //     return $this->hasMany('App\ArticleMaster');
    // }
}
