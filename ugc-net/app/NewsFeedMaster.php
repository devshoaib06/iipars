<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsFeedMaster extends Model
{
    protected $table="newsfeed_masters";
	protected $primaryKey = 'id';
    protected $fillable = ['newsfeed', 'status'];
}
