<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResellerCommissionMaster extends Model
{
    protected $table = 'reseller_commission_slab';

    protected $fillable = [
        
        'lower_bound',
        'upper_bound',
        'commission'
       
    ];

   

}
