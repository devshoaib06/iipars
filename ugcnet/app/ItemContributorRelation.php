<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemContributorRelation extends Model
{
    protected $primaryKey = 'relation_id';
    public $timestamps = false;

    protected $fillable = ['item_id','contributor_id'];
}
