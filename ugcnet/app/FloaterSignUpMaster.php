<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FloaterSignUpMaster extends Model
{
    protected $table = 'floater_signup_master';

    protected $fillable = [
        
        'title',
        'description',
        'time',
        'status',
       
    ];

   

}
