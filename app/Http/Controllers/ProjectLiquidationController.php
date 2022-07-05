<?php

namespace App\Http\Controllers;

use App\Models\PsiProject;
use Illuminate\Http\Request;
use App\Models\ProjectLiquidation;
use App\Models\ProjectLiquidationType;

class ProjectLiquidationController extends Controller
{
    public function index(Request $request, $id)
	{
        $liq_search = $request->get('qsearch');
        $liq_type = $request->get('qtype');
        // $sat_year = $request->get('qyear');
		
        $sel_types = ProjectLiquidationType::get();
        // $sel_qtrs = Quarter::get();

        $project = PsiProject::FindorFail($id);
        $liquidations = ProjectLiquidation::where('prj_id', $id)->LiqSearch($liq_search)->LiqType($liq_type)->Orderby('date_encoded', 'desc')->paginate(20);
    
		return view('./projects/details/Liquidation/index', compact('project', 'liquidations', 'sel_types', 'liq_search', 'liq_type'));    
	}

    public function new($id)
    {
        {   
            $project = PsiProject::FindorFail($id);
            $liq_id = 0;
            $liquidation = new ProjectLiquidation;

            $sel_types = ProjectLiquidationType::get();

            return view('./projects/details/Liquidation/form', compact('project', 'liquidation', 'id', 'liq_id', 'sel_types'));
        } 
    }

    public function store(Request $request, $id, $liq_id)
    {   
        $now            = date('Ymdhis');        
        if ($request->hasFile('liq_file')) {
            $attachment     = $request->file('liq_file');
            $extension      = $attachment->getClientOriginalExtension();
            $orig_name      = $attachment->getClientOriginalName();
            $filename       = explode('.',$orig_name)[0];
            $doc1         = $now.'_'.$orig_name;

            $attachment->storeAs('public/uploads/documents/', $doc1);            
        } else {
            $doc1         = NULL;
        }
    
        if($liq_id == 0) {
            $alert 					= 'alert-success';
			$message				= 'New Project Liquidation successfully added.';
            $request->request->add(['liq_filename' => $filename]);
            $request->request->add(['prj_id' => $id]);
            $liquidation = ProjectLiquidation::create($request->except(['liq_file']));
            $liquidation->update(['liq_file' => $doc1]);
        } 
        else {
            $alert 					= 'alert-info';
			$message				= 'Project Liquidation record successfully updated.';
            $liquidation = ProjectLiquidation::find($liq_id);
            $liquidation->update($request->except(['liq_file']));

            if($request->hasFile('liq_file')){
            $liquidation->update(['liq_file' => $doc1]);
            $liquidation->update(['liq_filename' => $filename]);
            }
        }
        return redirect()->route('Project Liquidation', [$id])->with('message', $message)->with('alert', $alert);
    }

    public function delete($id, $liq_id)
	{
		$alert 					= 'alert-warning';
		$message				= 'Project Liquidation record successfully deleted.';
        $liquidation                    = ProjectLiquidation::find($liq_id);
		$liquidation->delete();

		return redirect()->back()->with('message', $message)->with('alert', $alert);
	}

    public function edit($id, $liq_id)
    {
        $project        = PsiProject::FindorFail($id);
        $liquidation    = ProjectLiquidation::Find($liq_id);

        $sel_types      = ProjectLiquidationType::get();
        
        return view('./projects/details/Liquidation/form', compact('project', 'liquidation', 'id', 'liq_id', 'sel_types'));
    }
}