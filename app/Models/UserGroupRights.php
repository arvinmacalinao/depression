<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UGroup;

class UserGroupRights extends Model

{
    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated'; 

    protected $table = 'psi_usergroup_rights';
    protected $primaryKey = 'ugr_id';
    protected $fillable = ['ur_id', 'ug_id'];
    
    public function ugroup(){
        return $this->hasMany(UGroup::class);
    }
}
