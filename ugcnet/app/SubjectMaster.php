<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectMaster extends Model
{
	protected $primaryKey = 'id';
    protected $fillable = ['subject_name','exam_id', 'status'];
}
