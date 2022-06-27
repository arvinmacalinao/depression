<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated'; 
    protected $primaryKey = 'region_id';

    protected $table = 'psi_regions';

    public function scopeRegionSearch($query, $region_name){
        $query->where(function($query) use($region_name){
            $query->where('region_name', 'like', "%$region_name%");
        });
    }
}
