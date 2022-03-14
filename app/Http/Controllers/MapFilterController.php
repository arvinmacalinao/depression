<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapFilterController extends Controller
{
    public function sort(){
        $prov_id = $_GET['prov_id'];
        $filter_prov = DB::table('psi_projects')
                    ->select('prj_type_id', 'sector_id', 'prj_status_id', 'region_id', 'prj_title','prj_latitude', 'prj_longitude')
                    ->where('province_id', '=', $prov_id)
                    ->get();
        return $filter_prov;
    }
}
