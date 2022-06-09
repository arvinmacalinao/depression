<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductUnit extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated'; 

    protected $table = 'psi_units';
    protected $primaryKey = 'unit_id';

    public function scopeProductUnitSearch($query, $unit_name){
        $query->where(function($query) use($unit_name){
            $query->where('unit_name', 'like', "%$unit_name%");
        });
    }
}
