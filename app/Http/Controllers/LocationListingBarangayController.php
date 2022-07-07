<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Region;
use App\Models\Barangay;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationListingBarangayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $show_city = City::findOrFail($id);
        $show_province = Province::findOrFail($show_city->province_id);
        $show_region = Region::findOrFail($show_province->region_id);

        $barangay_search = $request->input('barangay_search');

        $sel_barangays = Barangay::BarangaySearch($barangay_search)
        ->where('city_id','=',$id)
        ->get();

        return view('adminsettings/locationlistings/Barangay.index ', compact('sel_barangays','show_city','show_province','show_region'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($City)
    {
        $show_city= City::findOrFail($City);
        $show_province = Province::findOrFail($show_city->province_id);
        $show_region = Region::findOrFail($show_province->region_id);

        $sel_citys = City::get();

        return view('adminsettings/locationlistings/Barangay.create', compact('show_city','show_province','show_region','sel_citys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $City)
    {
        $rules = [
            'barangay_name' => 'required|string|min:3|max:255',
            'city_id' => 'required',
		];

        $messages = [
            'barangay_name.required' => 'Name field is required.',
            'city_id.required' => 'City field is required.',
        ];

        $validator = Validator::make($request->all(),$rules, $messages);

        if ($validator->fails()) {
			return redirect()->route('Barangay.index', $City)
			->withInput()
			->withErrors($validator);
		}else{
            $data = $request->input();
			try{
				$barangay = new Barangay;

                $barangay->barangay_name = $data['barangay_name'];
                $barangay->city_id = $data['city_id'];
                
				$barangay->save();

				return redirect()->route('Barangay.index', $City)->with('status',"Saved Successfully");
			}
			catch(Exception $e){
				return redirect()->route('Barangay.index', $City)->with('failed',"Operation Failed");
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
    public function edit($City, $Barangay)
    {
        $show_barangay = Barangay::findOrFail($Barangay);
        $show_city = City::findOrFail($City);
        $show_province = Province::findOrFail($show_city->province_id);
        $show_region = Region::findOrFail($show_province->region_id);
        $sel_citys = City::get();

        return view('adminsettings/locationlistings/Barangay.edit', compact('show_city','show_province','show_region','sel_citys','show_barangay'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $City, $Barangay)
    {
        $validatedData = $request->validate([
			'barangay_name' => 'required|string|min:3|max:255',
            'city_id' => 'required',
        ]);
        Barangay::where("barangay_id", "=", $Barangay)->update($validatedData);
        return redirect()->route('Barangay.index', $City)->with('status',"Barangay Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($City,$Barangay)
    {
        $show = Barangay::findOrFail($Barangay);
        $show->delete();

        return redirect()->route('Barangay.index', $City)->with('status', 'Barangay Deleted');
    }
}
