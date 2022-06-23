<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\PsiProject;
use Illuminate\Http\Request;
use App\Models\TrainingDocument;
use App\Models\TrainingDocumentType;

class ProjectTrainingDocumentsController extends Controller
{
    public function index(Request $request, $id, $fr_id)
	{
        $tdoc_search = $request->get('qsearch');
		
        $project = PsiProject::FindorFail($id);
        $training = Training::Find($fr_id);
        $documents = TrainingDocument::where('fr_id', $fr_id)->TrainDocSearch($tdoc_search)->Orderby('last_updated', 'desc')->get();

		return view('./projects/details/Training/Documents/index', compact('project', 'fr_id', 'training', 'documents', 'tdoc_search'));    
	}

    public function new($id, $fr_id)
    {
        {   
            $project = PsiProject::FindorFail($id);
            $training = Training::find($fr_id);
            $frdoc_id = 0;
            $document = new TrainingDocument;

            $sel_doctypes = TrainingDocumentType::get();

            return view('./projects/details/Training/Documents/form', compact('project', 'training', 'id', 'fr_id', 'frdoc_id', 'document', 'sel_doctypes'));
        } 
    }

    public function store(Request $request, $id, $fr_id, $frdoc_id)
    {   
        $now            = date('Ymdhis');        
        if ($request->hasFile('frdoc_file')) {
            $attachment     = $request->file('frdoc_file');
            $extension      = $attachment->getClientOriginalExtension();
            $orig_name      = $attachment->getClientOriginalName();
            $filename       = explode('.',$orig_name)[0];
            $doc1         = $now.'_'.$orig_name;

            $attachment->storeAs('public/uploads/documents/', $doc1);            
        } else {
            $doc1         = NULL;
        }
    
        if($frdoc_id == 0) {
            $alert 					= 'alert-success';
			$message				= 'New Project Training Document record successfully added.';
            $request->request->add(['fr_id' => $fr_id]);
            $request->request->add(['frdoc_filename' => $filename]);
            $documents = TrainingDocument::create($request->except(['frdoc_file']));
            $documents->update(['frdoc_file' => $doc1]);
        } 
        else {
            $alert 					= 'alert-info';
			$message				= 'Training Document record successfully updated.';
            $documents = TrainingDocument::find($frdoc_id);
            $documents->update($request->except(['frdoc_file']));

            if($request->hasFile('frdoc_file')){
            $documents->update(['frdoc_file' => $doc1]);
            $documents->update(['frdoc_filename' => $filename]);
            }
        }
        return redirect()->route('Project Training Documents', [$id, $fr_id])->with('message', $message)->with('alert', $alert);
    }

    public function delete($id, $fr_id, $frdoc_id)
	{
		$alert 					= 'alert-warning';
		$message				= 'Document record successfully deleted.';
		$document = TrainingDocument::find($frdoc_id);
		$document->delete();

		return redirect()->back()->with('message', $message)->with('alert', $alert);
	}

    public function edit($id, $fr_id, $frdoc_id)
    {
        $project = PsiProject::FindorFail($id);
        $training = Training::find($fr_id);
        $document = TrainingDocument::Find($frdoc_id);

        $sel_doctypes = TrainingDocumentType::get();
        
        return view('./projects/details/Training/Documents/form', compact('project', 'training', 'document', 'id', 'fr_id', 'frdoc_id', 'sel_doctypes'));
    }

}
