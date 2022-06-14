<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sector_search = $request->input('sector_search');

        $sel_sectors = Sector::SectorSearch($sector_search)
        ->orderBy('sector_name', 'ASC')
        ->get();

        return view('adminsettings/sectors.index', compact('sel_sectors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sel_sector = Sector::orderBy('sector_name', 'ASC')->get();

        return view('adminsettings/sectors.create', compact('sel_sector'));
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
            'sector_name' => 'required|string|min:3|max:255',
		];

        $messages = [
            'sector_name.required' => 'Sector Name field is required.',
        ];

        $validator = Validator::make($request->all(),$rules, $messages);

        if ($validator->fails()) {
			return redirect('sectors')
			->withInput()
			->withErrors($validator);
		}else{
            $data = $request->input();
			try{
				$sector_name = new Sector;
                $sector_name->sector_name = $data['sector_name'];
				$sector_name->save();
				return redirect('sectors')->with('status',"Saved Successfully");
			}
			catch(Exception $e){
				return redirect('sectors')->with('failed',"Operation Failed");
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
        $show_sector = Sector::findOrFail($id);

        return view('adminsettings/sectors.edit', compact('show_sector'));
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
			'sector_name' => 'required|string|min:3|max:255',
        ]);

        Sector::where("sector_id", "=", $id)->update($validatedData);


        return redirect('sectors')->with('status',"Sector Updated Successfully"); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $show = Sector::findOrFail($id);
        $show->delete();

        return redirect('sectors')->with('status', 'Sector Deleted');
    }
}
