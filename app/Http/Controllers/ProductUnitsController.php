<?php

namespace App\Http\Controllers;

use App\Models\ProductUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductUnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $unit_search = $request->input('unit_search');

        $sel_prods = ProductUnit::ProductUnitSearch($unit_search)
        ->orderBy('unit_name', 'ASC')
        ->get();

        return view('adminsettings/produnit.index', compact('sel_prods',));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminsettings/produnit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
			'unit_name' => 'required|string|min:3|max:255',
		];

        $messages = [
            'unit_name.required' => 'Unit Name field is required.',
        ];

        $validator = Validator::make($request->all(),$rules, $messages);

        if ($validator->fails()) {
			return redirect('productunits/create')
			->withInput()
			->withErrors($validator);
		}else{
            $data = $request->input();
			try{
				$punit_name = new ProductUnit;
                $punit_name->unit_name = $data['unit_name'];
				$punit_name->save();
				return redirect('productunits')->with('status',"Saved Successfully");
			}
			catch(Exception $e){
				return redirect('productunits')->with('failed',"Operation Failed");
			}           
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $show_prod = ProductUnit::findOrFail($id);

        return view('adminsettings/produnit.edit', compact('show_prod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
			'unit_name' => 'required|string|min:3|max:255',
        ]);

        ProductUnit::where("unit_id", "=", $id)->update($validatedData);


        return redirect('productunits')->with('status',"Unit Updated Successfully"); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $show = ProductUnit::findOrFail($id);
        $show->delete();

        return redirect('productunits/')->with('status', 'Unit Deleted');
    }
}
