<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model {
    
    protected $table = 'settings';
	protected $primaryKey = "id";
	protected $fillable = [
       'setting_id',
	   'content',
	   'status',
    ];
    
}
