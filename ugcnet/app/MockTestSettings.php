<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MockTestSettings extends Model {
    
    protected $table = 'mock_exam_settings';
	protected $primaryKey = "id";
	protected $fillable = [
       'setting_id',
	   'content',
	   'status',
    ];
    
}
