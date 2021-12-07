<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['student_name', 'student_course', 'testimonial_type', 'testimonial_text', 'video_url', 'status'];
}
