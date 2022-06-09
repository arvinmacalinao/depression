<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrganizationCategory extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated'; 

    protected $table = 'psi_organization_types_cat1';
    protected $primaryKey = 'ot_cat1_id';

    public function scopeOrgaCatSearch($query, $ot_cat1_name){
        $query->where(function($query) use($ot_cat1_name){
            $query->where('ot_cat1_name', 'like', "%$ot_cat1_name%");
        });
    }
}
