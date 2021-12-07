<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComboProductVideoRelation extends Model
{
	protected $table="combo_products_video_relations";
    protected $fillable = ['combo_id','video_id'];
}
