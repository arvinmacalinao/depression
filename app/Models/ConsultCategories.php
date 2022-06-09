<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsultCategories extends Model
{

    use SoftDeletes;

    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated'; 

    protected $table = 'psi_consultancy_types';
    protected $primaryKey = 'con_type_id';

    public function scopeConsultSearch($query, $con_type_name){
        $query->where(function($query) use($con_type_name){
            $query->where('con_type_name', 'like', "%$con_type_name%");
        });
    }
}
