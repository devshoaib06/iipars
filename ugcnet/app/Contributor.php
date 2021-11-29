<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contributor extends Model
{
    protected $primaryKey = 'contributor_id';

     protected $fillable = [
        'user_id', 
        'firstname',
        'lastname',
        'contactnumber',
        'anothercontactnumber',
        'qualification',
        'gender',
        'address',
        'country_id',
        'ip_address',
        'subject_list'

    ];
}
