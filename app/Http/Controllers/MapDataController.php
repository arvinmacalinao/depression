<?php

namespace App\Http\Controllers;
use App\Markers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapDataController extends Controller
{
    public function index(){
        $icons = DB::table('psi_projects')
                    ->select('prj_type_id', 'sector_id', 'prj_status_id', 'region_id', 'prj_title','prj_latitude', 'prj_longitude')
                    ->get();
        $markers = DB::table('psi_projects')
                    ->select('prj_latitude', 'prj_longitude')
                    ->get();
        return view('home.home', compact('icons', 'markers'));
    }
}
