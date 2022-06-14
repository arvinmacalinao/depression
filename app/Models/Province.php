<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{   
    protected $table = 'psi_provinces';
    
    public function cities()
    {
        return $this->hasMany('App\Models\City');
    }
}