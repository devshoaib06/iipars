<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ExamPaperMaterialMaster;
class ExamMaster extends Model
{
	protected $primaryKey = 'id';
    protected $fillable = ['exam_name', 'status'];

    public function exam_paper_material_relations(){
        return $this->hasMany('App\ExamPaperMaterialMaster','exam_id','id');
    }
}
