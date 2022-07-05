<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectSite extends Model
{
    protected $table = 'psi_project_sites';
    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated';
    protected $primaryKey = 'prj_site_id';
    protected $fillable = ['prj_site_date', 'prj_site_remarks', 'prj_site_address', 'prj_site_longitude', 'prj_site_latitude', 'prj_site_elevation', 'brand_id', 'prj_id', 'encoder', 'date_encoded', 'updater', 'last_updated', 'province_id', 'city_id', 'barangay_id', 'region_id', 'synched', 'sync_date'];
    

    public function scopeSiteBrand($query, $site_brand) 
    {
        if($site_brand) {
            $query->where('brand_id', $site_brand);
        }
        return $query;
    }
    
    public function scopeSiteYear($query, $site_year) 
    {
        if($site_year) {
            $query->where('prj_site_date', 'like', "%$site_year%");
        }
        return $query;
    }
    
    public function scopeSiteSearch($query, $site_search)
    {
        return $query->where(function($query) use($site_search) {
             $query->where('prj_site_remarks', 'like', "%$site_search%")->orwhere('prj_site_date', 'like', "%$site_search%")
             ->orwhere('prj_site_remarks', 'like', "%$site_search%")->orWhereHas('brand', function($brand) use($site_search) {
                $brand->where('brand_name', 'like', "%$site_search%");
                });
        });
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_id', 'brand_id');
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
    
    // public function AlbumPhotos()
    // {
    //     return $this->belongsToMany('App\Models\ProjectAlbumPhoto', 'psi_project_album_photos', 'photo_id', 'photo_file', 'photo_filename', 'encoder', 'date_encoded', 'updater', 'last_updated');
    // }
    // public function distributions()
    // {
    //     return $this->belongsTo('App\Models\Distribution', 'pkg_distribution', 'dist_id');
    // }

    // public function PackagingDesigns()
    // {
    //     return $this->hasMany('App\Models\PackagingDesign', 'pkg_id', 'pkg_id');
    // }
    // public function photos()
    // {
    //     return $this->belingsTo('App\Models\ProjectAlbumPhoto', 'album_id', 'album_id');
    // }
}
