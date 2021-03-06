<?php

namespace App\Http\Controllers;
use App\Markers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapDataController extends Controller
{
    public function index(){
        $icons = DB::table('psi_projects')
                    ->select('prj_type_id', 'sector_id', 'prj_status_id', 'region_id', 'prj_title','prj_latitude', 'prj_longitude','prj_status_id','prj_address','region_code','province_name','district_name','prj_type_name','sector_name','coop_names','collaborator_names','prj_code','prj_year_approved')
                    ->get();
        $mf_regions = DB::table('psi_regions')
                    ->select('region_code', 'region_name')
                    ->get();
        $mf_provinces = DB::table('psi_provinces')
                    ->select('province_name', 'province_id')
                    ->orderBy('province_name', 'ASC')
                    ->get();
        $mf_districts = DB::table('psi_districts')
                    ->select('district_name')
                    ->get();
        $mf_projtypes = DB::table('psi_project_types')
                    ->select('prj_type_name','prj_type_id')
                    ->get();
        $mf_equipments = DB::table('psi_equipment_brands')
                    ->select('brand_name')
                    ->orderBy('brand_name', 'ASC')
                    ->get();
        $mf_sectors = DB::table('psi_sectors')
                    ->select('sector_name', 'sector_id')
                    ->get();
        $mf_status = DB::table('psi_project_status')
                    ->select('prj_status_name', 'prj_status_id')
                    ->get();

        return view('home.home', compact('icons', 'mf_regions','mf_provinces','mf_districts','mf_projtypes','mf_equipments','mf_sectors','mf_status'));
    }
}
