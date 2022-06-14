<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityCategory;
use Illuminate\Support\Facades\Validator;

class ActivityCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $activity_search = $request->input('activity_search');

        $sel_activitys = ActivityCategory::ActivitySearch($activity_search)
        ->orderBy('activity_type_name', 'ASC')
        ->get();

        return view('adminsettings/stactivitycat.index', compact('sel_activitys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sel_activity = ActivityCategory::orderBy('activity_type_name', 'ASC')->get();

        return view('adminsettings/stactivitycat.create', compact('sel_activity'));
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
            'activity_type_name' => 'required|string|min:3|max:255',
		];

        $messages = [
            'activity_type_name.required' => 'Category Name field is required.',
        ];

        $validator = Validator::make($request->all(),$rules, $messages);

        if ($validator->fails()) {
			return redirect('activitycategories')
			->withInput()
			->withErrors($validator);
		}else{
            $data = $request->input();
			try{
				$activity_category = new ActivityCategory;
                $activity_category->activity_type_name = $data['activity_type_name'];
				$activity_category->save();
				return redirect('activitycategories')->with('status',"Saved Successfully");
			}
			catch(Exception $e){
				return redirect('activitycategories')->with('failed',"Operation Failed");
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
        $show_activity = ActivityCategory::findOrFail($id);

        return view('adminsettings/stactivitycat.edit', compact('show_activity'));
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
			'activity_type_name' => 'required|string|min:3|max:255',
        ]);

        ActivityCategory::where("activity_type_id", "=", $id)->update($validatedData);


        return redirect('activitycategories')->with('status',"Category Updated Successfully");  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $show = ActivityCategory::findOrFail($id);
        $show->delete();

        return redirect('activitycategories')->with('status', 'Category Deleted');
    }
}
