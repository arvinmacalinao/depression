<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Region;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationListingCityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $show_province = Province::findOrFail($id);
        $show_region = Region::findOrFail($show_province->region_id);

        $city_search = $request->input('city_search');

        $sel_citys = City::CitySearch($city_search)
        ->where('province_id','=',$id)
        ->get();

        return view('adminsettings/locationlistings/City.index ', compact('sel_citys','show_province','show_region'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $show_province = Province::findOrFail($id);
        $show_region = Region::findOrFail($show_province->region_id);
        $sel_disctricts = District::get();
        $sel_provinces = Province::get();
        return view('adminsettings/locationlistings/City.create', compact('sel_disctricts','show_province','show_region','sel_provinces'));
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
            'city_name' => 'required|string|min:3|max:255',
            'district_id' => 'required',
            'province_id' => 'required',
		];

        $messages = [
            'city_name.required' => 'Name field is required.',
            'district_id.required' => 'District field is required.',
            'province_id.required' => 'District field is required.',
        ];

        $validator = Validator::make($request->all(),$rules, $messages);

        if ($validator->fails()) {
			return redirect()->route('Province.index', $Province)
			->withInput()
			->withErrors($validator);
		}else{
            $data = $request->input();
			try{
				$province = new Province;

                $province->city_name = $data['city_name'];
                $province->district_id = $data['district_id'];
                $province->province_id = $data['province_id'];
                
				$province->save();

				return redirect()->route('City.index', $Province)->with('status',"Saved Successfully");
			}
			catch(Exception $e){
				return redirect()->route('City.index', $Province)->with('failed',"Operation Failed");
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
