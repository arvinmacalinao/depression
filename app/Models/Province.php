<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{   
    use SoftDeletes;

    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated';
    protected $primaryKey = 'province_id'; 

    protected $table = 'psi_provinces';
    
    public function cities()
    {
        return $this->hasMany('App\Models\City');
    }

    public function scopeProvinceSearch($query, $province_name){
        $query->where(function($query) use($province_name){
            $query->where('province_name', 'like', "%$province_name%");
        });
    }
}
