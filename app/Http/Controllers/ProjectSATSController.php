<?php

namespace App\Http\Controllers;

use App\Models\Quarter;
use App\Models\PsiProject;
use App\Models\ProjectSATS;
use Illuminate\Http\Request;
use App\Models\ProjectSATSType;

class ProjectSATSController extends Controller
{
    public function index(Request $request, $id)
	{
        $sat_search = $request->get('qsearch');
        $qtype = $request->get('qtype');
        $sat_year = $request->get('qyear');
		
        $sel_types = ProjectSATSType::get();
        $sel_qtrs = Quarter::get();

        $project = PsiProject::FindorFail($id);
        $sats = ProjectSATS::where('prj_id', $id)->SatType($qtype)->SatYear($sat_year)->SatSearch($sat_search)->Orderby('date_encoded', 'desc')->paginate(20);
    
		return view('./projects/details/SATS/index', compact('project', 'sats', 'sel_types', 'sel_qtrs', 'qtype', 'sat_year', 'sat_search'));    
	}

    public function new($id)
    {
        {   
            $project = PsiProject::FindorFail($id);
            $sat_id = 0;
            $sat = new ProjectSATS;

            $sel_types = ProjectSATSType::get();

            return view('./projects/details/SATS/form', compact('project', 'sat', 'id', 'sat_id', 'sel_types'));
        } 
    }

    public function store(Request $request, $id, $sat_id)
    {   
        $now            = date('Ymdhis');        
        if ($request->hasFile('sat_file')) {
            $attachment     = $request->file('sat_file');
            $extension      = $attachment->getClientOriginalExtension();
            $orig_name      = $attachment->getClientOriginalName();
            $filename       = explode('.',$orig_name)[0];
            $doc1         = $now.'_'.$orig_name;

            $attachment->storeAs('public/uploads/documents/', $doc1);            
        } else {
            $doc1         = NULL;
        }
    
        if($sat_id == 0) {
            $alert 					= 'alert-success';
			$message				= 'New Project SAT successfully added.';
            $request->request->add(['sat_filename' => $filename]);
            $request->request->add(['prj_id' => $id]);
            $sat = ProjectSATS::create($request->except(['sat_file']));
            $sat->update(['sat_file' => $doc1]);
        } 
        else {
            $alert 					= 'alert-info';
			$message				= 'Project SAT record successfully updated.';
            $sat = ProjectSATS::find($sat_id);
            $sat->update($request->except(['sat_file']));

            if($request->hasFile('sat_file')){
            $sat->update(['sat_file' => $doc1]);
            $sat->update(['sat_filename' => $filename]);
            }
        }
        return redirect()->route('SATS', [$id])->with('message', $message)->with('alert', $alert);
    }

    public function delete($id, $sat_id)
	{
		$alert 					= 'alert-warning';
		$message				= 'Project SAT record successfully deleted.';
        $sat = ProjectSATS::find($sat_id);
		$sat->delete();

		return redirect()->back()->with('message', $message)->with('alert', $alert);
	}

    public function edit($id, $sat_id)
    {
        $project = PsiProject::FindorFail($id);
        $sat = ProjectSATS::Find($sat_id);

        $sel_types = ProjectSATSType::get();
        
        return view('./projects/details/SATS/form', compact('project', 'sat', 'id', 'sat_id', 'sel_types'));
    }
}
