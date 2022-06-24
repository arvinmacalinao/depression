<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectLegal extends Model
{
    protected $table = 'psi_project_legals';
    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated'; 
    protected $primaryKey = 'legal_id';
    protected $fillable = ['legal_file', 'legal_filename', 'legal_remarks', 'prj_id', 'encoder', 'date_encoded', 'updater', 'last_updated', 'region_id', 'synched', 'sync_date'];
    
    public function scopeLegalSearch($query, $legal_search)
    {
        return $query->where(function($query) use($legal_search) {
             $query->where('legal_file', 'like', "%$legal_search%")->orwhere('legal_filename', 'like', "%$legal_search%")
             ->orwhere('legal_remarks', 'like', "%$legal_search%");
                
        });
    }

    public function document1()
    {
        if(\Storage::disk('uploads')->exists('documents/'.$this->legal_file)) {
            return asset('storage/uploads/documents/'.$this->legal_file);
        }
    }
}
