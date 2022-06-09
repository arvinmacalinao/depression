<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CollabAgencies extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated'; 

    protected $table = 'psi_collaborators';
    protected $primaryKey = 'col_id';

    public function scopeAgencyName($query, $agency_search){
        if($agency_search){
            $query->where('col_name','like', "%$agency_search%");
        }
        return $query;
    }

    public function scopeCategory($query, $cat_search) 
    {
        if($cat_search) {
            $query->where('ot_id', $cat_search);
        }
        return $query;
    }

    public function organizationtypes(){
        return $this->belongsTo('App\Models\OrganizationType', 'ot_id', 'ot_id');
    }

}
