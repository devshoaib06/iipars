<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaperMaster extends Model
{
	protected $primaryKey = 'id';
    protected $fillable = ['exam_id','exam_name','paper_name', 'status'];
}
