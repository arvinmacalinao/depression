<?php

namespace App\Http\Controllers;


use App\Models\PIS;
use App\Models\PsiProject;
use Illuminate\Http\Request;

class ProjectPISController extends Controller
{
    public function index(Request $request, $id)
    {
        $project = PsiProject::FindorFail($id);

        $sel_pis_years = PIS::Groupby('prjpis_year')->Orderby('prjpis_year', 'desc')->get();
        $sel_pis_semesters = PIS::Groupby('sem_id')->get();

        $pis = PIS::get();

        return view('./projects/details/PIS/index', compact('project', 'sel_pis_years', 'sel_pis_semesters', 'pis', 'id'));
    }

    public function new($id)
    {   
        $project = PsiProject::FindorFail($id);
        $pis_id = 0;
        $sel_pis_semesters = PIS::Groupby('sem_id')->get();

        $pis = new PIS;
        return view('./projects/details/PIS/form', compact('project', 'pis', 'sel_pis_semesters', 'id', 'pis_id'));    
    }

    public function store(Request $request, $id, $pis_id)
    {
        
        if($pis_id == 0) {
            $alert 					= 'alert-success';
			$message				= 'New PIS record successfully added.';
            $request->request->add(['prj_id' => $id]);
            $pis = PIS::create($request->all());

        } else {
            $alert 					= 'alert-info';
			$message				= 'New PIS record successfully updated.';
            $pis = PIS::update($request->all());
        }

        return redirect()->route('PIS', $id)->with('message', $message)->with('alert', $alert);
    }

    public function edit($id, $pis_id)
    {
        $project = PsiProject::FindorFail($id);
        $pis = PIS::Find($pis_id);
        
        $sel_pis_years = PIS::Groupby('prjpis_year')->Orderby('prjpis_year', 'desc')->get();
        $sel_pis_semesters = PIS::Groupby('sem_id')->get();

        return view('./projects/details/PIS/form', compact('project', 'id', 'pis_id', 'sel_pis_years', 'sel_pis_semesters','pis'));    
    }

    public function delete($id, $pis_id)
	{
		$alert 					= 'alert-warning';
		$message				= 'Project successfully deleted.';
		$pis = PIS::find($pis_id);
		$pis->delete();

		return redirect()->back()->with('message', $message)->with('alert', $alert);
	}
}
