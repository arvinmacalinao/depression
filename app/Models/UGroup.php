<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserGroupRights;

class UGroup extends Model
{
    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated'; 
    
    protected $table = 'psi_usergroups';
    protected $primaryKey = 'ug_id';
}
