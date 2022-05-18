<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CollabCategories;
use Illuminate\Support\Facades\Validator;

class CollabCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sel_collabs = CollabCategories::select('*')
        ->orderBy('ot_name', 'ASC')
        ->get();

        return view('collabcat.index', compact('sel_collabs',));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('collabcat.create');
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
			'ot_name' => 'required|string|min:3|max:255',
		];

        $messages = [
            'ot_name.required' => 'Category Name field is required.',
        ];

        $validator = Validator::make($request->all(),$rules, $messages);

        if ($validator->fails()) {
			return redirect('collabcategories/create')
			->withInput()
			->withErrors($validator);
		}else{
            $data = $request->input();
			try{
				$category_name = new CollabCategories;
                $category_name->ot_name = $data['ot_name'];
				$category_name->save();
				return redirect('collabcategories/create')->with('status',"Saved Successfully");
			}
			catch(Exception $e){
				return redirect('collabcategories/create')->with('failed',"Operation Failed");
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
        $show_collab = CollabCategories::findOrFail($id);

        return view('collabcat.edit', compact('show_collab'));
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
			'ot_name' => 'required|string|min:3|max:255',
        ]);

        CollabCategories::where("ot_id", "=", $id)->update($validatedData);


        return redirect('collabcategories/'.$id.'/edit')->with('status',"Category Updated Successfully");    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $show = CollabCategories::findOrFail($id);
        $show->delete();

        return redirect('collabcategories/')->with('status', 'Category Deleted');
    }
}
