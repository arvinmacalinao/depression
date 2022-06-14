<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseCategory;
use Illuminate\Support\Facades\Validator;

class CourseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $course_search = $request->input('course_search');

        $sel_courses = CourseCategory::CourseSearch($course_search)
        ->orderBy('course_cat_name', 'ASC')
        ->get();

        return view('adminsettings/coursecat.index', compact('sel_courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sel_course = CourseCategory::orderBy('course_cat_name', 'ASC')->get();

        return view('adminsettings/coursecat.create', compact('sel_course'));
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
            'course_cat_name' => 'required|string|min:3|max:255',
		];

        $messages = [
            'course_cat_name.required' => 'Course Category field is required.',
        ];

        $validator = Validator::make($request->all(),$rules, $messages);

        if ($validator->fails()) {
			return redirect('coursecategory')
			->withInput()
			->withErrors($validator);
		}else{
            $data = $request->input();
			try{
				$course_cat_name = new CourseCategory;
                $course_cat_name->course_cat_name = $data['course_cat_name'];
				$course_cat_name->save();
				return redirect('coursecategory')->with('status',"Saved Successfully");
			}
			catch(Exception $e){
				return redirect('coursecategory')->with('failed',"Operation Failed");
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $show_course = CourseCategory::findOrFail($id);

        return view('adminsettings/coursecat.edit', compact('show_course'));
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
			'course_cat_name' => 'required|string|min:3|max:255',
        ]);

        CourseCategory::where("course_cat_id", "=", $id)->update($validatedData);


        return redirect('coursecategory')->with('status',"Category Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $show = CourseCategory::findOrFail($id);
        $show->delete();

        return redirect('coursecategory')->with('status', 'Category Deleted');
    }
}
