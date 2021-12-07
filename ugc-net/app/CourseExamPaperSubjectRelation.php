<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseExamPaperSubjectRelation extends Model
{
    protected $table='course_exam_paper_subject_relations';
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_id',
        'exam_id',
        'subject_id',
        'paper_id'
    ];

}
