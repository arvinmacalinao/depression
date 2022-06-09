<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipmentNames extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated'; 

    protected $table = 'psi_equipment_brands';
    protected $primaryKey = 'brand_id';

    public function scopeEquipmentSearch($query, $brand_name){
        $query->where(function($query) use($brand_name){
            $query->where('brand_name', 'like', "%$brand_name%");
        });
    }
}
