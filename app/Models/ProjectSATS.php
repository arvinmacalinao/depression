<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectSATS extends Model
{
    protected $table = 'psi_project_sats';
    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated'; 
    protected $primaryKey = 'sat_id';
    protected $fillable = ['sat_date', 'sat_file', 'sat_filename', 'sat_remarks', 'satt_id', 'prj_id', 'encoder', 'date_encoded', 'updater', 'last_updated', 'region_id', 'synched', 'sync_date'];

    public function sattype()
    {
        return $this->belongsTo('App\Models\ProjectSATSType', 'satt_id', 'satt_id');
    }
    
    public function scopeSatType($query, $sat_type) 
    {
        if($sat_type) {
            $query->where('satt_id', $sat_type);
        }
        return $query;
    }
    public function scopeSatYear($query, $sat_year) 
    {
        if($sat_year) {
            $query->where('sat_date', 'like', "%$sat_year%");
        }
        return $query;
    }
    
    public function scopeSatSearch($query, $sat_search)
    {
        return $query->where(function($query) use($sat_search) {
             $query->where('sat_file', 'like', "%$sat_search%")->orwhere('sat_filename', 'like', "%$sat_search%")
             ->orwhere('sat_remarks', 'like', "%$sat_search%")->orWhereHas('sattype', function($sattype) use($sat_search) {
                $sattype->where('satt_name', 'like', "%$sat_search%");
                });
        });
    }

    public function document1()
    {
        if(\Storage::disk('uploads')->exists('documents/'.$this->sat_file)) {
            return asset('storage/uploads/documents/'.$this->sat_file);
        }
    }
}
