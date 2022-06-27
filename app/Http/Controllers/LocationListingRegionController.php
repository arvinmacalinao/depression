<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationListingRegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $region_search = $request->input('region_search');

        $sel_regions = Region::RegionSearch($region_search)
        ->get();

        return view('adminsettings/locationlistings/Region.index', compact('sel_regions',));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminsettings/locationlistings/Region.create');
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
			'region_code' => 'required|string|min:3|max:255',
            'region_name' => 'required|string|min:3|max:255',
		];

        $messages = [
            'region_code.required' => 'Code field is required.',
            'region_name.required' => 'Name field is required.',
        ];

        $validator = Validator::make($request->all(),$rules, $messages);

        if ($validator->fails()) {
			return redirect()->back()
			->withInput()
			->withErrors($validator);
		}else{
            $data = $request->input();
			try{
				$regions = new Region;

                $regions->region_code = $data['region_code'];
                $regions->region_name = $data['region_name'];
				$regions->save();

				return redirect('locationlistings/Regions')->with('status',"Saved Successfully");
			}
			catch(Exception $e){
				return redirect('locationlistings/Regions')->with('failed',"Operation Failed");
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
        $show_region = Region::findOrFail($id);

        return view('adminsettings/locationlistings/Region.edit', compact('show_region'));
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
			'region_code' => 'required|string|min:3|max:255',
            'region_id' => 'required',
        ]);

        Region::where("region_id", "=", $id)->update($validatedData);


        return redirect('locationlistings/Regions')->with('status',"Region Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $show = Region::findOrFail($id);
        $show->delete();

        return redirect('locationlistings/Regions')->with('status', 'Region Deleted');
    }
}
