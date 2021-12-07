<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialMaster extends Model
{
	protected $primaryKey = 'id';
    protected $fillable = ['material_name', 'status'];
}
