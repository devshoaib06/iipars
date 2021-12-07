<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductContributorItemRelation extends Model
{
    protected $primaryKey = 'relation_id';
    public $timestamps = false;

    protected $fillable = [
    	'product_id',
    	'contributor_id',
    	'item_id',
    	'price'
    ];
}
