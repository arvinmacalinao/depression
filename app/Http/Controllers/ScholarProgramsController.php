<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScholarPrograms;
use Illuminate\Support\Facades\Validator;

class ScholarProgramsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $scholarprogram_search = $request->input('scholarprogram_search');

        $scholarshipprograms = ScholarPrograms::ScholarProgramSearch($scholarprogram_search)->orderBy('scholar_prog_name', 'ASC')->get();

        return view('adminsettings/scholarprograms.index', compact('scholarshipprograms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminsettings/scholarprograms.create');
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
            'scholar_prog_name' => 'required|string|min:3|max:255',
            'scholar_prog_desc' => 'required|string|min:3|max:255',
		];

        $messages = [
            'scholar_prog_name.required' => 'Program Name field is required.',
            'scholar_prog_desc.required' => 'Description field is required.',
        ];

        $validator = Validator::make($request->all(),$rules, $messages);

        if ($validator->fails()) {
			return redirect('scholarprograms')
			->withInput()
			->withErrors($validator);
		}else{
            $data = $request->input();
			try{
				$scholar_program = new ScholarPrograms;

                $scholar_program->scholar_prog_name = $data['scholar_prog_name'];
                $scholar_program->scholar_prog_desc = $data['scholar_prog_desc'];
                
				$scholar_program->save();
				return redirect('scholarprograms')->with('status',"Saved Successfully");
			}
			catch(Exception $e){
				return redirect('scholarprograms')->with('failed',"Operation Failed");
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
        $show_programs = ScholarPrograms::findOrFail($id);

        return view('adminsettings/scholarprograms.edit', compact('show_programs'));
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
            'scholar_prog_name' => 'required|string|min:3|max:255',
            'scholar_prog_desc' => 'required|string|min:3|max:255',
        ]);

        ScholarPrograms::where("scholar_prog_id", "=", $id)->update($validatedData);


        return redirect('scholarprograms')->with('status',"Program Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $show = ScholarPrograms::findOrFail($id);
        $show->delete();

        return redirect('scholarprograms')->with('status', 'Program Deleted');
    }
}
