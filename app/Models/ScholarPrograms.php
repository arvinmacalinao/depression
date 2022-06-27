<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScholarPrograms extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated'; 

    protected $table = 'psi_scholarship_programs';
    protected $primaryKey = 'scholar_prog_id';

    public function scopeScholarProgramSearch($query, $scholar_prog_name){
        $query->where(function($query) use($scholar_prog_name){
            $query->where('scholar_prog_name', 'like', "%$scholar_prog_name%");
        });
    }
}
