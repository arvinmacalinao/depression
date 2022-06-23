<?php

namespace App\Http\Controllers;

use App\Models\PsiProject;
use App\Models\Consultancy;
use Illuminate\Http\Request;
use App\Models\ConsultancyDocuments;

class ConsultancyDocumentsController extends Controller
{
    public function index(Request $request, $id, $con_id)
	{
        $doc_search = $request->get('qsearch');
		
        $project = PsiProject::FindorFail($id);
        $consultancy = Consultancy::Find($con_id);
        $documents = ConsultancyDocuments::where('con_id', $con_id)->DocSearch($doc_search)->Orderby('last_updated', 'desc')->get();

		return view('./projects/details/Consultancy/Documents/index', compact('project', 'consultancy', 'documents'));    
	}

	public function new($id, $con_id)
    {
        {   
            $project = PsiProject::FindorFail($id);
            $consultancy = Consultancy::find($con_id);
            $doc_id = 0;
            $document = new ConsultancyDocuments;

            
            
            return view('./projects/details/Consultancy/Documents/form', compact('project', 'consultancy', 'id', 'con_id', 'doc_id', 'document'));
        } 
    }

    public function store(Request $request, $id, $con_id, $doc_id)
    {   
        $now            = date('Ymdhis');        
        if ($request->hasFile('condoc_file')) {
            $attachment     = $request->file('condoc_file');
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
			$message				= 'New Document record successfully added.';
            $request->request->add(['con_id' => $con_id]);
            $request->request->add(['condoc_filename' => $filename]);
            $documents = ConsultancyDocuments::create($request->except(['condoc_file']));
            $documents->update(['condoc_file' => $doc1]);
        } 
        else {
            $alert 					= 'alert-info';
			$message				= 'Document record successfully updated.';
            $documents = ConsultancyDocuments::find($doc_id);
            $documents->update($request->except(['condoc_file']));

            if($request->hasFile('condoc_file')){
            $documents->update(['condoc_file' => $doc1]);
            $documents->update(['condoc_filename' => $filename]);
            }
        }
        return redirect()->route('Consultancy Documents', [$id, $con_id])->with('message', $message)->with('alert', $alert);
    }

    public function delete($id, $con_id, $doc_id)
	{
		$alert 					= 'alert-warning';
		$message				= 'Document record successfully deleted.';
		$document = ConsultancyDocuments::find($doc_id);
		$document->delete();

		return redirect()->back()->with('message', $message)->with('alert', $alert);
	}

    public function edit($id, $con_id, $doc_id)
    {
        $project = PsiProject::FindorFail($id);
        $consultancy = Consultancy::find($con_id);
        $document = ConsultancyDocuments::Find($doc_id);
        
        return view('./projects/details/Consultancy/Documents/form', compact('project', 'consultancy', 'document', 'id', 'con_id', 'doc_id'));
    }
    
}
