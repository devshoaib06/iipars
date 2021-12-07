<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleCategoryRelation extends Model
{
    protected $table = 'article_category_relations';

    protected $fillable = [
        'article_id',
        'category_id',
    ];

   

}
