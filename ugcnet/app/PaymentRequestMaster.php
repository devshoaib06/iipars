<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentRequestMaster extends Model
{
    
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'user_type_id',
        'requested_date',
    ];

}
