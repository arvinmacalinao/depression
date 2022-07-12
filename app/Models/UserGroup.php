<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserGroup extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated';
    protected $table = 'psi_usergroups';
    protected $primaryKey = 'ug_id';

    public function regions(){
        return $this->belongsTo('App\Models\Region', 'region_id', 'region_id');
    }

    public function provinces(){
        return $this->belongsTo('App\Models\Province', 'province_id', 'province_id');
    }

    public function scopeRegion($query, $region_id) 
    {
        if($region_id) {
            $query->where('region_id', $region_id);
        }
        return $query;
    }

    public function scopeProvince($query, $province_id) 
    {
        if($province_id) {
            $query->where('province_id', $province_id);
        }
        return $query;
    }

    public function scopeUserGroup($query, $ug_name){
        $query->where(function($query) use($ug_name){
            $query->where('ug_name', 'like', "%$ug_name%");
        });
    }

    public function users(){
		return $this->hasMany('App\Models\User', 'ug_id', 'ug_id');
	}

    public function parent() {
        return $this->hasOne(self::class, 'ug_id', 'ug_parent_id');
    }
}
