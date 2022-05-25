<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Equipment;
use App\Models\PsiProject;
use Illuminate\Http\Request;

class ProjectEquipmentController extends Controller
{
    public function index(Request $request, $id)
    {
        $project = PsiProject::FindorFail($id);

        //filter
        $eq_brand = $request->get('qbrand');
        $eq_search = $request->get('qsearch');

        $sel_brands = Brand::Orderby('brand_name', 'asc')->get();
    
        $equipments = Equipment::where('prj_id', $id)->get();

        

        //->EqBrand($eq_brand)->EqSearch($eq_search)
        return view('./projects/details/Equipment/index', compact('project', 'equipments', 'sel_brands', 'eq_search'));
    }
}
