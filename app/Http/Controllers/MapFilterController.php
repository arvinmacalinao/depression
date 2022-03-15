<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class MapFilterController extends Controller
{
    public function sort(){
        $prov_id = $_GET['prov_id'];
        $district_id = $_GET['district_id'];
        $projtyp_id = $_GET['projtyp_id'];
        $brand_id = $_GET['brand_id'];
        $sector_id = $_GET['sector_id'];
        $status_id = $_GET['status_id'];
        $keyWordz = $_GET['keyWordz'];


        $filter_prov = DB::table('psi_projects')
                    ->select('prj_type_id', 'sector_id', 'prj_status_id', 'region_id', 'prj_title','prj_latitude', 'prj_longitude')
                    ->where('province_id', '=', $prov_id)
                    ->orWhere('district_name', '=', $district_id)
                    ->orWhere('prj_type_id', '=', $projtyp_id)
                    ->orWhere('prj_pis_assistance_equipment', 'like', '%' . $brand_id . '%')
                    ->orWhere('sector_id', '=', $sector_id)
                    ->orWhere('prj_status_id', '=', $status_id)

                    ->orWhere('province_id', 'like', '%' . $keyWordz . '%')
                    ->orWhere('district_name', 'like', '%' . $keyWordz . '%')
                    ->orWhere('prj_type_id', 'like', '%' . $keyWordz . '%')
                    ->orWhere('prj_pis_assistance_equipment', 'like', '%' . $keyWordz . '%')
                    ->orWhere('sector_id', 'like', '%' . $keyWordz . '%')
                    ->orWhere('prj_status_id', 'like', '%' . $keyWordz . '%')
                    
                    ->get();
        return $filter_prov;
    }
}
