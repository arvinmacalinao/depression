<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class psi_provinces extends Model
{
    public function cities()
    {
        return $this->hasMany('App\psi_cities');
    }
}
