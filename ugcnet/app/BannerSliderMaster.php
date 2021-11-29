<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BannerSliderMaster extends Model
{
    protected $table="banner_slider_masters";
	protected $primaryKey = 'id';
    protected $fillable = ['title','link' ,'status'];
}
