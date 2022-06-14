<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{   
    protected $table = 'psi_cities';
    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated';
    
    protected $primaryKey = 'city_id';
    protected $guarded = ['city_id'];

    public function province()
    {
        return $this->belongsTO('App\Models\Province');
    }
    public function barangays()
    {
        return $this->hasMany('App\Models\Barangay');
    }
    public function district()
    {
        return $this->belongsTo('App\Models\District', 'district_id', 'district_id');
    }
}
