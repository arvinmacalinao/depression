<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Quarter;
use App\Models\Barangay;
use App\Models\District;
use App\Models\ForaType;
use App\Models\Province;
use App\Models\Training;
use App\Models\UserGroup;
use App\Models\PsiProject;
use App\Models\Collaborator;
use Illuminate\Http\Request;
use App\Models\ServiceProvider;
use App\Models\ForaCollaborator;


class ProjectTrainingController extends Controller
{
    public function index(Request $request, $id)
    {
        $project = PsiProject::FindorFail($id);

        $fora_type = $request->get('qtype');
        $fora_year = $request->get('qyear');
        $fora_qtr = $request->get('qqtr');

        $sel_types = ForaType::orderBy('fr_type_id', 'asc')->get();
        $sel_years = Training::groupBy('fr_end_yr')->orderBy('fr_end_yr', 'asc')->get();
        $sel_quarters = Quarter::orderBy('quarter_id', 'asc')->get();
        $trainings = Training::where('prj_id', $id)->ForaType($fora_type)->ForaYear($fora_year)->paginate(20);

        

        return view('./projects/details/Training/index', compact('project', 'trainings', 'sel_types', 'sel_quarters', 'sel_years'));
    }
    public function new($id)
    {
        {   
            $project        =   PsiProject::FindorFail($id);
            $fr_id         =   0;
            
            $sel_types = ForaType::orderBy('fr_type_id', 'asc')->get();
            $sel_collaborators = Collaborator::Orderby('col_name', 'asc')->get();
            $sel_suppliers  =   ServiceProvider::OrderBy('sp_name', 'asc')->get();
            $sel_implementors = UserGroup::OrderBy('ug_name', 'asc')->get();
            $sel_provinces = Province::where('region_id', $project->region_id)->get();
            
            $training = new Training;

            return view('./projects/details/Training/form', compact('project', 'training', 'id', 'fr_id', 'sel_types', 'sel_collaborators', 'sel_suppliers', 'sel_implementors', 'sel_provinces'));
        } 
    }

    public function store(Request $request, $id, $fr_id)
    {
        $training = new Training;

        $now              =   Carbon::now();
        $projectdetails   =   PsiProject::FindorFail($id);
        // $coops            =   ProjectBeneficiary::where('prj_id', $id)->get();
        $sp_name          =   ServiceProvider::where('sp_id', $request->sp_id)->value('sp_name');
        $fora_type_name   =   ForaType::where('fr_type_id', $request->fr_type_id)->value('fr_type_name');
        $get_district_id  =   City::where('city_id', $request->get('city_id'))->value('district_id');

        $start_time       =   $request->request->get('fr_start');
        $end_time         =   $request->request->get('fr_end');
        
        $start_year       =   Carbon::createFromFormat('Y-m-d H:i:s', $start_time)->year;
        $start_month      =   Carbon::createFromFormat('Y-m-d H:i:s', $start_time)->month;
        $end_year         =   Carbon::createFromFormat('Y-m-d H:i:s', $end_time)->year;
        $end_month        =   Carbon::createFromFormat('Y-m-d H:i:s', $end_time)->month;
        
        

        if($fr_id == 0) {
            $alert 					= 'alert-success';
			$message				= 'New Training record successfully added.';

            $request->request->add(['fr_start_yr' => $start_year]);
            $request->request->add(['fr_start_mo' => $start_month]);
            $request->request->add(['fr_end_yr' => $end_year]);
            $request->request->add(['fr_end_mo' => $end_month]);
            
            if($request->has('barangay_id')){
                $request->request->get('barangay_id');
                $request->request->add(['barangay_name' => Barangay::where('barangay_id', $request->get('barangay_id'))->value('barangay_name')]);
            }
            else{
                if($projectdetails->barangay_id == 0){
                    $request->request->add(['barangay_id' => NULL]);
                    $request->request->add(['barangay_name' => NULL]);
                }
                else{
                    $request->request->add(['barangay_id' => $projectdetails->barangay_id]);
                    $request->request->add(['barangay_name' => $projectdetails->barangay->barangay_name]);
                }
            }
            
            if($request->has('province_id')){
                $request->request->get('province_id');
                $request->request->add(['province_name' => Province::where('province_id', $request->get('province_id'))->value('province_name')]);
            }
            else{
                if($projectdetails->province_id == 0){
                    $request->request->add(['province_id' => NULL]);
                    $request->request->add(['province_name' => NULL]);
                }
                else{
                    $request->request->add(['province_id' => $projectdetails->province_id]);
                    $request->request->add(['province_name' => $projectdetails->province->province_name]);
                }
            }
            if($request->has('city_id')){
                $request->request->get('city_id');
                $request->request->add(['city_name' => City::where('city_id', $request->get('city_id'))->value('city_name')]);
                $request->request->add(['district_id' => $get_district_id]);
                $request->request->add(['district_name' => District::where('district_id', $get_district_id)->value('district_name')]);
            }
            else{
                if($projectdetails->city_id == 0){
                    $request->request->add(['city_id' => NULL]);
                    $request->request->add(['city_name' => NULL]);
                    $request->request->add(['district_id' => NULL]);
                    $request->request->add(['district_name' => NULL]);
                }
                else{
                    $request->request->add(['city_id' => $projectdetails->city_id]);
                    $request->request->add(['city_name' => $projectdetails->city->city_name]);
                    $request->request->add(['district_id' => $projectdetails->city->district_id]);
                    $request->request->add(['district_name' => $projectdetails->city->district->district_name]);
                }
            }
        
            $request->request->add(['fr_type_name' => $fora_type_name]);
            $request->request->add(['ug_id' => $projectdetails->ug_id]);
            $request->request->add(['ug_name' => $projectdetails->usergroup->ug_name]);
            $request->request->add(['region_name' => $projectdetails->region->region_name]);
            $request->request->add(['prj_title' => $projectdetails->prj_title]);
            $request->request->add(['prj_code' => $projectdetails->prj_code]);
            $request->request->add(['prj_year_approved' => $projectdetails->prj_year_approved]);
            $request->request->add(['prj_id' => $id]);
            $training = Training::create($request->all());
            $training->ForaCollaborator()->attach($request->get('collaborators'), ['date_encoded'=> Carbon::now()]);



            $last_id = $training->fr_id;
            
            //Save collaborators in fora collaborators table
            // if($request->has('collaborators')) {
            //     foreach($request->get('collaborators') as $col_id) {
            //         ForaCollaborator::create(['fr_id' => $last_id, 'col_id' => $col_id, 'fcol_timestamp' => $now]);
            //     }
            // }

            //Save collaboration names
            $get_col_id = ForaCollaborator::where('fr_id', $last_id)->pluck('col_id');
            $link_col_ids = Collaborator::whereIN('col_id', $get_col_id)->get();
            $rescol ='';
            foreach($link_col_ids as $link_col_id){
                $col_name = Collaborator::where('col_id', $link_col_id->col_id)->value('col_name');
                if(strlen($rescol)>0){
                    $rescol.=', ';
                }
                $rescol.=$col_name;
            }
            Training::where('fr_id', $last_id)->update(['collaborator_names' => $rescol]);

        } else {
            $alert 					= 'alert-info';
			$message				= 'Training record successfully updated.';
            $training = Training::find($fr_id);
            $training->update($request->all());
            $training->ForaCollaborator()->sync($request->get('collaborators'), ['date_encoded'=> Carbon::now()]);

            $get_col_id = ForaCollaborator::where('fr_id', $fr_id)->pluck('col_id');
            $link_col_ids = Collaborator::whereIN('col_id', $get_col_id)->get();
            $rescol ='';
            foreach($link_col_ids as $link_col_id){
                $col_name = Collaborator::where('col_id', $link_col_id->col_id)->value('col_name');
                if(strlen($rescol)>0){
                    $rescol.=', ';
                }
                $rescol.=$col_name;
            }
            Training::where('fr_id', $fr_id)->update(['collaborator_names' => $rescol]);
        }

        return redirect()->route('Training', $id)->with('message', $message)->with('alert', $alert);
    }

    public function edit($id, $fr_id)
    {
        $project = PsiProject::FindorFail($id);
        $training = Training::Find($fr_id);

        $sel_types = ForaType::orderBy('fr_type_id', 'asc')->get();
        $sel_collaborators = Collaborator::Orderby('col_name', 'asc')->get();
        $sel_suppliers  =   ServiceProvider::OrderBy('sp_name', 'asc')->get();
        $sel_implementors = UserGroup::OrderBy('ug_name', 'asc')->get();
        $sel_provinces = Province::where('region_id', $project->region_id)->get();
        $sel_cities = City::where('province_id', $training->province_id)->get();
        $sel_barangays = Barangay::where('city_id', $training->city_id)->get();
        
        return view('./projects/details/Training/form', compact('project', 'id', 'fr_id', 'training', 'sel_types', 'sel_collaborators', 'sel_suppliers', 'sel_implementors', 'sel_provinces', 'sel_cities', 'sel_barangays'));    
    }

    public function delete($id, $fr_id)
	{
		$alert 			= 'alert-warning';
		$message		= 'Training record successfully deleted.';
		$training       = Training::find($fr_id);
		$training->delete();

		return redirect()->back()->with('message', $message)->with('alert', $alert);
	}

    public function view($id, $fr_id)
	{
		$project    = PsiProject::FindorFail($id);
        $training   = Training::Find($fr_id);

		return view('./projects/details/Training/view', compact('project', 'training'));    
	}
}
