<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\PsiProject;
use Illuminate\Http\Request;
use App\Models\ProjectProgress;
use App\Models\ProjectProgressTarget;

class ProjectProgressController extends Controller
{
    public function index(Request $request, $id)
    {
        $project = PsiProject::FindorFail($id);

        $progress = ProjectProgress::where('prj_id', $id)->paginate(20);

        return view('./projects/details/Monitoring2/Progress/index', compact('project', 'progress'))->with('i', ($request->input('page', 1) - 1) * 20);
    }

    public function new(Request $request, $id)
    {
        {   
            $project        =   PsiProject::FindorFail($id);
            $targets        =   ProjectProgressTarget::where('prj_id', $id)->get();
            $prog_id         =   0;
            
            $progress = new ProjectProgress;

            return view('./projects/details/Monitoring2/Progress/form', compact('project', 'progress', 'id', 'prog_id', 'targets'))->with('i', ($request->input('page', 1) - 1) * 20);;
        } 
    }

    public function store(Request $request, $id, $prog_id)
    {
        $start_time       =   $request->request->get('prog_start');
        $end_time         =   $request->request->get('prog_end');

        $start_year       =   Carbon::createFromFormat('m-Y', $start_time)->year;
        $start_month      =   Carbon::createFromFormat('m-Y', $start_time)->month;
        $end_year         =   Carbon::createFromFormat('m-Y', $end_time)->year;
        $end_month        =   Carbon::createFromFormat('m-Y', $end_time)->month;

        

       


        if($prog_id == 0) {
            $alert 					= 'alert-success';
			$message				= 'New Project Progress Reports record successfully added.';

            $request->request->add(['prj_id' => $id]);
            $request->request->add(['prjprogrep_year_from' => $start_year]);
            $request->request->add(['prjprogrep_month_from' => $start_month]);
            $request->request->add(['prjprogrep_year_to' => $end_year]);
            $request->request->add(['prjprogrep_month_to' => $end_month]);

            $progress = ProjectProgress::create($request->all());
            
            
            $urid   =   $request->get('prjprogtarget_id');

        // dd( $urid );

        foreach($urid as $urids){
        
            // $items = new ProjectProgressItem;
            // $usgright_data->ug_id = $lastId;
            // $usgright_data->ur_id = $urids;
        
            // if($request->get('ur'.$urids.'_view')){
            //     $usgright_data->ugr_view = $request->get('ur'.$urids.'_view');
            // }else{
            //     $usgright_data->ugr_view = 0;
            // }
        
            // if($request->get('ur'.$urids.'_add')){
            //     $usgright_data->ugr_add = $request->get('ur'.$urids.'_add');
            // }else{
            //     $usgright_data->ugr_add = 0;
            // }
        
            // if($request->get('ur'.$urids.'_edit')){
            //     $usgright_data->ugr_edit = $request->get('ur'.$urids.'_edit');
            // }else{
            //     $usgright_data->ugr_edit = 0;
            // }
        
            // if($request->get('ur'.$urids.'_delete')){
            //     $usgright_data->ugr_delete = $request->get('ur'.$urids.'_delete');
            // }else{
            //     $usgright_data->ugr_delete = 0;
            // }
        
            // $usgright_data->save();
            }


        // } else {
        //     $alert 			= 'alert-info';
		// 	$message		= 'Project Progress Reports record successfully updated.';
        //     $progress           = ProjectProgress::find($prog_id);
        //     $progress->update($request->all());
        // }

        // return redirect()->route('Progress Reports', $id)->with('message', $message)->with('alert', $alert);
        }
    }
    // public function edit($id, $fr_id)
    // {
    //     $project = PsiProject::FindorFail($id);
    //     $training = Training::Find($fr_id);

    //     $sel_types = ForaType::orderBy('fr_type_id', 'asc')->get();
    //     $sel_collaborators = Collaborator::Orderby('col_name', 'asc')->get();
    //     $sel_suppliers  =   ServiceProvider::OrderBy('sp_name', 'asc')->get();
    //     $sel_implementors = UserGroup::OrderBy('ug_name', 'asc')->get();
    //     $sel_provinces = Province::where('region_id', $project->region_id)->get();
    //     $sel_cities = City::where('province_id', $training->province_id)->get();
    //     $sel_barangays = Barangay::where('city_id', $training->city_id)->get();
        
    //     return view('./projects/details/Training/form', compact('project', 'id', 'fr_id', 'training', 'sel_types', 'sel_collaborators', 'sel_suppliers', 'sel_implementors', 'sel_provinces', 'sel_cities', 'sel_barangays'));    
    // }

    public function delete($id, $prog_id)
	{
		$alert 			= 'alert-warning';
		$message		= 'Project Progress Reports record successfully deleted.';
		$progress       =  ProjectProgress::find($prog_id);
		$progress->delete();

		return redirect()->back()->with('message', $message)->with('alert', $alert);
	}

    // public function view($id, $fr_id)
	// {
	// 	$project    = PsiProject::FindorFail($id);
    //     $training   = Training::Find($fr_id);

	// 	return view('./projects/details/Training/view', compact('project', 'training'));    
	// }

}
