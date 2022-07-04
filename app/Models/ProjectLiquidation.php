<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectLiquidation extends Model
{
    protected $table = 'psi_project_liquidation';
    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated'; 
    protected $primaryKey = 'liq_id';
    protected $fillable = ['liq_file', 'liq_filename', 'liq_remarks', 'prj_id', 'liqtype_id', 'encoder', 'date_encoded', 'updater', 'last_updated', 'region_id', 'synched', 'sync_date'];
    
    public function scopeLiqType($query, $liq_type) 
    {
        if($liq_type) {
            $query->where('liqtype_id', $liq_type);
        }
        return $query;
    }

    public function scopeLiqSearch($query, $liq_search)
    {
        return $query->where(function($query) use($liq_search) {
             $query->where('liq_file', 'like', "%$liq_search%")->orwhere('liq_filename', 'like', "%$liq_search%")
             ->orwhere('liq_remarks', 'like', "%$liq_search%")->orWhereHas('liqtype', function($liqtype) use($liq_search) {
                $liqtype->where('liqtype_name', 'like', "%$liq_search%");
                });
                
        });
    }

    public function liqtype()
    {
        return $this->belongsTo('App\Models\ProjectLiquidationType', 'liqtype_id', 'liqtype_id');
    }

    public function document1()
    {
        if(\Storage::disk('uploads')->exists('documents/'.$this->liq_file)) {
            return asset('storage/uploads/documents/'.$this->liq_file);
        }
    }
}
