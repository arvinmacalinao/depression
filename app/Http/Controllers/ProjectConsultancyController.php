<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Quarter;
use App\Models\PsiProject;
use App\Models\Consultancy;
use Illuminate\Http\Request;
use App\Models\ConsultancyType;
use App\Models\ServiceProvider;
use App\Models\ProjectBeneficiary;

class ProjectConsultancyController extends Controller
{
    public function index(Request $request, $id)
    {
        $project = PsiProject::FindorFail($id);

        $con_cat = $request->get('qcat');
        $con_year = $request->get('qyear');
        // $con_qtr = $request->get('qqtr');

        $sel_category = ConsultancyType::orderBy('con_type_id', 'asc')->get();
        $sel_years = Consultancy::groupBy('con_end_yr')->orderBy('con_end_yr', 'asc')->get();
        $sel_quarters = Quarter::orderBy('quarter_id', 'asc')->get();

        $consultancies = Consultancy::where('prj_id', $id)->ConCat($con_cat)->ConYear($con_year)->get();

        return view('./projects/details/Consultancy/index', compact('project', 'consultancies', 'sel_category', 'sel_years', 'sel_quarters'));
    }

    public function new($id)
    {
        {   
            $project        =   PsiProject::FindorFail($id);
            $con_id         =   0;
            
            $sel_suppliers  =   ServiceProvider::OrderBy('sp_name', 'asc')->get();
            $sel_categories =   ConsultancyType::orderBy('con_type_id', 'asc')->get();
            
            $consultancy = new Consultancy;

            return view('./projects/details/Consultancy/form', compact('project', 'consultancy', 'id', 'con_id', 'sel_suppliers', 'sel_categories'));    
        } 
    }

    public function store(Request $request, $id, $con_id)
    {
        $start_time       =   $request->request->get('con_start');
        $end_time         =   $request->request->get('con_end');

        $start_year       =   Carbon::createFromFormat('Y-m-d', $start_time)->year;
        $start_month      =   Carbon::createFromFormat('Y-m-d', $start_time)->month;
        
        $end_year         =   Carbon::createFromFormat('Y-m-d', $end_time)->year;
        $end_month        =   Carbon::createFromFormat('Y-m-d', $end_time)->month;

        $projectdetails   =   PsiProject::FindorFail($id);
        $coops            =   ProjectBeneficiary::where('prj_id', $id)->get();
        $con_name         =   ConsultancyType::where('con_type_id', $request->con_type_id)->value('con_type_name');
        $sp_name          =   ServiceProvider::where('sp_id', $request->sp_id)->value('sp_name');

        $rescoop = '';
        if(strlen($coops) == 0){
            $request->request->add(['coop_name' => NULL]);
        }
        else{
            foreach($coops as $coop){
               $coop_names = $coop->cooperator->coop_name;
                if(strlen($rescoop)>0){
                    $rescoop.=', ';
                }
               $rescoop.=$coop_names;
            }
            $request->request->add(['coop_name' => $rescoop]);
        }
        
        if($con_id == 0) {

            $alert 					= 'alert-success';
			$message				= 'New Consultancy record successfully added.';

            if($projectdetails->barangay_id == 0){
                $request->request->add(['barangay_id' => NULL]);
                $request->request->add(['barangay_name' => NULL]);
            }
            else{
                $request->request->add(['barangay_id' => $projectdetails->barangay_id]);
                $request->request->add(['barangay_name' => $projectdetails->barangay->barangay_name]);
            }

            if($projectdetails->province_id == 0){
                $request->request->add(['province_id' => NULL]);
                $request->request->add(['province_name' => NULL]);
            }
            else{
                $request->request->add(['province_id' => $projectdetails->province_id]);
                $request->request->add(['province_name' => $projectdetails->province->province_name]);
            }

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
            
            
            $request->request->add(['con_start_yr' => $start_year]);
            $request->request->add(['con_start_mo' => $start_month]);
            $request->request->add(['con_end_yr' => $end_year]);
            $request->request->add(['con_end_mo' => $end_month]);


            $request->request->add(['sp_name' => $sp_name]);
            $request->request->add(['con_type_name' => $con_name]);
            $request->request->add(['ug_id' => $projectdetails->ug_id]);
            $request->request->add(['ug_name' => $projectdetails->usergroup->ug_name]);
            $request->request->add(['region_name' => $projectdetails->region->region_name]);
            $request->request->add(['prj_title' => $projectdetails->prj_title]);
            $request->request->add(['prj_code' => $projectdetails->prj_code]);
            $request->request->add(['prj_year_approved' => $projectdetails->prj_year_approved]);
            $request->request->add(['prj_id' => $id]);
            $consultancy = Consultancy::create($request->all());

        } else {
            $alert 					= 'alert-info';
			$message				= 'Consultancy record successfully updated.';
            $consultancy = Consultancy::find($con_id);
            $consultancy->update($request->all());
        }

        return redirect()->route('Consultancy', $id)->with('message', $message)->with('alert', $alert);
    }

    public function edit($id, $con_id)
    {
        $project = PsiProject::FindorFail($id);
        $consultancy = Consultancy::Find($con_id);
        
        $sel_suppliers = ServiceProvider::OrderBy('sp_name', 'asc')->get();
        $sel_categories = ConsultancyType::orderBy('con_type_id', 'asc')->get();

        return view('./projects/details/Consultancy/form', compact('project', 'id', 'con_id', 'consultancy', 'sel_suppliers', 'sel_categories'));    
    }

    public function delete($id, $con_id)
	{
		$alert 					= 'alert-warning';
		$message				= 'Consultancy successfully deleted.';
		$consultancy = Consultancy::find($con_id);
		$consultancy->delete();

		return redirect()->back()->with('message', $message)->with('alert', $alert);
	}
}
