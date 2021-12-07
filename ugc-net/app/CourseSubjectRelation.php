<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseSubjectRelation extends Model
{
    protected $table='course_exam_subject_relations';
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_id',
        'exam_id',
        'subject_id'
    ];

}
