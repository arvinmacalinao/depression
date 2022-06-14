<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusReportFilter extends Controller
{
    public function status_sort(){
        $sel_op_yr_approved = $_GET['op_yr_approved'];
        $sel_op_qtr_name = $_GET['op_qtr_name'];
        $sel_op_prj_type = $_GET['op_prj_type'];
        $sel_op_prj_stat = $_GET['op_prj_stat'];
        $sel_op_province = $_GET['op_province'];
        $sel_op_prjtitle = $_GET['op_prjtitle'];

        if($sel_op_yr_approved == 'All' && $sel_op_qtr_name == 'All' && $sel_op_prj_type == 'All' && $sel_op_prj_stat == 'All' && $sel_op_province == 'All' && $sel_op_prjtitle == ''){
            $filtered_data = DB::table('vwpsi_project_monitoring_summary')
            ->select("*")
            ->get();
            return $filtered_data; 
        }else if($sel_op_yr_approved != 'All' && $sel_op_qtr_name == 'All' && $sel_op_prj_type == 'All' && $sel_op_prj_stat == 'All' && $sel_op_province == 'All'){
            $filtered_data = DB::table('vwpsi_project_monitoring_summary')
            ->where("prj_year_approved", "=", $sel_op_yr_approved)
            ->get();
            return $filtered_data; 
        }else if($sel_op_yr_approved == 'All' && $sel_op_qtr_name != 'All' && $sel_op_prj_type == 'All' && $sel_op_prj_stat == 'All' && $sel_op_province == 'All'){
            $filtered_data = DB::table('vwpsi_project_monitoring_summary')
            ->where("prj_year_approved", "=", $sel_op_yr_approved)
            ->get();
            return $filtered_data; 
        }else if($sel_op_yr_approved == 'All' && $sel_op_qtr_name == 'All' && $sel_op_prj_type != 'All' && $sel_op_prj_stat == 'All' && $sel_op_province == 'All'){
            $filtered_data = DB::table('vwpsi_project_monitoring_summary')
            ->where("prj_type_name", "=", $sel_op_prj_type)
            ->get();
            return $filtered_data; 
        }else if($sel_op_yr_approved == 'All' && $sel_op_qtr_name == 'All' && $sel_op_prj_type == 'All' && $sel_op_prj_stat != 'All' && $sel_op_province == 'All'){
            $filtered_data = DB::table('vwpsi_project_monitoring_summary')
            ->where("prj_status_name", "=", $sel_op_prj_stat)
            ->get();
            return $filtered_data; 
        }else if($sel_op_yr_approved == 'All' && $sel_op_qtr_name == 'All' && $sel_op_prj_type == 'All' && $sel_op_prj_stat == 'All' && $sel_op_province != 'All'){
            $filtered_data = DB::table('vwpsi_project_monitoring_summary')
            ->where("province_name", "=", $sel_op_province)
            ->get();
            return $filtered_data; 
        }else if($sel_op_yr_approved != 'All' && $sel_op_qtr_name != 'All' && $sel_op_prj_type == 'All' && $sel_op_prj_stat == 'All' && $sel_op_province == 'All'){
            $filtered_data = DB::table('vwpsi_project_monitoring_summary')
            ->where("prj_year_approved", "=", $sel_op_yr_approved)
            ->where("quarter_name", "=", $sel_op_qtr_name)
            ->get();
            return $filtered_data; 
        }else if($sel_op_yr_approved != 'All' && $sel_op_qtr_name != 'All' && $sel_op_prj_type != 'All' && $sel_op_prj_stat == 'All' && $sel_op_province == 'All'){
            $filtered_data = DB::table('vwpsi_project_monitoring_summary')
            ->where("prj_year_approved", "=", $sel_op_yr_approved)
            ->where("quarter_name", "=", $sel_op_qtr_name)
            ->where("prj_type_name", "=", $sel_op_prj_type)
            ->get();
            return $filtered_data; 
        }else if($sel_op_yr_approved != 'All' && $sel_op_qtr_name != 'All' && $sel_op_prj_type != 'All' && $sel_op_prj_stat != 'All' && $sel_op_province == 'All'){
            $filtered_data = DB::table('vwpsi_project_monitoring_summary')
            ->where("prj_year_approved", "=", $sel_op_yr_approved)
            ->where("quarter_name", "=", $sel_op_qtr_name)
            ->where("prj_type_name", "=", $sel_op_prj_type)
            ->where("prj_status_name", "=", $sel_op_prj_stat)
            ->get();
            return $filtered_data; 
        }else if($sel_op_yr_approved != 'All' && $sel_op_qtr_name != 'All' && $sel_op_prj_type != 'All' && $sel_op_prj_stat != 'All' && $sel_op_province != 'All'){
            $filtered_data = DB::table('vwpsi_project_monitoring_summary')
            ->where("prj_year_approved", "=", $sel_op_yr_approved)
            ->where("quarter_name", "=", $sel_op_qtr_name)
            ->where("prj_type_name", "=", $sel_op_prj_type)
            ->where("prj_status_name", "=", $sel_op_prj_stat)
            ->where("province_name", "=", $sel_op_province)
            ->get();
            return $filtered_data; 
        }else if($sel_op_yr_approved != 'All' && $sel_op_qtr_name == 'All' && $sel_op_prj_type == 'All' && $sel_op_prj_stat == 'All' && $sel_op_province == 'All' && $sel_op_prjtitle != ""){
            $filtered_data = DB::table('vwpsi_project_monitoring_summary')
            ->select("*")
            ->where("prj_year_approved", "=", $sel_op_yr_approved)
            ->orWhere("quarter_name", 'like', '%' . $sel_op_prjtitle . '%')
            ->orWhere("prj_type_name", 'like', '%' . $sel_op_prjtitle . '%')
            ->orWhere("prj_status_name", 'like', '%' . $sel_op_prjtitle . '%')
            ->orWhere("province_name", 'like', '%' . $sel_op_prjtitle . '%')
            ->get();
            return $filtered_data;     
        }
    }
}