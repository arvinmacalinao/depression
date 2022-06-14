<?php

namespace App\Http\Controllers;

use App\Models\Packaging;
use App\Models\PsiProject;
use Illuminate\Http\Request;
use App\Models\PackagingDesign;

class ProjectPackagingController extends Controller
{
    public function index(Request $request, $id)
    {
        $project = PsiProject::FindorFail($id);

        //filter
        // $eq_brand = $request->get('qbrand');
        // $eq_search = $request->get('qsearch');

        // $sel_years = Packaging::groupby('pkg_date')->Orderby('pkg_date', 'asc')->get();
    
        $packagings = Packaging::where('prj_id', $id)->Orderby('last_updated', 'desc')->get();

        //->EqBrand($eq_brand)->EqSearch($eq_search)
        return view('./projects/details/Packaging/index', compact('project', 'packagings'));
    }

    public function new($id)
    {
        {   
            $project = PsiProject::FindorFail($id);
            $pack_id = 0;
            
            $packaging = new Packaging;
            return view('./projects/details/Packaging/form', compact('project', 'packaging', 'id', 'pack_id'));
        } 
    }

    public function store(Request $request, $id, $pack_id)
    {
        
        if($pack_id == 0) {
            $alert 					= 'alert-success';
			$message				= 'New Testing & Packaging record successfully added.';
            $request->request->add(['prj_id' => $id]);
            $packaging = Packaging::create($request->all());

        } else {
            $alert 					= 'alert-info';
			$message				= 'Testing & Packaging record successfully updated.';
            $packaging = Packaging::find($pack_id);
            $packaging->update($request->all());
        }

        return redirect()->route('Packaging', $id)->with('message', $message)->with('alert', $alert);
    }

    public function edit($id, $pack_id)
    {
        $project = PsiProject::FindorFail($id);
        $packaging = Packaging::Find($pack_id);

        return view('./projects/details/Packaging/form', compact('project', 'id', 'pack_id', 'packaging'));    
    }

    public function delete($id, $pack_id)
	{
		$alert 					= 'alert-warning';
		$message				= 'Project Packaging & Labeling record successfully deleted.';
		$packaging = Packaging::find($pack_id);
		$packaging->delete();

		return redirect()->back()->with('message', $message)->with('alert', $alert);
	}

    public function view($id, $pack_id)
	{
		$project = PsiProject::FindorFail($id);
        $packaging = Packaging::Find($pack_id);

		return view('./projects/details/Packaging/view', compact('project', 'packaging'));    
	}
    
}
