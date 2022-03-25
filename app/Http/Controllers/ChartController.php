<?php

namespace App\Http\Controllers;

use App\Chart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//
        $yr_approved = DB::table('psi_projects')
            ->select('prj_year_approved', DB::raw('count(*) as total'))
            ->groupBy('prj_year_approved')
            ->pluck('total', 'prj_year_approved')->all();
        $chart_yr = new Chart;
        $chart_yr ->labels = (array_keys($yr_approved));
        $chart_yr ->dataset = (array_values($yr_approved));

//
        $sector_cnt = DB::table('psi_projects')
        ->select('psi_sectors.sector_name', 'psi_sectors.sector_id', DB::raw('count(psi_projects.sector_id) as total'))
        ->leftJoin('psi_sectors', 'psi_sectors.sector_id', '=', 'psi_projects.sector_id')
        ->groupBy('psi_sectors.sector_id')
        ->orderBy('total', 'DESC')
        ->pluck('total', 'psi_sectors.sector_name')->all();
        $chart_sector = new Chart;
        $chart_sector ->labels = (array_keys($sector_cnt));
        $chart_sector ->dataset = (array_values($sector_cnt));
//
        $prov_cnt = DB::table('psi_projects')
        ->select('psi_provinces.province_name', 'psi_provinces.province_id', DB::raw('count(psi_projects.province_id) as total'))
        ->leftJoin('psi_provinces', 'psi_provinces.province_id', '=', 'psi_projects.province_id')
        ->groupBy('psi_provinces.province_name')
        ->orderBy('total', 'DESC')
        ->pluck('total', 'psi_provinces.province_name')->all();
        $chart_prov = new Chart;
        $chart_prov ->labels = (array_keys($prov_cnt));
        $chart_prov ->dataset = (array_values($prov_cnt));

//
        $prjtype_cnt = DB::table('psi_projects')
        ->select('psi_project_types.prj_type_name', 'psi_project_types.prj_type_id', DB::raw('count(psi_projects.prj_type_id) as total'))
        ->leftJoin('psi_project_types', 'psi_project_types.prj_type_id', '=', 'psi_projects.prj_type_id')
        ->groupBy('psi_project_types.prj_type_name')
        ->orderBy('total', 'DESC')
        ->pluck('total', 'psi_project_types.prj_type_name')->all();
        $chart_prjtype = new Chart;
        $chart_prjtype ->labels = (array_keys($prjtype_cnt));
        $chart_prjtype ->dataset = (array_values($prjtype_cnt));

//
        $projstat = DB::table('psi_projects')
        ->select('psi_project_status.prj_status_name', 'psi_project_status.prj_status_id', DB::raw('count(psi_projects.prj_status_id) as total'))
        ->leftJoin('psi_project_status', 'psi_project_status.prj_status_id', '=', 'psi_projects.prj_status_id')
        ->groupBy('psi_project_status.prj_status_name')
        ->orderBy('total', 'DESC')
        ->pluck('total', 'psi_project_status.prj_status_name')->all();
        $chart_projstat = new Chart;
        $chart_projstat ->labels = (array_keys($projstat));
        $chart_projstat ->dataset = (array_values($projstat));

//
        $cost_per_prov = DB::table('psi_projects')
        ->select('psi_provinces.province_name', 'psi_provinces.province_id', DB::raw('sum(psi_projects.prj_cost_setup) as total'))
        ->leftJoin('psi_provinces', 'psi_provinces.province_id', '=', 'psi_projects.province_id')
        ->groupBy('psi_provinces.province_name')
        ->orderBy('total', 'DESC')
        ->pluck('total', 'psi_provinces.province_name')->all();
        $chart_cost_per_prov = new Chart;
        $chart_cost_per_prov ->labels = (array_keys($cost_per_prov));
        $chart_cost_per_prov ->dataset = (array_values($cost_per_prov));

//
        $cost_per_sector = DB::table('psi_projects')
        ->select('psi_sectors.sector_name', 'psi_sectors.sector_id', DB::raw('sum(psi_projects.prj_cost_setup) as total'))
        ->leftJoin('psi_sectors', 'psi_sectors.sector_id', '=', 'psi_projects.sector_id')
        ->groupBy('psi_sectors.sector_name')
        ->orderBy('total', 'DESC')
        ->pluck('total', 'psi_sectors.sector_name')->all();
        $chart_cost_per_sector = new Chart;
        $chart_cost_per_sector ->labels = (array_keys($cost_per_sector));
        $chart_cost_per_sector ->dataset = (array_values($cost_per_sector));
//
        $fora_peryear = DB::table('psi_fora')
        ->select('fr_end_yr', DB::raw('count(*) as total'))
        ->groupBy('fr_end_yr')
        ->pluck('total', 'fr_end_yr')->all();
        $chart_fora_peryear = new Chart;
        $chart_fora_peryear ->labels = (array_keys($fora_peryear));
        $chart_fora_peryear ->dataset = (array_values($fora_peryear));
        

        return view('projects.projsumm', compact('chart_yr', 'chart_sector', 'chart_prov', 'chart_prjtype', 'chart_projstat', 'chart_cost_per_prov','chart_cost_per_sector', 'chart_fora_peryear'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function show(Chart $chart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function edit(Chart $chart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chart $chart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chart $chart)
    {
        //
    }
}
