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
        $yrFrom = $_GET['yrFrom'];
        $yrTo = $_GET['yrTo'];

        if($prov_id == "*" && $district_id == "*" && $projtyp_id == "*" && $brand_id == "*" && $sector_id == "*" && $status_id == "*" && $yrFrom == "*" && $yrTo == "*"){
            $filter_prov = DB::table('psi_projects')
            ->select('*')
            ->get();
            return $filter_prov;
        }

        if($prov_id != "*" && $district_id == "*" && $projtyp_id == "*" && $brand_id == "*" && $sector_id == "*" && $status_id == "*" && $yrFrom == "*" && $yrTo == "*"){
            $filter_prov = DB::table('psi_projects')
            ->select('*')
            ->where('province_id', '=', $prov_id)
            ->get();
            return $filter_prov;           
        }

        if($prov_id == "*" && $district_id != "*" && $projtyp_id == "*" && $brand_id == "*" && $sector_id == "*" && $status_id == "*" && $yrFrom == "*" && $yrTo == "*"){
            $filter_prov = DB::table('psi_projects')
            ->select('*')
            ->where('district_name', '=', $district_id)
            ->get();
            return $filter_prov;           
        }

        if($prov_id == "*" && $district_id == "*" && $projtyp_id != "*" && $brand_id == "*" && $sector_id == "*" && $status_id == "*" && $yrFrom == "*" && $yrTo == "*"){
            $filter_prov = DB::table('psi_projects')
            ->select('*')
            ->where('prj_type_id', '=', $projtyp_id)
            ->get();
            return $filter_prov;           
        }

        if($prov_id == "*" && $district_id == "*" && $projtyp_id == "*" && $brand_id != "*" && $sector_id == "*" && $status_id == "*" && $yrFrom == "*" && $yrTo == "*"){
            $filter_prov = DB::table('psi_projects')
            ->select('*')
            ->where('prj_pis_assistance_equipment', 'like', '%' . $brand_id . '%')
            ->get();
            return $filter_prov;           
        }

        if($prov_id == "*" && $district_id == "*" && $projtyp_id == "*" && $brand_id == "*" && $sector_id != "*" && $status_id == "*" && $yrFrom == "*" && $yrTo == "*"){
            $filter_prov = DB::table('psi_projects')
            ->select('*')
            ->where('sector_id', '=', $sector_id)
            ->get();
            return $filter_prov;           
        }

        if($prov_id == "*" && $district_id == "*" && $projtyp_id == "*" && $brand_id == "*" && $sector_id == "*" && $status_id != "*" && $yrFrom == "*" && $yrTo == "*"){
            $filter_prov = DB::table('psi_projects')
            ->select('*')
            ->where('prj_status_id', '=', $status_id)
            ->get();
            return $filter_prov;           
        }

        if($prov_id == "*" && $district_id == "*" && $projtyp_id == "*" && $brand_id == "*" && $sector_id == "*" && $status_id == "*" && $yrFrom != "*" && $yrTo == "*"){
            $filter_prov = DB::table('psi_projects')
            ->select('*')
            ->where('prj_year_approved', '=', $yrFrom)
            ->get();
            return $filter_prov;           
        }

        if($prov_id == "*" && $district_id == "*" && $projtyp_id == "*" && $brand_id == "*" && $sector_id == "*" && $status_id == "*" && $yrFrom == "*" && $yrTo != "*"){
            $filter_prov = DB::table('psi_projects')
            ->select('*')
            ->where('prj_year_approved', '=', $yrTo)
            ->get();
            return $filter_prov;           
        }

        if($prov_id == "*" && $district_id == "*" && $projtyp_id == "*" && $brand_id == "*" && $sector_id == "*" && $status_id == "*" && $yrFrom != "*" && $yrTo != "*"){
            $filter_prov = DB::table('psi_projects')
            ->select('*')
            ->whereBetween('prj_year_approved', [$yrFrom, $yrTo])
            ->get();
            return $filter_prov;           
        }

        if($prov_id != "*"  && $district_id != "*" && $projtyp_id == "*" && $brand_id == "*" && $sector_id == "*" && $status_id == "*" && $yrFrom == "*" && $yrTo == "*"){
            $filter_prov = DB::table('psi_projects')
            ->select('*')
            ->where('province_id', '=', $prov_id)
            ->where('district_name', '=', $district_id)
            ->get();
            return $filter_prov;           
        }

        if($prov_id != "*"  && $district_id != "*" && $projtyp_id != "*" && $brand_id == "*" && $sector_id == "*" && $status_id == "*" && $yrFrom == "*" && $yrTo == "*"){
            $filter_prov = DB::table('psi_projects')
            ->select('*')
            ->where('province_id', '=', $prov_id)
            ->where('district_name', '=', $district_id)
            ->where('prj_type_id', '=', $projtyp_id)
            ->get();
            return $filter_prov;           
        }

        if($prov_id != "*"  && $district_id != "*" && $projtyp_id != "*" && $brand_id != "*" && $sector_id == "*" && $status_id == "*" && $yrFrom == "*" && $yrTo == "*"){
            $filter_prov = DB::table('psi_projects')
            ->select('*')
            ->where('province_id', '=', $prov_id)
            ->where('district_name', '=', $district_id)
            ->where('prj_type_id', '=', $projtyp_id)
            ->where('prj_pis_assistance_equipment', 'like', '%' . $brand_id . '%')
            ->get();
            return $filter_prov;           
        }

        if($prov_id != "*"  && $district_id != "*" && $projtyp_id != "*" && $brand_id != "*" && $sector_id != "*" && $status_id == "*" && $yrFrom == "*" && $yrTo == "*"){
            $filter_prov = DB::table('psi_projects')
            ->select('*')
            ->where('province_id', '=', $prov_id)
            ->where('district_name', '=', $district_id)
            ->where('prj_type_id', '=', $projtyp_id)
            ->where('prj_pis_assistance_equipment', 'like', '%' . $brand_id . '%')
            ->where('sector_id', '=', $sector_id)
            ->get();
            return $filter_prov;           
        }

        if($prov_id != "*"  && $district_id != "*" && $projtyp_id != "*" && $brand_id != "*" && $sector_id != "*" && $status_id != "*" && $yrFrom == "*" && $yrTo == "*"){
            $filter_prov = DB::table('psi_projects')
            ->select('*')
            ->where('province_id', '=', $prov_id)
            ->where('district_name', '=', $district_id)
            ->where('prj_type_id', '=', $projtyp_id)
            ->where('prj_pis_assistance_equipment', 'like', '%' . $brand_id . '%')
            ->where('sector_id', '=', $sector_id)
            ->where('prj_status_id', '=', $status_id)
            ->get();
            return $filter_prov;           
        }

        if($prov_id != "*"  && $district_id != "*" && $projtyp_id != "*" && $brand_id != "*" && $sector_id != "*" && $status_id != "*" && $yrFrom != "*" && $yrTo == "*"){
            $filter_prov = DB::table('psi_projects')
            ->select('*')
            ->where('province_id', '=', $prov_id)
            ->where('district_name', '=', $district_id)
            ->where('prj_type_id', '=', $projtyp_id)
            ->where('prj_pis_assistance_equipment', 'like', '%' . $brand_id . '%')
            ->where('sector_id', '=', $sector_id)
            ->where('prj_status_id', '=', $status_id)
            ->where('prj_year_approved', '=', $yrFrom)
            ->get();
            return $filter_prov;           
        }



    }
}
