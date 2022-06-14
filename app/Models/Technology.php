<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Technology extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated'; 
    
    protected $table = 'psi_technologies';
    protected $primaryKey = 'tech_id';

    public function scopeTechSearch($query, $tech_name){
        $query->where(function($query) use($tech_name){
            $query->where('tech_name', 'like', "%$tech_name%");
        });
    }
}
