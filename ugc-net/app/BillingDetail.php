<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class BillingDetail extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'order_id', 
        'first_name',
        'last_name',
        'company_name',
        'country',
        'street_address_1',
        'street_address_2',
        'city',
        'state',
        'zip',
        'phone',
        'email',
        'order_notes'

    ];

   public function states(){
       return $this->belongsTo(\App\StateMaster::class,'state','state_id');
   }
   public function countries(){
       return $this->belongsTo(\App\Country::class,'country','id');
   }
}
