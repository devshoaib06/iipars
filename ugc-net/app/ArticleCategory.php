<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    //protected $primaryKey = 'product_id';

    protected $fillable = [
        'name',
        'status',
        'slug'       
      
    ];
    // public function articles()
    // {
    //     return $this->hasMany('App\ArticleMaster');
    // }
}
