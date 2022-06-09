<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectCategory extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated'; 

    protected $table = 'psi_project_types';
    protected $primaryKey = 'prj_type_id';

    public function scopeProjectCategorySearch($query, $prj_type_name){
        $query->where(function($query) use($prj_type_name){
            $query->where('prj_type_name', 'like', "%$prj_type_name%");
        });
    }
}
