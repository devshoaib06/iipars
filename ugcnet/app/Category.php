<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'category_id';
    
    protected $fillable = [
        'name',
        'parent_id',
        'is_active',
    ];
}
