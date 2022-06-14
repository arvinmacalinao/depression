<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Equipment;
use App\Models\PsiProject;
use App\Models\Improvement;
use Illuminate\Http\Request;
use App\Models\ServiceProvider;

class ProjectEquipmentController extends Controller
{
    public function index(Request $request, $id)
    {
        $project = PsiProject::FindorFail($id);

        //filter
        $eq_brand = $request->get('qbrand');
        $eq_search = $request->get('qsearch');

        $sel_brands = Brand::Orderby('brand_name', 'asc')->get();
    
        $equipments = Equipment::where('prj_id', $id)->EqBrand($eq_brand)->EqSearch($eq_search)->get();

        //->EqBrand($eq_brand)->EqSearch($eq_search)
        return view('./projects/details/Equipment/index', compact('project', 'equipments', 'sel_brands', 'eq_search'));
    }

    public function new($id)
    {
        {   
            $project = PsiProject::FindorFail($id);
            $eq_id = 0;
            
            $sel_brands = Brand::Orderby('brand_name', 'asc')->get();
            $sel_improvements = Improvement::get();
            $sel_suppliers = ServiceProvider::OrderBy('sp_name', 'asc')->get();

            $equipment = new Equipment;
            return view('./projects/details/Equipment/form', compact('project', 'equipment', 'id', 'eq_id', 'sel_brands', 'sel_improvements', 'sel_suppliers'));    
        } 
    }

    public function store(Request $request, $id, $eq_id)
    {
        
        if($eq_id == 0) {
            $alert 					= 'alert-success';
			$message				= 'New Equipment record successfully added.';
            $request->request->add(['prj_id' => $id]);
            $equipment = Equipment::create($request->all());

        } else {
            $alert 					= 'alert-info';
			$message				= 'Equipment record successfully updated.';
            $equipment = Equipment::find($eq_id);
            $equipment->update($request->all());
        }

        return redirect()->route('Equipment', $id)->with('message', $message)->with('alert', $alert);
    }

    public function edit($id, $eq_id)
    {
        $project = PsiProject::FindorFail($id);
        $equipment = Equipment::Find($eq_id);
        
        $sel_brands = Brand::Orderby('brand_name', 'asc')->get();
        $sel_improvements = Improvement::get();
        $sel_suppliers = ServiceProvider::OrderBy('sp_name', 'asc')->get();

        return view('./projects/details/Equipment/form', compact('project', 'id', 'eq_id', 'sel_brands', 'equipment', 'sel_improvements', 'sel_suppliers'));    
    }

    public function delete($id, $eq_id)
	{
		$alert 					= 'alert-warning';
		$message				= 'Equipment successfully deleted.';
		$equipment = Equipment::find($eq_id);
		$equipment->delete();

		return redirect()->back()->with('message', $message)->with('alert', $alert);
	}

    public function view($id, $eq_id)
	{
		$project = PsiProject::FindorFail($id);
        $equipment = Equipment::Find($eq_id);

		return view('./projects/details/Equipment/view', compact('project', 'equipment'));    
	}
}
