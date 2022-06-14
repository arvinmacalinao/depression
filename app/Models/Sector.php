<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sector extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated'; 
    
    protected $table = 'psi_sectors';
    protected $primaryKey = 'sector_id';

    public function scopeSectorSearch($query, $sector_name){
        $query->where(function($query) use($sector_name){
            $query->where('sector_name', 'like', "%$sector_name%");
        });
    }
}
