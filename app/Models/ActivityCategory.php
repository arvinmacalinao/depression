<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityCategory extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated'; 
    
    protected $table = 'psi_activity_types';
    protected $primaryKey = 'activity_type_id';

    public function scopeActivitySearch($query, $activity_type_name){
        $query->where(function($query) use($activity_type_name){
            $query->where('activity_type_name', 'like', "%$activity_type_name%");
        });
    }
}
