<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamPaperMaterialContent extends Model
{
    protected $table='exam_paper_material_content';
    protected $primaryKey = 'id';
    protected $fillable = [
        'exam_id',
        'paper_id',
        'material_id',
        'subject_id',
        'material_content',
        'material_content_type',
        'status'
    ];

}
