<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVideoRelation extends Model
{
    protected $fillable = ['product_id','video_id'];
}
