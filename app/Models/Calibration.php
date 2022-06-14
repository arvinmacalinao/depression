<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calibration extends Model
{
    protected $table = 'psi_project_calibrations';
    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated';
    protected $primaryKey = 'cal_id';
    protected $fillable = ['cal_month', 'cal_year', 'cal_no_parameters', 'cal_parameters', 'cal_no_products', 'cal_products', 'cal_remarks', 'lab_id', 'encoder', 'date_encoded', 'updater', 'last_updated', 'ug_id', 'prj_id', 'region_id', 'synched', 'sync_date', 'cal_no_tests_free', 'cal_income', 'cal_cost'];
    

    public function scopeCalLab($query, $cal_lab) 
    {
        if($cal_lab) {
            $query->where('lab_id', $cal_lab);
        }
        return $query;
    }

    public function scopeCalImp($query, $cal_imp) 
    {
        if($cal_imp) {
            $query->where('ug_id', $cal_imp);
        }
        return $query;
    }

    public function scopeCalYear($query, $cal_year) 
    {
        if($cal_year) {
            $query->where('cal_year', $cal_year);
        }
        return $query;
    }
    // public function scopeEqSearch($query, $eq_search)
    // {
    //     return $query->where(function($query) use($eq_search) {
    //          $query->where('eqp_property_no', 'like', "%$eq_search%")->orwhere('eqp_specs', 'like', "%$eq_search%")
    //         ->orwhere('eqp_remarks', 'like', "%$eq_search%")->orwhere('eqp_qty', 'like', "%$eq_search%")
    //         ->orWhereHas('brands', function($brands) use($eq_search) {
    //             $brands->where('brand_name', 'like', "%$eq_search%");
    //             })
    //         ->orWhereHas('improvements', function($improvements) use($eq_search) {
    //                 $improvements->where('imp_name', 'like', "%$eq_search%");
    //             });
    //     });
    // }

    public function laboratories()
    {
        return $this->belongsTo('App\Models\Laboratory', 'lab_id', 'lab_id');
    }

    public function usergroups()
    {
        return $this->belongsTo('App\Models\UserGroup', 'ug_id', 'ug_id');
    }

    public function months()
    {
        return $this->belongsTo('App\Models\Month', 'cal_month', 'cal_month');
    }
}
