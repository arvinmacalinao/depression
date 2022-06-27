<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\CourseCategory;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $coursename_search = $request->input('coursename_search');
        $coursecatid_search = $request->input('course_cat_id');

        $courses = Course::Course($coursename_search,$coursecatid_search)->orderBy('course_name', 'ASC')->get();
        $show_course_cats = CourseCategory::all();

        return view('adminsettings/courses.index', compact('courses','show_course_cats'));
    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $show_course_cats = CourseCategory::all();

        return view('adminsettings/courses.create', compact('show_course_cats'));
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
            'course_name' => 'required|string|min:3|max:255',
            'course_cat_id' => 'required',
            'course_yearcount' => 'required',
		];

        $messages = [
            'course_name.required' => 'Course field is required.',
            'course_cat_id.required' => 'Category field is required.',
            'course_yearcount' => 'Year count field is required.',
        ];

        $validator = Validator::make($request->all(),$rules, $messages);

        if ($validator->fails()) {
			return redirect('course')
			->withInput()
			->withErrors($validator);
		}else{
            $data = $request->input();
			try{
				$course_cat_name = new Course;

                $course_cat_name->course_name = $data['course_name'];
                $course_cat_name->course_cat_id = $data['course_cat_id'];
                $course_cat_name->course_yearcount = $data['course_yearcount'];
                
				$course_cat_name->save();
				return redirect('course')->with('status',"Saved Successfully");
			}
			catch(Exception $e){
				return redirect('course')->with('failed',"Operation Failed");
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
        $show_courses = Course::findOrFail($id);
        $show_course_cats = CourseCategory::all();

        return view('adminsettings/courses.edit', compact('show_courses', 'show_course_cats'));
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
			'course_name' => 'required|string|min:3|max:255',
            'course_cat_id' => 'required',
            'course_yearcount' => 'required',
        ]);

        Course::where("course_id", "=", $id)->update($validatedData);


        return redirect('course')->with('status',"Course Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $show = Course::findOrFail($id);
        $show->delete();

        return redirect('course')->with('status', 'Course Deleted');
    }
}
