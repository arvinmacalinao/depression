<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserGroupRights;

class UGroup extends Model
{
    protected $table = 'psi_usergroups';
    protected $primaryKey = 'ug_id';

    public function usergrouprights(){
        return $this->belongsTo(UserGroupRights::class);
    }
}
