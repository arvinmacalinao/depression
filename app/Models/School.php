<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated'; 

    protected $table = 'psi_schools';
    protected $primaryKey = 'school_id';

    public function scopeSchoolSearch($query, $school_name){
        $query->where(function($query) use($school_name){
            $query->where('school_name', 'like', "%$school_name%");
        });
    }
}
