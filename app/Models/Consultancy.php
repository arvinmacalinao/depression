<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultancy extends Model
{
    
    protected $table = 'psi_consultancies';
    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated';
    protected $primaryKey = 'con_id';
    protected $fillable = ['con_id', 'con_start', 'con_end', 'con_type_id', 'prj_id', 'coop_id', 'sp_id', 'ug_id', 'encoder', 'date_encoded', 'updater', 'last_updated', 'con_no_participants', 'con_no_firms', 'con_no_po', 'province_id', 'city_id', 'barangay_id', 'region_id', 'synched', 'sync_date', 'con_cost', 'district_id', 'sp_name', 'ug_name', 'region_name', 'province_name', 'city_name', 'district_name', 'barangay_name', 'coop_name', 'con_type_name', 'prj_title', 'con_start_yr', 'con_start_mo', 'con_end_yr', 'con_end_mo', 'prj_code', 'prj_year_approved'];

    public function consultancytype()
    {
        return $this->belongsTo('App\Models\ConsultancyType', 'con_type_id', 'con_type_id');
    }
    public function serviceprovider()
    {
        return $this->belongsTo('App\Models\ServiceProvider', 'sp_id', 'sp_id');
    }
    public function consultancydocuments()
    {
        return $this->hasMany('App\Models\ConsultancyDocuments', 'con_id', 'con_id');
    }
}
