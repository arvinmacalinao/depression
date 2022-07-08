<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectProgress extends Model
{
    
    use SoftDeletes;

    protected $table = 'psi_project_progress_reports';
    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated';
    protected $primaryKey = 'prjprog_id';
    protected $fillable = ['prjprog_month', 'prjprog_year', 'prjprog_month_from', 'prjprog_year_from', 'prjprog_month_to', 'prjprog_year_to', 'prjprog_accomplishment', 'prjprog_percentage', 'prjprog_cummulative', 'prjprog_expenditure', 'prjprog_remarks', 'prjprogtarget_id', 'quarter_id', 'semester_id', 'prj_id', 'region_id', 'synched', 'sync_date', 'date_encoded', 'last_updated', 'encoder', 'updater', 'prjprogrep_year_from', 'prjprogrep_year_to', 'prjprogrep_month_from', 'prjprogrep_month_to'];


    public function ProgressItems() {
        return $this->belongsToMany('App\Models\ProjectProgressReportItem', 'psi_project_progress_report_items', 'prjprogrep_id', 'prj_id', 'prjprogrep_id');
    }
    
    // public function getDates()
    // {
    //     return [];
    // }
    // public function ForaCollaborators()
    // {
    //     return $this->hasMany('App\Models\ForaCollaborator', 'fr_id', 'fr_id');
    // }
    // public function ForaCollaborator() {
    //     return $this->belongsToMany('App\Models\ForaCollaborator', 'psi_fora_collaborators', 'fr_id', 'col_id');
    // }

    // public function scopeForaType($query, $fora_type) 
    // {
    //     if($fora_type) {
    //         $query->where('fr_type_id', $fora_type);
    //     }
    //     return $query;
    // }
    // public function scopeForaYear($query, $fora_year) 
    // {
    //     if($fora_year) {
    //         $query->where('fr_end_yr', $fora_year);
    //     }
    //     return $query;
    // }
    // // public function scopeConQtr($query, $con_qtr) 
    // // {
    // //     if($con_qtr) {
    // //         $query->where('con_end_mo', $con_qtr);
    // //     }
    // //     return $query;
    // // }
    // public function type()
    // {
    //     return $this->belongsTo('App\Models\ForaType', 'fr_type_id', 'fr_type_id');
    // }
    // public function usergroup()
    // {
    //     return $this->belongsTo('App\Models\UserGroup', 'ug_id', 'ug_id');
    // }
    // public function serviceprovider()
    // {
    //     return $this->belongsTo('App\Models\ServiceProvider', 'sp_id', 'sp_id');
    // }
    // public function trainingdocuments()
    // {
    //     return $this->hasMany('App\Models\TrainingDocument', 'fr_id', 'fr_id');
    // }
}
