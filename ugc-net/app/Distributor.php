<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    protected $primaryKey = 'distributor_id';

    protected $fillable = [
        'user_id', 
        'firstname',
        'lastname',
        'contactnumber',
        'gender',
        'address',
        'country_id',
        'ip_address',
        'commission',
        'reseller_code'

    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
