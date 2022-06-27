<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barangay extends Model
{

    use SoftDeletes;
    protected $table = 'psi_barangays';
    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated';
    protected $primaryKey = 'barangay_id';

    public function cities()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function scopeBarangaySearch($query, $barangay_name){
        $query->where(function($query) use($barangay_name){
            $query->where('barangay_name', 'like', "%$barangay_name%");
        });
    }
}
