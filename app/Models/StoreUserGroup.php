<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreUserGroup extends Model
{
    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated'; 
    
    protected $table = 'psi_usergroups';
    public $timestamps = true;

    protected $fillable = [
		'ug_name', 'ug_display_name','region_id', 'province_id','ug_parent_id','ug_unit_head','copy_rights',
	];
}
