<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseExamPaperRelation extends Model
{
    protected $table='course_exam_paper_relations';
    protected $primaryKey = 'id';
    protected $fillable = [
        'exam_id',
        'product_id',
        'paper_id',
        
    ];

}
