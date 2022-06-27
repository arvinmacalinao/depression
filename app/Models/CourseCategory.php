<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseCategory extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated'; 

    protected $table = 'psi_course_categories';
    protected $primaryKey = 'course_cat_id';

    public function scopeCourseSearch($query, $course_cat_name){
        $query->where(function($query) use($course_cat_name){
            $query->where('course_cat_name', 'like', "%$course_cat_name%");
        });
    }

    public function course(){
        return $this->hasMany('App\Models\Course', 'course_cat_id', 'course_cat_id');
    }
}
