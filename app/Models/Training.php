<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $table = 'psi_fora';
    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated';
    protected $primaryKey = 'fr_id';
    protected $fillable = ['fr_id', 'fr_requesting_party', 'fr_title', 'fr_sectors', 'fr_start', 'fr_end', 'fr_duration', 'fr_location', 'fr_longitude', 'fr_latitude', 'fr_elevation', 'fr_cost', 'fr_csf', 'fr_no_feminine', 'fr_no_masculine', 'fr_no_pwd', 'fr_no_seniors', 'fr_no_firms', 'fr_no_participants', 'fr_type_id', 'fr_remarks', 'prj_id', 'ug_id', 'encoder', 'date_encoded', 'updater', 'last_updated', 'fr_no_po', 'region_id', 'synched', 'sync_date', 'sp_id', 'province_id', 'city_id', 'barangay_id', 'district_id', 'sp_name', 'ug_name', 'region_name', 'province_name', 'city_name', 'barangay_name', 'district_name', 'fr_type_name', 'prj_title', 'fr_start_yr', 'fr_start_mo', 'fr_end_yr', 'fr_end_mo', 'collaborator_names', 'prj_code', 'prj_year_approved'];

    public function getDates()
    {
        return [];
    }
    public function ForaCollaborators()
    {
        return $this->hasMany('App\Models\ForaCollaborator', 'fr_id', 'fr_id');
    }
    public function ForaCollaborator() {
        return $this->belongsToMany('App\Models\ForaCollaborator', 'psi_fora_collaborators', 'fr_id', 'col_id');
    }

    public function scopeForaType($query, $fora_type) 
    {
        if($fora_type) {
            $query->where('fr_type_id', $fora_type);
        }
        return $query;
    }
    public function scopeForaYear($query, $fora_year) 
    {
        if($fora_year) {
            $query->where('fr_end_yr', $fora_year);
        }
        return $query;
    }
    // public function scopeConQtr($query, $con_qtr) 
    // {
    //     if($con_qtr) {
    //         $query->where('con_end_mo', $con_qtr);
    //     }
    //     return $query;
    // }
    public function type()
    {
        return $this->belongsTo('App\Models\ForaType', 'fr_type_id', 'fr_type_id');
    }
    public function usergroup()
    {
        return $this->belongsTo('App\Models\UserGroup', 'ug_id', 'ug_id');
    }
    public function serviceprovider()
    {
        return $this->belongsTo('App\Models\ServiceProvider', 'sp_id', 'sp_id');
    }
    public function trainingdocuments()
    {
        return $this->hasMany('App\Models\TrainingDocument', 'fr_id', 'fr_id');
    }
}
