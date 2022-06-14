<?php

namespace App\Http\Controllers;

use App\Models\PsiProject;
use App\Models\Consultancy;
use Illuminate\Http\Request;
use App\Models\ConsultancyDocuments;

class ConsultancyDocumentsController extends Controller
{
    public function index($id, $con_id)
	{
		$project = PsiProject::FindorFail($id);
        $consultancy = Consultancy::Find($con_id);
        $ducuments = ConsultancyDocuments::where('con_id', $con_id)->Orderby('last_updated', 'desc')->get();

		return view('./projects/details/Consultancy/Documents/index', compact('project', 'consultancy', 'ducuments'));    
	}
}
