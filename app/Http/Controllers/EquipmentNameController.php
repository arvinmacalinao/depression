<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EquipmentNames;

class EquipmentNameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $eq_search = $request->input('eq_search');

        $sel_eqs = EquipmentNames::EquipmentSearch($eq_search)
        ->orderBy('brand_name', 'ASC')
        ->get();

        return view('adminsettings/equipments.index', compact('sel_eqs',));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminsettings/equipments.create');
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
			'brand_name' => 'required|string|min:3|max:255',
		];

        $messages = [
            'brand_name.required' => 'Category Name field is required.',
        ];

        $validator = Validator::make($request->all(),$rules, $messages);

        if ($validator->fails()) {
			return redirect('equipmentnames/create')
			->withInput()
			->withErrors($validator);
		}else{
            $data = $request->input();
			try{
				$equipment_name = new EquipmentNames;
                $equipment_name->doctype_name = $data['brand_name'];

				$equipment_name->save();
				return redirect('equipmentnames')->with('status',"Saved Successfully");
			}
			catch(Exception $e){
				return redirect('equipmentnames')->with('failed',"Operation Failed");
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
        $show_eq = EquipmentNames::findOrFail($id);

        return view('adminsettings/equipments.edit', compact('show_eq'));
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
            'brand_name' => 'required|string|min:3|max:255',
        ]);

        EquipmentNames::where("brand_id", "=", $id)->update($validatedData);


        return redirect('equipmentnames')->with('status',"Updated Successfully");  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $show = EquipmentNames::findOrFail($id);
        $show->delete();

        return redirect('equipmentnames')->with('status', 'Equipment Name Deleted');
    }

    public function refractor_index($id){
        $show_eqrefrac = EquipmentNames::findOrFail($id);

        $sel_eqs = EquipmentNames::select('*')
        ->orderBy('brand_name', 'ASC')
        ->get();

        return view('adminsettings/equipments.refactor', compact('show_eqrefrac', 'sel_eqs'));
    }

    public function refactor_update(Request $request, $id){

        $validatedData = $request->validate([
            'brand_id' => 'required|string|min:2|max:255',
        ]);

        EquipmentNames::where("brand_id", "=", $id)->update($validatedData);


        return redirect('equipmentnames')->with('status',"Refactored Successfully");   
    }
}
