<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaItemRelation extends Model
{
    protected $primaryKey = 'relation_id';
    public $timestamps = false;

    protected $fillable=['item_id','media_id'];
}
