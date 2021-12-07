<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class MentorMaster extends Model
{
    //public $timestamps = false;
    protected $fillable = [
        'order_id', 
        'name',
        'image',
        'qualification',
        'is_featured',
        'status'
    ];

   
}
