<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Product;
use App\Models\PsiProject;
use Illuminate\Http\Request;

class ProjectProductController extends Controller
{
    public function index(Request $request, $id)
    {
        $project = PsiProject::FindorFail($id);

        //filter
        $prod_unit = $request->get('qunit');
        $prod_search = $request->get('qsearch');

        $sel_units = Unit::Orderby('unit_name', 'asc')->get();
    
        $products = Product::where('prj_id', $id)->ProdUnit($prod_unit)->ProdSearch($prod_search)->get();

        return view('./projects/details/Products/index', compact('project', 'products', 'sel_units', 'prod_search'));
    }

    public function new($id)
    {   
        $project = PsiProject::FindorFail($id);
        $prod_id = 0;
        $sel_units = Unit::Orderby('unit_name', 'asc')->get();

        $product = new Product;
        return view('./projects/details/Products/form', compact('project', 'product', 'sel_units', 'id', 'prod_id'));    
    }

    public function store(Request $request, $id, $prod_id)
    {
        
        if($prod_id == 0) {
            $alert 					= 'alert-success';
			$message				= 'New Product record successfully added.';
            $request->request->add(['prj_id' => $id]);
            $product = Product::create($request->all());

        } else {
            $alert 					= 'alert-info';
			$message				= 'Product record successfully updated.';
            $product = Product::find($prod_id);
            $product->update($request->all());
        }

        return redirect()->route('Product', $id)->with('message', $message)->with('alert', $alert);
    }

    public function edit($id, $prod_id)
    {
        $project = PsiProject::FindorFail($id);
        $product = Product::Find($prod_id);
        
        $sel_units = Unit::Orderby('unit_name', 'asc')->get();

        return view('./projects/details/Products/form', compact('project', 'id', 'prod_id', 'sel_units', 'product'));    
    }

    public function delete($id, $prod_id)
	{
		$alert 					= 'alert-warning';
		$message				= 'Project successfully deleted.';
		$product = Product::find($prod_id);
		$product->delete();

		return redirect()->back()->with('message', $message)->with('alert', $alert);
	}
}
