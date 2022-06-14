<?php

namespace App\Http\Controllers;

use App\Models\Month;
use App\Models\UserGroup;
use App\Models\Laboratory;
use App\Models\PsiProject;
use App\Models\Calibration;
use Illuminate\Http\Request;

class ProjectCalibrationController extends Controller
{
    public function index(Request $request, $id)
    {
        $project = PsiProject::FindorFail($id);

        //filter
        $cal_lab = $request->get('qlab');
        $cal_imp = $request->get('qimp');
        $cal_year = $request->get('qyear');

        $sel_labs = Laboratory::Orderby('lab_abbr', 'asc')->get();
        $sel_ugs = UserGroup::Orderby('ug_name', 'asc')->get();
        $sel_years = Calibration::GroupBy('cal_year')->get();
    
        $calibrations = Calibration::where('prj_id', $id)->Orderby('date_encoded', 'desc')->CalLab($cal_lab)->CalImp($cal_imp)->CalYear($cal_year)->get();

        //->EqBrand($eq_brand)->EqSearch($eq_search)
        return view('./projects/details/Calibration/index', compact('project', 'calibrations', 'sel_labs', 'sel_ugs', 'sel_years'));
    }

    public function new($id)
    {
        {   
            $project = PsiProject::FindorFail($id);
            $cal_id = 0;
            
            $sel_labs = Laboratory::Orderby('lab_abbr', 'asc')->get();
            $sel_ugs = UserGroup::Orderby('ug_name', 'asc')->get();
            $sel_months = Month::Orderby('cal_month', 'asc')->get();
            // $sel_improvements = Improvement::get();
            // $sel_suppliers = ServiceProvider::OrderBy('sp_name', 'asc')->get();

            $calibration = new Calibration;
            return view('./projects/details/Calibration/form', compact('project', 'id', 'cal_id', 'calibration', 'sel_ugs', 'sel_labs', 'sel_months'));    
        } 
    }
    
    public function store(Request $request, $id, $cal_id)
    {
        
        if($cal_id == 0) {
            $alert 					= 'alert-success';
			$message				= 'New Testing & Calibration record successfully added.';
            $request->request->add(['prj_id' => $id]);
            $calibration = Calibration::create($request->all());

        } else {
            $alert 					= 'alert-info';
			$message				= 'Testing & Calibration record successfully updated.';
            $calibration = Calibration::find($cal_id);
            $calibration->update($request->all());
        }

        return redirect()->route('Calibration', $id)->with('message', $message)->with('alert', $alert);
    }

    public function edit($id, $cal_id)
    {
        $project = PsiProject::FindorFail($id);
        $calibration = Calibration::Find($cal_id);
        
        $sel_labs = Laboratory::Orderby('lab_abbr', 'asc')->get();
        $sel_ugs = UserGroup::Orderby('ug_name', 'asc')->get();
        $sel_months = Month::Orderby('cal_month', 'asc')->get();

        return view('./projects/details/Calibration/form', compact('project', 'id', 'cal_id', 'calibration', 'sel_ugs', 'sel_labs', 'sel_months'));    
    }
    public function delete($id, $cal_id)
	{
		$alert 					= 'alert-warning';
		$message				= 'Equipment successfully deleted.';
		$calibration = Calibration::find($cal_id);
		$calibration->delete();

		return redirect()->back()->with('message', $message)->with('alert', $alert);
	}
}
