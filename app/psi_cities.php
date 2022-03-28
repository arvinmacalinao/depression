<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class psi_cities extends Model
{
    public function province()
    {
        return $this->belongsTO('App\psi_provinces');
    }
    public function barangays()
    {
        return $this->hasMany('App\psi_barangays');
    }
}
