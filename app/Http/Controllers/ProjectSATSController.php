<?php

namespace App\Http\Controllers;

use App\Models\PsiProject;
use App\Models\ProjectSATS;
use Illuminate\Http\Request;

class ProjectSATSController extends Controller
{
    public function index(Request $request, $id)
	{
        // $doc_search = $request->get('qsearch');
        // $doc_type = $request->get('qtype');
		
        // $sel_doctypes = ProjectDocumentationType::Orderby('doctype_name', 'asc')->get();

        $project = PsiProject::FindorFail($id);
        $sats = ProjectSATS::where('prj_id', $id)->Orderby('date_encoded', 'desc')->paginate(20);
    
		return view('./projects/details/SATS/index', compact('project', 'sats'));    
	}
}
