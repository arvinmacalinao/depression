<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrganizationCategory;
use Illuminate\Support\Facades\Validator;

class OrganizationCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cat_search = $request->input('cat_search');

        $sel_orgacats = OrganizationCategory::OrgaCatSearch($cat_search)
        ->orderBy('ot_cat1_name', 'ASC')
        ->get();

        return view('adminsettings/organizationcat.index', compact('sel_orgacats',));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminsettings/organizationcat.create');
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
			'ot_cat1_name' => 'required|string|min:3|max:255',
		];

        $messages = [
            'ot_cat1_name.required' => 'Category Name field is required.',
        ];

        $validator = Validator::make($request->all(),$rules, $messages);

        if ($validator->fails()) {
			return redirect('organizationcategories/create')
			->withInput()
			->withErrors($validator);
		}else{
            $data = $request->input();
			try{
				$category_name = new OrganizationCategory;
                $category_name->ot_cat1_name = $data['ot_cat1_name'];
				$category_name->save();
				return redirect('organizationcategories')->with('status',"Saved Successfully");
			}
			catch(Exception $e){
				return redirect('organizationcategories')->with('failed',"Operation Failed");
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
        $show_organ = OrganizationCategory::findOrFail($id);

        return view('adminsettings/organizationcat.edit', compact('show_organ'));
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
			'ot_cat1_name' => 'required|string|min:3|max:255',
        ]);

        OrganizationCategory::where("ot_cat1_id", "=", $id)->update($validatedData);


        return redirect('organizationcategories')->with('status',"Category Updated Successfully"); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $show = OrganizationCategory::findOrFail($id);
        $show->delete();

        return redirect('organizationcategories/')->with('status', 'Category Deleted');
    }
}
