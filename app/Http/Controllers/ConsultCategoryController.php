<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConsultCategories;
use Illuminate\Support\Facades\Validator;

class ConsultCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $consult_search = $request->input('consult_search');

        $sel_consults = ConsultCategories::ConsultSearch($consult_search)
        ->orderBy('con_type_name', 'ASC')
        ->get();

        return view('adminsettings/consultcat.index', compact('sel_consults',));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminsettings/consultcat.create');
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
			'con_type_name' => 'required|string|min:3|max:255',
		];

        $messages = [
            'con_type_name.required' => 'Category Name field is required.',
        ];

        $validator = Validator::make($request->all(),$rules, $messages);

        if ($validator->fails()) {
			return redirect('consultcategory/create')
			->withInput()
			->withErrors($validator);
		}else{
            $data = $request->input();
			try{
				$category_name = new ConsultCategories;
                $category_name->con_type_name = $data['con_type_name'];
				$category_name->save();
				return redirect('consultcategory')->with('status',"Saved Successfully");
			}
			catch(Exception $e){
				return redirect('consultcategory')->with('failed',"Operation Failed");
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
        $show_consult = ConsultCategories::findOrFail($id);

        return view('adminsettings/consultcat.edit', compact('show_consult'));
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
			'con_type_name' => 'required|string|min:3|max:255',
        ]);

        ConsultCategories::where("con_type_id", "=", $id)->update($validatedData);


        return redirect('consultcategory')->with('status',"Category Updated Successfully"); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $show = ConsultCategories::findOrFail($id);
        $show->delete();

        return redirect('consultcategory/')->with('status', 'Category Deleted');
    }
}
