<?php

namespace App\Http\Controllers;

use App\Models\CollabAgency;
use Illuminate\Http\Request;
use App\Models\CollabAgencies;
use App\Models\CollabCategories;
use Illuminate\Support\Facades\Validator;

class CollabAgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $agency_search = $request->input('agen_search');
        $cat_search = $request->input('sr_category');

        $sel_agencys = CollabAgencies::AgencyName($agency_search)->Category($cat_search)
        ->orderBy('col_name', 'ASC')
        ->get();

        $sel_cats = CollabCategories::select('*')
        ->orderBy('ot_name', 'ASC')
        ->get();

        return view('adminsettings/collabagency.index', compact('sel_agencys', 'sel_cats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sel_categories = CollabCategories::select('*')
        ->orderBy('ot_name', 'ASC')
        ->get();

        return view('adminsettings/collabagency.create', compact('sel_categories'));
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
            'col_name' => 'required|string|min:3|max:255',
            'col_abbr' => 'required|string|min:2|max:255',
		];

        $messages = [
            'col_name.required' => 'Agency Name field is required.',
            'col_abbr.required' => 'Abbreviation field is required.',
        ];

        $validator = Validator::make($request->all(),$rules, $messages);

        if ($validator->fails()) {
			return redirect('collabagency')
			->withInput()
			->withErrors($validator);
		}else{
            $data = $request->input();
			try{
				$collab_agencies = new CollabAgencies;
                $collab_agencies->col_name = $data['col_name'];
                $collab_agencies->col_abbr = $data['col_abbr'];
                $collab_agencies->ot_id = $data['sr_category'];
				$collab_agencies->save();
				return redirect('collabagency')->with('status',"Saved Successfully");
			}
			catch(Exception $e){
				return redirect('collabagency')->with('failed',"Operation Failed");
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
        $show_agency = CollabAgencies::findOrFail($id);
        $sel_categories = CollabCategories::select('*')
        ->orderBy('ot_name', 'ASC')
        ->get();

        return view('adminsettings/collabagency.edit', compact('show_agency', 'sel_categories'));
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
			'col_name' => 'required|string|min:3|max:255',
            'col_abbr' => 'required|string|min:2|max:255',
        ]);

        CollabAgencies::where("col_id", "=", $id)->update($validatedData);


        return redirect('collabagency')->with('status',"Agency Updated Successfully");  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $show_agency = CollabAgencies::findOrFail($id);
        $show_agency->delete();

        return redirect('collabagency')->with('status', 'Agency Deleted');
    }
}
