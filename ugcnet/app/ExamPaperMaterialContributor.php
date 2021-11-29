<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamPaperMaterialContributor extends Model
{
    protected $table='exam_paper_material_contributor';
    protected $primaryKey = 'id';
    protected $fillable = [
        'exam_paper_material_content_id',
        'contributor_id',
        'price',
        
    ];

   
}
