<?php

namespace App\Http\Controllers;
use Datatables;
use App\Models\City;
use App\Models\Barangay;
use App\Models\PsiProject;
use App\Models\ProjectBeneficiary;
use App\Models\ProjectCollaborator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;




class PsiProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        //filter
        $project_type = $request->get('type');
        $project_status = $request->get('qstatus');
        $project_year_approved = $request->get('qyear');
        $project_province = $request->get('qprovince');
        $project_district = $request->get('qdistrict');
        $project_sector = $request->get('qsector');
        $project_usergroup = $request->get('qusergroup');
        $project_search = $request->get('search');
        
        $psi_projects = PsiProject::ProjectType($project_type)->ProjectStatus($project_status)
        ->ProjectYearApproved($project_year_approved)->ProjectProvince($project_province)->ProjectDistrict($project_district)
        ->ProjectSector($project_sector)->ProjectUsergroup($project_usergroup)->ProjectSearch($project_search);

        $sum_prj_cost_setup = $psi_projects->sum('prj_cost_setup');
        $sum_rep_total_due = $psi_projects->sum('rep_total_due');
        $sum_rep_total_paid = $psi_projects->sum('rep_total_paid');
        $sum_rep_refund_rate = $psi_projects->sum('rep_refund_rate');
        

        $psi_projects = $psi_projects->paginate(20);

        

        
        
        
        // $get_coop_ids = ProjectBeneficiary::whereIn('prj_id', $psi_projects->prj_id[0])->get();
        //dd($get_coop_ids);

        $sel_project_types = DB::table('psi_project_types')
                            ->select('prj_type_id','prj_type_name')
                            ->get();
        $sel_project_statuses = DB::table('psi_project_status')
                            ->select('prj_status_id', 'prj_status_name')
                            ->get();
        $sel_project_years = DB::table('psi_projects')
                            ->groupBy('prj_year_approved')
                            ->select('prj_year_approved')
                            ->Orderby('prj_year_approved', 'desc')
                            ->get();
        $sel_project_provinces = DB::table('psi_provinces')
                            ->select('province_id', 'province_name')
                            ->Orderby('province_name', 'asc')
                            ->get();
        $sel_project_districts = DB::table('psi_districts')
                            ->select('district_id', 'district_name')
                            ->get();
        $sel_project_sectors = DB::table('psi_sectors')
                            ->select('sector_id', 'sector_name')
                            ->get();
        $sel_project_implementors = DB::table('psi_usergroups')
                            ->select('ug_id', 'ug_name')
                            ->get();
        // dd($sel_project_provinces);
        return view('./projects/projects', compact('psi_projects', 'sel_project_types', 'sel_project_statuses', 'sel_project_years', 'sel_project_provinces', 'sel_project_districts', 'sel_project_sectors', 'sel_project_implementors', 'project_search', 'sum_prj_cost_setup', 'sum_rep_total_due', 'sum_rep_total_due', 'sum_rep_total_paid', 'sum_rep_refund_rate'))->with('i', ($request->input('page', 1) - 1) * 20);
        
    }

    
    //DATATABLES
    // public function projectList()
    // {           
        
    //     $psi_projects = DB::table('psi_projects')->select('*');
    //     return datatables()->of($psi_projects)
    //     //->setRowData([ 'data-prj_cost_setup' => 'Php {{ $prj_cost_setup }}' ])
    //     // ->setRowClass('{{ $prj_id % 2 == 0 ? "alert-success" : "alert-warning" }}')
    //     ->addColumn('row', 'row')
    //     ->make(true);
    // }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addproject()
    {
        $sel_types = DB::table('psi_project_types')
        ->select('prj_type_id', 'prj_type_name')
        ->get();

        $sel_benefeciaries = DB::table('psi_cooperators')
        ->select('coop_id', 'coop_name')
        ->Orderby('coop_name', 'asc')
        ->get();

        $sel_collaborators = DB::table('psi_collaborators')
        ->select('col_id', 'col_name')
        ->Orderby('col_name', 'asc')
        ->get();

        $sel_usergroups = DB::table('psi_usergroups')
        ->select('ug_id', 'ug_name')
        ->Orderby('ug_name', 'asc')
        ->get();

        $sel_statuses = DB::table('psi_project_status')
                            ->select('prj_status_id', 'prj_status_name')
                            ->Orderby('prj_status_name', 'asc')
                            ->get();
        
        $sel_sectors = DB::table('psi_sectors')
        ->select('sector_id', 'sector_name')
        ->Orderby('sector_name', 'asc')
        ->get();

        $sel_provinces = DB::table('psi_provinces')
                            ->select('province_id', 'province_name')
                            ->Orderby('province_name', 'asc')
                            ->get();

        $proj_lead = DB::table('psi_agencies')
                            ->where('agency_id', 1)
                            ->value('agency_name');
        
        $sel_coordinators = DB::table('vwpsi_users')
                            ->select('u_name')
                            ->where('u_coordinator', 1)
                            ->get();

        $sel_heads = DB::table('vwpsi_users')
                            ->select('u_name')
                            ->where('u_head', 1)
                            ->get();
               
        return view('./projects/addproject', compact('sel_types', 'sel_collaborators', 'sel_benefeciaries', 'sel_usergroups', 'sel_statuses', 'sel_sectors', 'sel_provinces', 'proj_lead', 'sel_coordinators', 'sel_heads'));    }

    public function getCities($id)
    {

        $cities = City::where('province_id', $id)->pluck("city_name","city_id");
        return json_encode($cities);
        
    }

    public function getBarangays($id)
    {

        $barangays = Barangay::where('city_id', $id)->pluck("barangay_name","barangay_id");
        return json_encode($barangays);
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // $request->validate([
        //     // 'prj_title' => 'required',
        //     // 'prj_code' => 'required',
        //     // 'prj_year_approved' => 'required',
        //     // 'prj_objective' => 'required',
        //     // 'prj_expected_output' => 'required',
        //     // 'prj_product_line' => 'required',
        //     // 'prj_cost_setup' => 'required',
        //     // 'prj_cost_gia' => 'required',
        //     // 'prj_cost_rollout' => 'required',
        //     // 'prj_cost_benefactor' => 'required',
        //     // 'prj_cost_other' => 'required',
        //     // 'prj_fund_release_date' => 'required',
        //     // 'prj_intervention' => 'required',
        //     // 'prj_longitude' => 'required',
        //     // 'prj_latitude' => 'required',
        //     // 'prj_elevation' => 'required',
        //     // 'prj_type_id' => 'required',
        //     // 'prj_status_id' => 'required',
        //     // 'prj_remarks' => 'required',
        //     // 'ru_id' => 'required',
        //     // 'province_id' => 'required',
        //     // 'city_id' => 'required',
        //     // 'barangay_id' => 'required',
        //     // 'ug_id' => 'required',
        //     // 'encoder' => 'required',
        //     // 'date_encoded' => 'required',
        //     // 'updater' => 'required',
        //     // 'last_updated' => 'required',
        //     // 'prj_refund_period_from' => 'required',
        //     // 'prj_refund_period_to' => 'required',
        //     // 'prj_province' => 'required',
        //     // 'prj_city' => 'required',
        //     // 'prj_barangay' => 'required',
        //     // 'prj_address' => 'required',
        //     // 'sector_id' => 'required',
        //     // 'prj_pis_total_assets_land' => 'required',
        //     // 'prj_pis_total_assets_building' => 'required',
        //     // 'prj_pis_total_assets_equipment' => 'required',
        //     // 'prj_pis_total_assets_working_capital' => 'required',
        //     // 'prj_pis_total_employment' => 'required',
        //     // 'prj_pis_dir_ch_regular_male' => 'required',
        //     // 'prj_pis_dir_ch_regular_female' => 'required',
        //     // 'prj_pis_dir_ch_regular_pwd' => 'required',
        //     // 'prj_pis_dir_ch_regular_senior' => 'required',
        //     // 'prj_pis_dir_ch_part_time_male' => 'required',
        //     // 'prj_pis_dir_ch_part_time_female' => 'required',
        //     // 'prj_pis_dir_ch_part_time_pwd' => 'required',
        //     // 'prj_pis_dir_ch_part_time_senior' => 'required',
        //     // 'prj_pis_dir_sh_regular_male' => 'required',
        //     // 'prj_pis_dir_sh_regular_female' => 'required',
        //     // 'prj_pis_dir_sh_regular_pwd' => 'required',
        //     // 'prj_pis_dir_sh_regular_senior' => 'required',
        //     // 'prj_pis_dir_sh_part_time_male' => 'required',
        //     // 'prj_pis_dir_sh_part_time_female' => 'required',
        //     // 'prj_pis_dir_sh_part_time_pwd' => 'required',
        //     // 'prj_pis_dir_sh_part_time_senior' => 'required',
        //     // 'prj_pis_indir_backward_male' => 'required',
        //     // 'prj_pis_indir_backward_female' => 'required',
        //     // 'prj_pis_indir_backward_pwd' => 'required',
        //     // 'prj_pis_indir_backward_senior' => 'required',
        //     // 'prj_pis_indir_forward_male' => 'required',
        //     // 'prj_pis_indir_forward_female' => 'required',
        //     // 'prj_pis_indir_forward_pwd' => 'required',
        //     // 'prj_pis_indir_forward_senior' => 'required',
        //     // 'prj_pis_volume_production_local' => 'required',
        //     // 'prj_pis_volume_production_export' => 'required',
        //     // 'prj_pis_gross_sales_local' => 'required',
        //     // 'prj_pis_gross_sales_export' => 'required',
        //     // 'prj_pis_countries_of_destination' => 'required',
        //     // 'prj_pis_assistance_process' => 'required',
        //     // 'prj_pis_assistance_equipment' => 'required',
        //     // 'prj_pis_assistance_quality_control' => 'required',
        //     // 'prj_pis_assistance_packaging_labeling' => 'required',
        //     // 'prj_pis_assistance_post_harvest' => 'required',
        //     // 'prj_pis_assistance_marketing' => 'required',
        //     // 'prj_pis_assistance_training' => 'required',
        //     // 'prj_pis_assistance_consultancy' => 'required',
        //     // 'prj_pis_assistance_others' => 'required',
        //     // 'prj_pis_remarks' => 'required',
        //     // 'prj_pis_assistance_conceptualization' => 'required',
        //     // 'prj_pis_assistance_proposal_preparation' => 'required',
        //     // 'prj_cost_benefactor_desc' => 'required',
        //     // 'prj_fundingsource_local' => 'required',
        //     // 'prj_fundingsource_external' => 'required',
        //     // 'prj_duration_from' => 'required',
        //     // 'prj_duration_to' => 'required',
        //     // 'prj_startup_assistance' => 'required',
        //     // 'prj_cofunded_nga' => 'required',
        //     // 'prj_cofunded_lgu' => 'required',
        //     // 'prj_cost_nga' => 'required',
        //     // 'prj_cost_lgu' => 'required',
        //     // 'prj_cost_local' => 'required',
        //     // 'prj_cost_external' => 'required',
        //     // 'region_id' => 'required',
        //     // 'synched' => 'required',
        //     // 'sync_date' => 'required',
        //     // 'prj_drrm' => 'required',
        //     // 'prj_type_name' => 'required',
        //     // 'prj_status_name' => 'required',
        //     // 'sector_name' => 'required',
        //     // 'province_name' => 'required',
        //     // 'city_name' => 'required',
        //     // 'barangay_name' => 'required',
        //     // 'district_name' => 'required',
        //     // 'ug_name' => 'required',
        //     // 'region_code' => 'required',
        //     // 'region_name' => 'required',
        //     // 'region_text' => 'required',
        //     // 'coop_names' => 'required',
        //     // 'collaborator_names' => 'required',
        //     // 'rep_total_paid' => 'required',
        //     // 'rep_total_due' => 'required',
        //     // 'rep_refund_rate' => 'required',
        //     // 'rep_total_amount' => 'required',
        //     // 'prj_program' => 'required',
        //     // 'prj_lead' => 'required',
        //     // 'prj_agency' => 'required',
        //     // 'prj_coordinator' => 'required',
        //     // 'prj_head' => 'required'
        // ]);
        //$projects = psi_projects::create($request->all());
        $projects = new PsiProject;
        $projects->prj_code = $request->prj_code;

        $projects->prj_type_id = $request->prj_type_id;
        $get_type_name = DB::table('psi_project_types')->where('prj_type_id', $request->prj_type_id)->value('prj_type_name');
        $projects->prj_type_name = $get_type_name;

        $projects->prj_startup_assistance = $request->prj_startup_assistance;
        $projects->prj_drrm = $request->prj_drrm;
        $projects->prj_title = $request->prj_title;
        $projects->prj_program = $request->prj_program;
        $projects->prj_duration_from = $request->prj_duration_from;
        $projects->prj_duration_to = $request->prj_duration_to;
        $projects->prj_lead = $request->prj_lead;
        $projects->prj_agency = $request->prj_agency;
        $projects->prj_coordinator = $request->prj_coordinator;
        $projects->prj_head = $request->prj_head;
        
        $projects->ug_id = $request->ug_id;
        $get_ug_name = DB::table('psi_usergroups')->where('ug_id', $request->ug_id)->value('ug_name');
        $projects->ug_name = $get_ug_name;

        $projects->prj_objective = $request->prj_objective;
        $projects->prj_expected_output = $request->prj_expected_output;
        $projects->prj_fund_release_date = $request->prj_fund_release_date;

        $projects->prj_status_id = $request->prj_status_id;
        $get_status_name = DB::table('psi_project_status')->where('prj_status_id', $request->prj_status_id)->value('prj_status_name');
        $projects->prj_status_name = $get_status_name;
        
        $projects->sector_id = $request->sector_id;
        $get_sector_name = DB::table('psi_sectors')->where('sector_id', $request->sector_id)->value('sector_name');
        $projects->sector_name = $get_sector_name;

        $projects->prj_address = $request->prj_address;
        
        $projects->province_id = $request->province_id;
        $get_province_name = DB::table('psi_provinces')->where('province_id', $request->province_id)->value('province_name');
        $projects->province_name = $get_province_name;

        $get_region_id = DB::table('psi_provinces')->where('province_id', $request->province_id)->pluck('region_id');
        $get_region_name = DB::table('psi_regions')->where('region_id', $get_region_id)->value('region_name');
        $get_region_code = DB::table('psi_regions')->where('region_id', $get_region_id)->value('region_code');
        $projects->region_name = $get_region_name;
        $projects->region_code = $get_region_code;

        $projects->city_id = $request->city_id;
        $city = City::find($request->city_id);
        // $get_city_name = DB::table('psi_cities')->where('city_id', $request->city_id)->value('city_name');
        $projects->city_name = $city->city_name;
        
        $projects->barangay_id = $request->barangay_id;
        $get_barangay_name = DB::table('psi_barangays')->where('barangay_id', $request->barangay_id)->value('barangay_name');
        $projects->barangay_name = $get_barangay_name;

        $get_district_id = DB::table('psi_cities')->where('city_id', $request->city_id)->pluck('district_id');
        $get_district_name = DB::table('psi_districts')->where('district_id', $get_district_id)->value('district_name');
        $projects->district_name = $get_district_name;
            
        $projects->prj_cost_setup = $request->prj_cost_setup;
        $projects->prj_cost_benefactor_desc = $request->prj_cost_benefactor_desc;
        $projects->prj_cost_benefactor = $request->prj_cost_benefactor;
        $projects->prj_cost_other = $request->prj_cost_other;

        //*query
        //textbox 
        $projects->prj_fundingsource_local = $request->prj_fundingsource_local;
        $projects->prj_cost_local = $request->prj_cost_local;

        //textbox
        $projects->prj_fundingsource_external = $request->prj_fundingsource_external;
        $projects->prj_cost_external = $request->prj_cost_external;
        
        //textbox
        $projects->prj_cofunded_nga = $request->prj_cofunded_nga;
        $projects->prj_cost_nga = $request->prj_cost_nga;

        //textbox
        $projects->prj_cofunded_lgu = $request->prj_cofunded_lgu;
        $projects->prj_cost_lgu = $request->prj_cost_lgu;

        $projects->prj_pis_total_assets_land = $request->prj_pis_total_assets_land;
        $projects->prj_pis_total_assets_building = $request->prj_pis_total_assets_land;
        $projects->prj_pis_total_assets_equipment = $request->prj_pis_total_assets_land;
        $projects->prj_pis_total_assets_working_capital = $request->prj_pis_total_assets_land;

        $projects->prj_pis_dir_ch_regular_male = $request->prj_pis_dir_ch_regular_male;
        $projects->prj_pis_dir_ch_regular_female = $request->prj_pis_dir_ch_regular_female;
        $projects->prj_pis_dir_ch_regular_pwd = $request->prj_pis_dir_ch_regular_pwd;
        $projects->prj_pis_dir_ch_regular_senior = $request->prj_pis_dir_ch_regular_senior;

        $projects->prj_pis_dir_ch_part_time_male = $request->prj_pis_dir_ch_part_time_male;
        $projects->prj_pis_dir_ch_part_time_female = $request->prj_pis_dir_ch_part_time_female;
        $projects->prj_pis_dir_ch_part_time_pwd = $request->prj_pis_dir_ch_part_time_pwd;
        $projects->prj_pis_dir_ch_part_time_senior = $request->prj_pis_dir_ch_part_time_senior;

        $projects->prj_pis_dir_sh_regular_male = $request->prj_pis_dir_sh_regular_male;
        $projects->prj_pis_dir_sh_regular_female = $request->prj_pis_dir_sh_regular_female;
        $projects->prj_pis_dir_sh_regular_pwd = $request->prj_pis_dir_sh_regular_pwd;
        $projects->prj_pis_dir_sh_regular_senior = $request->prj_pis_dir_sh_regular_senior;

        $projects->prj_pis_dir_sh_part_time_male = $request->prj_pis_dir_sh_part_time_male;
        $projects->prj_pis_dir_sh_part_time_female = $request->prj_pis_dir_sh_part_time_female;
        $projects->prj_pis_dir_sh_part_time_pwd = $request->prj_pis_dir_sh_part_time_pwd;
        $projects->prj_pis_dir_sh_part_time_senior = $request->prj_pis_dir_sh_part_time_senior;

        $projects->prj_pis_indir_forward_male = $request->prj_pis_indir_forward_male;
        $projects->prj_pis_indir_forward_female = $request->prj_pis_indir_forward_female;
        $projects->prj_pis_indir_forward_pwd = $request->prj_pis_indir_forward_pwd;
        $projects->prj_pis_indir_forward_senior = $request->prj_pis_indir_forward_senior;

        $projects->prj_pis_indir_backward_male = $request->prj_pis_indir_backward_male;
        $projects->prj_pis_indir_backward_female = $request->prj_pis_indir_backward_female;
        $projects->prj_pis_indir_backward_pwd = $request->prj_pis_indir_backward_pwd;
        $projects->prj_pis_indir_backward_senior = $request->prj_pis_indir_backward_senior;

        $projects->prj_pis_volume_production_local = $request->prj_pis_volume_production_local;
        $projects->prj_pis_volume_production_export = $request->prj_pis_volume_production_export;

        $projects->prj_pis_gross_sales_local = $request->prj_pis_gross_sales_local;
        $projects->prj_pis_gross_sales_export = $request->prj_pis_gross_sales_export;

        $projects->prj_pis_countries_of_destination = $request->prj_pis_countries_of_destination;

        $projects->prj_pis_assistance_conceptualization = $request->prj_pis_assistance_conceptualization;
        $projects->prj_pis_assistance_proposal_preparation = $request->prj_pis_assistance_proposal_preparation;

        $projects->prj_pis_assistance_process = $request->prj_pis_assistance_process;
        $projects->prj_pis_assistance_equipment = $request->prj_pis_assistance_equipment;
        $projects->prj_pis_assistance_quality_control = $request->prj_pis_assistance_quality_control;

        $projects->prj_pis_assistance_packaging_labeling = $request->prj_pis_assistance_packaging_labeling;
        $projects->prj_pis_assistance_post_harvest = $request->prj_pis_assistance_post_harvest;
        $projects->prj_pis_assistance_marketing = $request->prj_pis_assistance_marketing;
        $projects->prj_pis_assistance_training = $request->prj_pis_assistance_training;
        $projects->prj_pis_assistance_consultancy = $request->prj_pis_assistance_consultancy;
        $projects->prj_pis_assistance_others = $request->prj_pis_assistance_others;

        $projects->prj_remarks = $request->prj_remarks;

        $projects->prj_longitude = $request->prj_longitude;
        $projects->prj_latitude = $request->prj_latitude;
        $projects->prj_elevation = $request->prj_elevation;

        $projects->save();
        $last_id = $projects->prj_id;
        


        //save coop-colab to database
        $get_coop_name = $request->coop_id;
        $get_coop_count = count($get_coop_name);
        $coop_ids = array();

        if($get_coop_count>0){
            for($i=0; $i<$get_coop_count; $i++){
                $coop_id = ['prj_id' => $last_id,
                            'coop_id' => $get_coop_name[$i]
                        ];
                $coop_ids[] = $coop_id;

            }
            ProjectBeneficiary::insert($coop_ids);
            //DB::table('psi_project_beneficiaries')->insert($coop_ids);
        }
        //
        //save col-colab to database
        $get_col_name = $request->col_id;
        $get_col_count = count($get_col_name);
        $col_ids = array();

        if($get_col_count>0){
            for($y=0; $y<$get_col_count; $y++){
                $col_id = ['prj_id' => $last_id,
                            'col_id' => $get_col_name[$y]
                ];
            $col_ids[] = $col_id;
            }
            ProjectCollaborator::insert($col_ids);
            //DB::table('psi_project_collaborators')->insert($col_ids);
        }
        //



        //TO SAVE ALL COOPERATORS IN PSI_PROJECTS
        $get_coop_id = DB::table('psi_project_beneficiaries')->where('prj_id', $last_id)->pluck('coop_id');
        $link_coop_ids = DB::table('psi_cooperators')->whereIN('coop_id', $get_coop_id)->get();
        $rescoop ='';
        foreach($link_coop_ids as $link_coop_id){
            $coop_name = DB::table('psi_cooperators')->where('coop_id', $link_coop_id->coop_id)->value('coop_name');
            if(strlen($rescoop)>0){
                $rescoop.=', ';
            }
            $rescoop.=$coop_name;
        }
        DB::table('psi_projects')->where('prj_id', $last_id)->update(['coop_names'=>$rescoop]);
        //

        //TO SAVE ALL COLLABORATION IN PSI_PROJECTS
        $get_col_id = DB::table('psi_project_collaborators')->where('prj_id', $last_id)->pluck('col_id');
        $link_col_ids = DB::table('psi_collaborators')->whereIN('col_id', $get_col_id)->get();
        $rescol ='';
        foreach($link_col_ids as $link_col_id){
            $col_name = DB::table('psi_collaborators')->where('col_id', $link_col_id->col_id)->value('col_name');
            if(strlen($rescol)>0){
                $rescol.=', ';
            }
            $rescol.=$col_name;
        }
        DB::table('psi_projects')->where('prj_id', $last_id)->update(['collaborator_names'=>$rescol]);
        //
        
        
        
        



        return redirect()->route('projects')
        ->with('success', 'Project created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewproject($id)
    {
        $project_views = DB::table('psi_projects')->where('prj_id', $id)->get();
        $get_prj_id = PsiProject::find($id);
        $prj_title = DB::table('psi_project_types')->where('prj_type_id', $get_prj_id->prj_type_id)->value("prj_type_name");    
        $get_benefeciaries = DB::table('vwpsi_project_beneficiaries')->where('prj_id', $id)->get();
        $get_sector_name = DB::table('psi_sectors')->where('sector_id', $get_prj_id->sector_id)->value("sector_name");
        $get_status_name = DB::table('psi_project_status')->where('prj_status_id', $get_prj_id->prj_status_id)->value("prj_status_name");
        $get_ug_name = DB::table('psi_usergroups')->where('ug_id', $get_prj_id->ug_id)->value("ug_name");
        



        return view('/projects/projectview', compact('project_views', 'prj_title', 'get_benefeciaries','get_sector_name', 'get_status_name', 'get_ug_name'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        
    }
}
