<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\City;

class PsiProject extends Model
{
    
    protected $table = 'psi_projects';
    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated';
    protected $primaryKey = 'prj_id';
    protected $guarded = ['prj_id'];

    // FILTER AND SEARCH

    public function scopeProjectType($query, $project_type) 
    {
        if($project_type) {
            $query->where('prj_type_id', $project_type);
        }
        
        return $query;
    }

    public function scopeProjectStatus($query, $project_status) 
    {
        if($project_status) {
            $query->where('prj_status_id', $project_status);
        }
        
        return $query;
    }
    public function scopeProjectYearApproved($query, $project_year_approved) 
    {
        if($project_year_approved) {
            $query->where('prj_year_approved', $project_year_approved);
        }
        
        return $query;
    }
    public function scopeProjectProvince($query, $project_province) 
    {
        if($project_province) {
            $query->where('province_id', $project_province);
        }
        
        return $query;
    }
    public function scopeProjectSector($query, $project_sector)
    {
        if($project_sector) {
            $query->where('sector_id', $project_sector);
        }
        return $query;
    }

    public function scopeProjectDistrict($query, $district_id) 
    {
      if($district_id) 
        {
         $query->whereHas('city', function($sub_query) use($district_id) {
               $sub_query->where('district_id', $district_id);
        
           }); 
         return $query;
        }
    }

    public function scopeProjectUserGroup($query, $project_usergroup)
    {
        if($project_usergroup){
            $query->where('ug_id', $project_usergroup);
        }
        return $query;
    }

     public function scopeProjectSearch($query, $project_search)
     {
         return $query->where(function($query) use($project_search) {
             $query->where('prj_title', 'like', "%$project_search%")->orwhere('prj_code', 'like', "%$project_search%")
            ->orWhereHas('province', function($province) use($project_search) {
                $province->where('province_name', 'like', "%$project_search%");
                })
            // ->orWhereHas('city', function($city) use($project_search) {
            //     $city->where('city_name', 'like', "%$project_search%");
            //     })
            ->orWhereHas('region', function($region) use($project_search) {
                $region->where('region_code', 'like', "%$project_search%");
                })
            ->orWhereHas('usergroup', function($usergroup) use($project_search) {
                $usergroup->where('ug_name', 'like', "%$project_search%");
                })
            ;
        });
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
    public function ProjectBeneficiary()
    {
        return $this->hasMany('App\Models\ProjectBeneficiary', 'prj_id', 'prj_id');
    }
    public function ProjectCollaborator()
    {
        return $this->hasMany('App\Models\ProjectCollaborator', 'prj_id', 'prj_id');
    }
}
