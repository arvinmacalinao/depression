<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserGroupRight extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated';
    protected $table = 'psi_usergroup_rights';
    protected $primaryKey = 'ug_id';

    public function ugroups(){
        return $this->belongsTo('App\Models\UserGroup','ug_id','ug_id');
    }
}
