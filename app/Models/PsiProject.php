<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PsiProject extends Model
{
    
    protected $table = 'psi_projects';
    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated';
    protected $primaryKey = 'prj_id';
    protected $guarded = ['prj_id'];
    
    
    public function scopeProjectType($query, $prj_type_id) 
    {
        if($prj_type_id) {
            $query->where('prj_type_id', $prj_type_id);
        }
        
        return $query;
    }

    public function scopeProjectStatus($query, $prj_status_id) 
    {
        if($prj_status_id) {
            $query->where('prj_status_id', $prj_status_id);
        }
        
        return $query;
    }

    public function type()
    {
        return $this->belongsTo('App\Models\ProjectType', 'prj_type_id', 'prj_type_id');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\ProjectStatus', 'prj_status_id', 'prj_status_id');
    }

    public function sector()
    {
        return $this->belongsTo('App\Models\ProjectSector', 'sector_id', 'sector_id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id', 'city_id');
    }
    
    public function province()
    {
        return $this->belongsTo('App\Models\Province', 'province_id', 'province_id');
    }
    
    public function barangay()
    {
        return $this->belongsTo('App\Models\Barangay', 'barangay_id', 'barangay_id');
    }
    public function region()
    {
        return $this->belongsTo('App\Models\Region', 'region_id', 'region_id');
    }
    public function usergroup()
    {
        return $this->belongsTo('App\Models\UserGroup', 'ug_id', 'ug_id');
    }


}
