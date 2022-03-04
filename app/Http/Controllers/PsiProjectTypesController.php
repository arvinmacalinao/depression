<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class PsiProjectTypesController extends Controller
{

public function details()
    {
        $psi_project_types=psi_project_types::all();
        return view('./projects/addproject', compact('psi_project_types'));
    }
}
