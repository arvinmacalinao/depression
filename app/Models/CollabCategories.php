<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CollabCategories extends Model
{

    use SoftDeletes;

    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated'; 
    
    protected $table = 'psi_organization_types';
    protected $primaryKey = 'ot_id';

    public function scopeCategorySearch($query, $ot_name){
        $query->where(function($query) use($ot_name){
            $query->where('ot_name', 'like', "%$ot_name%");
        });
    }
}
