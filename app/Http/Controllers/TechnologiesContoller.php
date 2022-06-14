<?php

namespace App\Http\Controllers;

use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TechnologiesContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tech_search = $request->input('tech_search');

        $sel_techs = Technology::TechSearch($tech_search)
        ->orderBy('tech_name', 'ASC')
        ->get();

        return view('adminsettings/tech.index', compact('sel_techs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sel_tech = Technology::orderBy('tech_name', 'ASC')->get();

        return view('adminsettings/tech.create', compact('sel_tech'));
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
            'tech_name' => 'required|string|min:3|max:255',
		];

        $messages = [
            'tech_name.required' => 'Technology Name field is required.',
        ];

        $validator = Validator::make($request->all(),$rules, $messages);

        if ($validator->fails()) {
			return redirect('techs')
			->withInput()
			->withErrors($validator);
		}else{
            $data = $request->input();
			try{
				$tech_name = new Technology;
                $tech_name->tech_name = $data['tech_name'];
				$tech_name->save();
				return redirect('technologies')->with('status',"Saved Successfully");
			}
			catch(Exception $e){
				return redirect('technologies')->with('failed',"Operation Failed");
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
        $show_tech = Technology::findOrFail($id);

        return view('adminsettings/tech.edit', compact('show_tech'));
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
			'tech_name' => 'required|string|min:3|max:255',
        ]);

        Technology::where("tech_id", "=", $id)->update($validatedData);


        return redirect('technologies')->with('status',"Technology Updated Successfully"); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $show = Technology::findOrFail($id);
        $show->delete();

        return redirect('technologies')->with('status', 'Sector Deleted');
    }
}
