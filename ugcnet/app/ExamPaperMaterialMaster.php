<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamPaperMaterialMaster extends Model
{
    protected $table='exam_paper_material_relations';
    protected $primaryKey = 'id';
    protected $fillable = ['exam_id','paper_id','material_list', 'status'];

    public function exam()
    {
        return $this->belongsTo(ExamMaster::class);
    }
}
