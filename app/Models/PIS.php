<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PIS extends Model
{
    protected $table = 'psi_project_pis';
    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated';
    protected $primaryKey = 'prjpis_id';
    protected $fillable = ['prj_id', 'prjpis_year', 'quarter_id', 'sem_id', 'prjpis_total_assets_land', 'prjpis_total_assets_building', 'prjpis_total_assets_equipment', 'prjpis_total_assets_working_capital', 'prjpis_total_employment', 'prjpis_dir_ch_regular_male', 'prjpis_dir_ch_regular_female', 'prjpis_dir_ch_regular_pwd', 'prjpis_dir_ch_regular_senior', 'prjpis_dir_ch_part_time_male', 'prjpis_dir_ch_part_time_female', 'prjpis_dir_ch_part_time_pwd', 'prjpis_dir_ch_part_time_senior', 'prjpis_dir_sh_regular_male', 'prjpis_dir_sh_regular_female', 'prjpis_dir_sh_regular_pwd', 'prjpis_dir_sh_regular_senior', 'prjpis_dir_sh_part_time_male', 'prjpis_dir_sh_part_time_female', 'prjpis_dir_sh_part_time_pwd', 'prjpis_dir_sh_part_time_senior', 'prjpis_indir_backward_male', 'prjpis_indir_backward_female', 'prjpis_indir_backward_pwd', 'prjpis_indir_backward_senior', 'prjpis_indir_forward_male', 'prjpis_indir_forward_female', 'prjpis_indir_forward_pwd', 'prjpis_indir_forward_senior', 'prjpis_volume_production_local', 'prjpis_volume_production_export', 'prjpis_gross_sales_local', 'prjpis_gross_sales_export', 'prjpis_countries_of_destination', 'prjpis_assistance_process', 'prjpis_assistance_equipment', 'prjpis_assistance_quality_control', 'prjpis_assistance_packaging_labeling', 'prjpis_assistance_post_harvest', 'prjpis_assistance_marketing', 'prjpis_assistance_training_text', 'prjpis_assistance_consultancy_text', 'prjpis_assistance_others_text', 'prjpis_remarks', 'encoder', 'date_encoded', 'updater', 'last_updated', 'prjform_id', 'prjpis_assistance_training', 'prjpis_assistance_consultancy', 'prjpis_assistance_process_text', 'prjpis_assistance_quality_control_text', 'prjpis_assistance_post_harvest_text', 'prjpis_assistance_marketing_text', 'prjpis_assistance_others', 'region_id', 'synched', 'sync_date'];
    

    public function scopePISyear($query, $pis_year) 
    {
        if($pis_year) {
            $query->where('prjpis_year', $pis_year);
        }
        
        return $query;
    }
    public function scopePISsem($query, $pis_sem) 
    {
        if($pis_sem) {
            $query->where('sem_id', $pis_sem);
        }
        
        return $query;
    }

    public function semester()
    {
        return $this->belongsTo('App\Models\Semester', 'sem_id', 'sem_id');
    }
}
