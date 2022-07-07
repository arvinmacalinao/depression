<?php

namespace App\Models;

use App\Models\UGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserGroupRights extends Model

{
    use SoftDeletes;

    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated'; 

    protected $table = 'psi_usergroup_rights';
    protected $primaryKey = 'ugr_id';
    protected $fillable = ['ur_id', 'ug_id'];

    public function UserGroup()
    {
        return $this->belongsTo('App\Models\UGroup');
    }
}
