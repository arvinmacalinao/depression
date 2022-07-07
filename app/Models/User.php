<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated';
    protected $table = 'psi_users';
    protected $primaryKey = 'u_id';

    public function regions(){
        return $this->belongsTo('App\Models\Region', 'region_id', 'region_id');
    }

    public function usergroups(){
        return $this->belongsTo('App\Models\UserGroup', 'ug_id', 'ug_id');
    }

    public function scopeUserGroup($query, $usergroup_id) 
    {
        if($usergroup_id) {
            $query->where('ug_id', $usergroup_id);
        }
        return $query;
    }
    public function scopeRegion($query, $region) 
    {
        if($region) {
            $query->where('region_id', $region);
        }
        return $query;
    }

    public function scopeUserSearch($query, $u_username){
        $query->where(function($query) use($u_username){
            $query->where('u_username', 'like', "%$u_username%");
        });
    }

}

