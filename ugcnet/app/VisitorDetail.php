<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitorDetail extends Model
{
    
    protected $fillable = ['visitor_ip','visited_page'];
}
