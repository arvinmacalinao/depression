<?php

namespace App\Http\Controllers;

use App\Models\PsiProject;
use App\Models\ProjectLegal;
use Illuminate\Http\Request;

class ProjectLegalController extends Controller
{
    public function index(Request $request, $id)
	{
        $legal_search = $request->get('qsearch');
        
        $project = PsiProject::FindorFail($id);
        $legals = ProjectLegal::where('prj_id', $id)->LegalSearch($legal_search)->Orderby('date_encoded', 'desc')->paginate(20);
    
		return view('./projects/details/Legal/index', compact('project', 'legals', 'legal_search'));    
	}

    public function new($id)
    {
        {   
            $project = PsiProject::FindorFail($id);
            $legal_id = 0;
            $legal = new ProjectLegal;

            return view('./projects/details/Legal/form', compact('project', 'legal', 'id', 'legal_id'));
        } 
    }

    public function store(Request $request, $id, $legal_id)
    {   
        $now            = date('Ymdhis');        
        if ($request->hasFile('legal_file')) {
            $attachment     = $request->file('legal_file');
            $extension      = $attachment->getClientOriginalExtension();
            $orig_name      = $attachment->getClientOriginalName();
            $filename       = explode('.',$orig_name)[0];
            $doc1         = $now.'_'.$orig_name;

            $attachment->storeAs('public/uploads/documents/', $doc1);            
        } else {
            $doc1         = NULL;
        }
    
        if($legal_id == 0) {
            $alert 					= 'alert-success';
			$message				= 'New Project SAT successfully added.';
            $request->request->add(['legal_filename' => $filename]);
            $request->request->add(['prj_id' => $id]);
            $legal = ProjectLegal::create($request->except(['legal_file']));
            $legal->update(['legal_file' => $doc1]);
        } 
        else {
            $alert 					= 'alert-info';
			$message				= 'Project SAT record successfully updated.';
            $legal = ProjectLegal::find($legal_id);
            $legal->update($request->except(['legal_file']));

            if($request->hasFile('legal_file')){
            $legal->update(['legal_file' => $doc1]);
            $legal->update(['legal_filename' => $filename]);
            }
        }
        return redirect()->route('Project Legal', [$id])->with('message', $message)->with('alert', $alert);
    }

    public function delete($id, $legal_id)
	{
		$alert 			    = 'alert-warning';
		$message		    = 'Project SAT record successfully deleted.';
        $legal              = ProjectLegal::find($legal_id);
		$legal->delete();

		return redirect()->back()->with('message', $message)->with('alert', $alert);
	}

    public function edit($id, $legal_id)
    {
        $project = PsiProject::FindorFail($id);
        $legal = ProjectLegal::Find($legal_id);
    
        return view('./projects/details/Legal/form', compact('project', 'legal', 'id', 'legal_id'));
    }
}
