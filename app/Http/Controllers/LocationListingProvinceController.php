<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationListingProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $show_region = Region::findOrFail($id);

        $province_search = $request->input('province_search');

        $sel_provinces = Province::ProvinceSearch($province_search)
        ->where('region_id','=',$id)
        ->get();

        return view('adminsettings/locationlistings/Province.index', compact('sel_provinces','show_region'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $show_region = Region::findOrFail($id);
        $sel_regions = Region::get();
        return view('adminsettings/locationlistings/Province.create', compact('sel_regions','show_region'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $Region)
    {
        $rules = [
            'province_name' => 'required|string|min:3|max:255',
            'region_id' => 'required',
		];

        $messages = [
            'province_name.required' => 'Name field is required.',
            'region_id.required' => 'Region field is required.',
        ];

        $validator = Validator::make($request->all(),$rules, $messages);

        if ($validator->fails()) {
			return redirect()->route('Province.index', $Region)
			->withInput()
			->withErrors($validator);
		}else{
            $data = $request->input();
			try{
				$province = new Province;

                $province->province_name = $data['province_name'];
                $province->region_id = $data['region_id'];
				$province->save();

				return redirect()->route('Province.index', $Region)->with('status',"Saved Successfully");
			}
			catch(Exception $e){
				return redirect()->route('Province.index', $Region)->with('failed',"Operation Failed");
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
    public function edit($id,$province)
    {

        $show_province = Province::findOrFail($province);
        $show_region = Region::findOrFail($id);
        $sel_regions = Region::get();

        return view('adminsettings/locationlistings/Province.edit', compact('show_province','sel_regions','show_region'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Region, $Province)
    {
        $validatedData = $request->validate([
			'province_name' => 'required|string|min:3|max:255',
            'region_name' => 'required|string|min:3|max:255',
        ]);
        Province::where("province_id", "=", $Province)->update($validatedData);
        return redirect()->route('Province.index', $Region)->with('status',"Province Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($Region, $Province)
    {
        $show = Province::findOrFail($Province);
        $show->delete();

        return redirect()->route('Province.index', $Region)->with('status', 'Province Deleted');
    }
}
