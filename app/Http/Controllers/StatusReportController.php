<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusReportController extends Controller
{
    public function index(){
        $dtdatas = DB::table('vwpsi_project_monitoring_summary')
                    // ->where('prj_year_approved', '=', '2021')
                    ->where('prj_year_approved', '=', date("Y"))
                    ->get();
        
        $yrs_approveds = DB::table('psi_project_monitoring')
                    ->distinct('prjmon_year')
                    ->orderBy('prjmon_year', 'DESC')
                    ->get();
        $sel_quarters = DB::table('psi_quarters')
                    ->distinct('quarter_name')
                    ->orderBy('quarter_name', 'ASC')
                    ->get();
        $sel_projecttypes = DB::table('psi_project_types')
                    ->distinct('prj_type_name')
                    ->orderBy('prj_type_name', 'ASC')
                    ->get();
        $sel_projectstatus = DB::table('psi_project_status')
                    ->distinct('prj_status_name')
                    ->orderBy('prj_status_name', 'ASC')
                    ->get();
        $sel_provinces = DB::table('psi_provinces')
                    ->distinct('province_name')
                    ->orderBy('province_name', 'ASC')
                    ->get();

        return view('projects.statreport', compact('yrs_approveds', 'dtdatas', 'sel_quarters', 'sel_projecttypes', 'sel_projectstatus', 'sel_provinces'));
    }
}
