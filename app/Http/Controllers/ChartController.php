<?php

namespace App\Http\Controllers;

use App\Chart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ViewRepaymentsData;

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

//
        $fora_pertype = DB::table('psi_fora')
            ->select('psi_fora_types.fr_type_name', 'psi_fora_types.fr_type_id', DB::raw('count(psi_fora.fr_type_id) as total'))
            ->leftJoin('psi_fora_types', 'psi_fora_types.fr_type_id', '=', 'psi_fora.fr_type_id')
            ->groupBy('psi_fora_types.fr_type_name')
            ->orderBy('total', 'DESC')
            ->pluck('total', 'psi_fora_types.fr_type_name')->all();
        $chart_fora_pertype = new Chart;
        $chart_fora_pertype ->labels = (array_keys($fora_pertype));
        $chart_fora_pertype ->dataset = (array_values($fora_pertype));
//
        $repayments_total_due = DB::table('psi_repayments_payments')
            ->select('psi_provinces.province_name', 'psi_projects.province_id', DB::raw('sum(psi_repayments_payments.pay_amount_due) AS rep_total_due'))
            ->leftJoin('psi_repayments', 'psi_repayments.rep_id', '=', 'psi_repayments_payments.rep_id')
            ->leftJoin('psi_projects', 'psi_projects.prj_id', '=', 'psi_repayments.prj_id')
            ->leftJoin('psi_provinces', 'psi_provinces.province_id', '=', 'psi_projects.province_id')
            ->where('psi_repayments_payments.pay_otb', '=', '0')
            ->where('psi_projects.province_id', '>', '0')
            ->groupBy('psi_projects.province_id', 'psi_provinces.province_name')
            ->orderBy('rep_total_due', 'DESC')
            ->pluck('rep_total_due', 'psi_projects.province_name')->all();
        $chart_repayments_total_due = new Chart;
        $chart_repayments_total_due ->labels = (array_keys($repayments_total_due));
        $chart_repayments_total_due ->dataset = (array_values($repayments_total_due));
        
//
        $repayments_total_refunded = DB::table('psi_repayments_payments')
            ->select('psi_provinces.province_name', 'psi_projects.province_id', DB::raw('sum(psi_repayments_payments.pay_amount_paid) AS rep_total_paid'))
            ->leftJoin('psi_repayments', 'psi_repayments.rep_id', '=', 'psi_repayments_payments.rep_id')
            ->leftJoin('psi_projects', 'psi_projects.prj_id', '=', 'psi_repayments.prj_id')
            ->leftJoin('psi_provinces', 'psi_provinces.province_id', '=', 'psi_projects.province_id')
            ->where('psi_repayments_payments.pay_otb', '=', '0')
            ->where('psi_projects.province_id', '>', '0')
            ->groupBy('psi_projects.province_id', 'psi_provinces.province_name')
            ->orderBy('rep_total_paid', 'DESC')
            ->pluck('rep_total_paid', 'psi_projects.province_name')->all();
        $chart_repayments_total_refunded = new Chart;
        $chart_repayments_total_refunded ->dataset = (array_values($repayments_total_refunded));  
        
//      
        $total_number_projects = DB::table('psi_projects')
            ->select(DB::raw('count(prj_id) as total_proj'))
            ->get();

        $total_number_repayments = DB::table('psi_repayments')
            ->select(DB::raw('count(rep_id) as total_rep'))
            ->get();

        $total_number_reportings = DB::table('psi_project_monitoring')
            ->select(DB::raw('count(prjmon_id) as total_number'))
            ->get();
        $total_number_amount_dues = DB::table('psi_repayments_payments')
            ->select(DB::raw('sum(pay_amount_due) as total_amount'))
            ->get();
        $total_number_amount_paids = DB::table('psi_repayments_payments')
            ->select(DB::raw('sum(pay_amount_paid) as total_paid'))
            ->get();

        return view('projects.projsumm', compact('chart_yr', 'chart_sector', 'chart_prov', 'chart_prjtype', 'chart_projstat', 'chart_cost_per_prov','chart_cost_per_sector', 'chart_fora_peryear', 'chart_fora_pertype', 'chart_repayments_total_due','chart_repayments_total_refunded','total_number_projects','total_number_repayments','total_number_reportings','total_number_amount_dues','total_number_amount_paids'));
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
