<?php

namespace App\Http\Controllers;
use App\psi_projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class PsiProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $psi_projects = psi_projects::paginate(20);
        $psi_total_projects = count(psi_projects::all());
        
        //Option Values
        $sel_project_types = DB::table('psi_project_types')
                            ->select('prj_type_id', 'prj_type_name')
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

        $sel_provinces = DB::table('psi_provinces')
        ->select('province_id', 'province_name')
        ->Orderby('province_name', 'asc')
        ->get();
               
        return view('./projects/addproject', compact('sel_types', 'sel_collaborators', 'sel_benefeciaries', 'sel_usergroups', 'sel_statuses', 'sel_sectors', 'sel_provinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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