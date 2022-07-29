<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRight extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated';
    protected $table = 'psi_user_rights';
    protected $primaryKey = 'ur_id';

    public function urights(){
        return $this->hasMany('App\Models\UserGroupRight','ur_id','ur_id');
    }
}
