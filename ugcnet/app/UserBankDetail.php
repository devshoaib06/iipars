<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class UserBankDetail extends Model
{
    //public $timestamps = false;
    protected $fillable = [
        'user_id', 
        'ac_holder_name',
        'account_number',
        'bank_name',
        'bank_branch',
        'ifsc_code',
    ];

   
}
