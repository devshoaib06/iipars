<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseStructureRelation extends Model
{
    protected $table='course_structure_relations';
    protected $primaryKey = 'id';
    protected $fillable = [
        'exam_id',
        'product_id',
        'course_data',
        'course_subject',
        'paper_allmaterial',
        'price',
        
    ];

}
