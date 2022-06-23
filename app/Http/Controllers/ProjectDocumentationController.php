<?php

namespace App\Http\Controllers;

use App\Models\PsiProject;
use Illuminate\Http\Request;
use App\Models\ProjectDocumentation;
use App\Models\ProjectDocumentationType;

class ProjectDocumentationController extends Controller
{
    public function index(Request $request, $id)
	{
        $doc_search = $request->get('qsearch');
        $doc_type = $request->get('qtype');
		
        $sel_doctypes = ProjectDocumentationType::Orderby('doctype_name', 'asc')->get();

        $project = PsiProject::FindorFail($id);
        $documentations = ProjectDocumentation::where('prj_id', $id)->DocumentationSearch($doc_search)->DocumentationType($doc_type)->Orderby('date_encoded', 'desc')->paginate(20);
    
		return view('./projects/details/Documentation/index', compact('project', 'documentations', 'sel_doctypes', 'doc_search'));    
	}

    public function new($id)
    {
        {   
            $project = PsiProject::FindorFail($id);
            $doc_id = 0;
            $documentation = new ProjectDocumentation;

            $sel_doctypes = ProjectDocumentationType::Orderby('doctype_name', 'asc')->get();

            return view('./projects/details/Documentation/form', compact('project', 'documentation', 'id', 'doc_id', 'sel_doctypes'));
        } 
    }

    public function store(Request $request, $id, $doc_id)
    {   
        $now            = date('Ymdhis');        
        if ($request->hasFile('doc_file')) {
            $attachment     = $request->file('doc_file');
            $extension      = $attachment->getClientOriginalExtension();
            $orig_name      = $attachment->getClientOriginalName();
            $filename       = explode('.',$orig_name)[0];
            $doc1         = $now.'_'.$orig_name;

            $attachment->storeAs('public/uploads/documents/', $doc1);            
        } else {
            $doc1         = NULL;
        }
    
        if($doc_id == 0) {
            $alert 					= 'alert-success';
			$message				= 'New Project Documentation successfully added.';
            $request->request->add(['doc_filename' => $filename]);
            $request->request->add(['prj_id' => $id]);
            $documentation = ProjectDocumentation::create($request->except(['doc_file']));
            $documentation->update(['doc_file' => $doc1]);
        } 
        else {
            $alert 					= 'alert-info';
			$message				= 'Project Documentation record successfully updated.';
            $documentation = ProjectDocumentation::find($doc_id);
            $documentation->update($request->except(['doc_file']));

            if($request->hasFile('doc_file')){
            $documentation->update(['doc_file' => $doc1]);
            $documentation->update(['doc_filename' => $filename]);
            }
        }
        return redirect()->route('Project Documentation', [$id])->with('message', $message)->with('alert', $alert);
    }

    public function delete($id, $doc_id)
	{
		$alert 					= 'alert-warning';
		$message				= 'Document record successfully deleted.';
        $documentation = ProjectDocumentation::find($doc_id);
		$documentation->delete();

		return redirect()->back()->with('message', $message)->with('alert', $alert);
	}

    public function edit($id, $doc_id)
    {
        $project = PsiProject::FindorFail($id);
        $documentation = ProjectDocumentation::Find($doc_id);

        $sel_doctypes = ProjectDocumentationType::get();
        
        return view('./projects/details/Documentation/form', compact('project', 'documentation', 'id', 'doc_id', 'sel_doctypes'));
    }
}
