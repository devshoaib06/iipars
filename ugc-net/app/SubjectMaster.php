<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectMaster extends Model
{
	protected $primaryKey = 'id';
    protected $fillable = ['subject_name','subject_slug','paper_id','exam_id', 'status','sequence'];

    public function papers()
    {
        return $this->belongsTo(\App\PaperMaster::class,'paper_id','id');
    }
}
