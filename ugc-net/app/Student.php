<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $primaryKey = 'student_id';

    protected $fillable = [
        'user_id', 
        'firstname',
        'lastname',
        'contactnumber',
        'gender',
        'address',
        'country_id',
        'ip_address',

    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
