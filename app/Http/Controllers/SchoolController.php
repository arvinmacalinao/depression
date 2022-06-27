<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $schoolname_search = $request->input('schoolname_search');

        $schools = School::SchoolSearch($schoolname_search)->orderBy('school_name', 'ASC')->get();

        return view('adminsettings/schools.index', compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminsettings/schools.create');
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
            'school_name' => 'required|string|min:3|max:255',
            'school_acronym' => 'required|string|min:3|max:255',
		];

        $messages = [
            'school_name.required' => 'Name field is required.',
            'school_acronym.required' => 'Acronym field is required.',
        ];

        $validator = Validator::make($request->all(),$rules, $messages);

        if ($validator->fails()) {
			return redirect('schools')
			->withInput()
			->withErrors($validator);
		}else{
            $data = $request->input();
			try{
				$school = new School;

                $school->school_name = $data['school_name'];
                $school->school_acronym = $data['school_acronym'];
                $school->school_address = $data['school_address'];
                $school->school_coordinator = $data['school_coordinator'];
                $school->school_email = $data['school_email'];
                $school->school_phone = $data['school_phone'];
                $school->school_mobile = $data['school_mobile'];
                
				$school->save();
				return redirect('schools')->with('status',"Saved Successfully");
			}
			catch(Exception $e){
				return redirect('schools')->with('failed',"Operation Failed");
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
        $show_schools = School::findOrFail($id);

        return view('adminsettings/schools.edit', compact('show_schools'));
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
            'school_name' => 'required|string|min:3|max:255',
            'school_acronym' => 'required|string|min:3|max:255',
            'school_address' => 'min:3|max:255',
            'school_coordinator' => 'min:3|max:255',
            'school_email' => 'min:3|max:255',
            'school_phone' => 'min:3|max:255',
            'school_mobile' => 'min:3|max:255',
        ]);

        School::where("school_id", "=", $id)->update($validatedData);


        return redirect('schools')->with('status',"School Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $show = School::findOrFail($id);
        $show->delete();

        return redirect('schools')->with('status', 'School Deleted');
    }
}
