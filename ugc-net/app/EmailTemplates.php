<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class EmailTemplates extends Model 
{
    protected $table = 'email_templates';
	protected $primaryKey = "id";
    
	protected $fillable = [
       'id','mail_id','subject', 'content'
    ];
}
