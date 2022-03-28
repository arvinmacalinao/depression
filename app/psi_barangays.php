<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class psi_barangays extends Model
{
    public function cities()
    {
        return $this->belongsTo('App\psi_cities');
    }
}
