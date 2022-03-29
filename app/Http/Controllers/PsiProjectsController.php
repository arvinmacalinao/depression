<?php

namespace App\Http\Controllers;
use App\psi_projects;
use App\psi_cities;
use App\psi_barangays;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Datatables;



class PsiProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        
        $psi_projects = psi_projects::all();        
       
        $sel_project_types = DB::table('psi_project_types')
                            ->select('prj_type_name')
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
        return view('./projects/projects', compact('psi_projects', 'sel_project_types', 'sel_project_statuses', 'sel_project_years', 'sel_project_provinces', 'sel_project_districts', 'sel_project_sectors', 'sel_project_implementors'));
        
    }

    public function projectList()
    {           
        
        $psi_projects = DB::table('psi_projects')->select('*');
        return datatables()->of($psi_projects)
        //->setRowData([ 'data-prj_cost_setup' => 'Php {{ $prj_cost_setup }}' ])
        // ->setRowClass('{{ $prj_id % 2 == 0 ? "alert-success" : "alert-warning" }}')
        ->addColumn('row', 'row')
        ->make(true);
    }


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

        $cities = psi_cities::where('province_id', $id)->pluck("city_name","city_id");
        return json_encode($cities);
        
    }

    public function getBarangays($id)
    {

        $barangays = psi_barangays::where('city_id', $id)->pluck("barangay_name","barangay_id");
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
        $request->validate ([

        ]); 
        $projects = new psi_projects;
        $projects->prj_code=$request->prj_code;
        $projects->prj_type_id=$request->prj_type_id;
        $get_type_name = DB::table('psi_project_types')->where('prj_type_id', $request->prj_type_id)->value('prj_type_name');
        $projects->prj_type_name=$get_type_name;
        $projects->prj_startup_assistance=$request->prj_startup_assistance;
        $projects->prj_drrm=$request->prj_drrm;
        $projects->prj_title=$request->prj_title;
        $projects->prj_program=$request->prj_program;
        $projects->prj_duration_from=$request->prj_duration_from;
        $projects->prj_duration_to=$request->prj_duration_to;
        $projects->prj_lead=$request->prj_lead;
        $projects->prj_agency=$request->prj_agency;
        $projects->prj_coordinator=$request->prj_coordinator;
        $projects->prj_head=$request->prj_head;
        $projects->ug_id=$request->ug_id;
        $get_ug_name = DB::table('psi_usergroups')->where('ug_id', $request->ug_id)->value('ug_name');
        $projects->prj_type_name=$get_ug_name;
        $projects->prj_objective=$request->prj_objective;
        $projects->prj_expected_output=$request->prj_expected_output;
        $projects->prj_fund_release_date=$request->prj_fund_release_date;

        $projects->prj_status_id=$request->prj_status_id;
        $get_status_name = DB::table('psi_project_status')->where('prj_status_id', $request->prj_status_id)->value('prj_status_name');
        $projects->prj_status_name=$get_status_name;
        
        $get_sector_name = DB::table('psi_sectors')->where('sector_id', $request->sector_id)->value('sector_name');
        $projects->sector_name=$get_sector_name;




        $projects->save();
        $last_id = $projects->id;
        


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
            DB::table('psi_project_beneficiaries')->insert($coop_ids);
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
            DB::table('psi_project_collaborators')->insert($col_ids);
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
        //
    }
}
