<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $primaryKey = 'media_id';
    public $timestamps = false;
    protected $fillable = ['value','title','media_type','exam_paper_material_content_id'];

}
