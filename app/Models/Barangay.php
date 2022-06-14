<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    protected $table = 'psi_barangays';

    public function cities()
    {
        return $this->belongsTo('App\Models\City');
    }
}
