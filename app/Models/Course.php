<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated'; 

    protected $table = 'psi_courses';
    protected $primaryKey = 'course_id';

    public function scopeCourse($query, $course_name, $course_cat_id){
        $query->where(function($query) use($course_name){
            $query->where('course_name', 'like', "%$course_name%")->orwhere('course_cat_id', "=" ,$course_name);
        });
    }

    public function coursecategory(){
        return $this->belongsTo('App\Models\CourseCategory', 'course_cat_id', 'course_cat_id');
    }
}
