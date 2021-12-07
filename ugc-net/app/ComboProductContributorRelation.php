<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComboProductContributorRelation extends Model
{
    protected $table = 'combo_product_contributor_relations';

    public $timestamps = false;

    protected $fillable = [
    	'combo_id',
    	'product_id',
        'contributor_id',
    ];
}
