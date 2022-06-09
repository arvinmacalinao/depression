<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectSection;
use App\Models\ProjectCategory;
use App\Models\ProjectDocumentTypes;
use Illuminate\Support\Facades\Validator;

class ProjectCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projtype_search = $request->input('projtype_search');

        $sel_prjtypes = ProjectCategory::ProjectCategorySearch($projtype_search)
        ->orderBy('prj_type_name', 'ASC')
        ->get();

        return view('adminsettings/projectcat.index', compact('sel_prjtypes',));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sel_prjdoctypes = ProjectDocumentTypes::groupBy('doctype_name')
        ->orderBy('doctype_name', 'ASC')
        ->get();

        $sel_prjsections = ProjectSection::groupBy('section_name')->orderBy('section_name', 'ASC')->get();

        return view('adminsettings/projectcat.create',compact('sel_prjsections','sel_prjdoctypes'));
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
			'prj_type_name' => 'required|string|min:3|max:255',
            'section_ids' => 'required|min:3|max:255',
            'doctype_ids' => 'required|max:255',
            'section_names' => 'required|min:3',
            'doctype_names' => 'required|min:3',
		];

        $messages = [
            'con_type_name.required' => 'Category Name field is required.',
            'section_ids.required' => 'Section field is required.',
            'doctype_ids.required' => 'Document field is required.',
            'section_names.required' => 'Section names field is required.',
            'doctype_names.required' => 'Document Types field is required.',
        ];

        $validator = Validator::make($request->all(),$rules, $messages);

        if ($validator->fails()) {
			return redirect('projectcatergories/create')
			->withInput()
			->withErrors($validator);
		}else{
            $data = $request->input();
			try{
                
				$project_category = new ProjectCategory;

                $impSection_ids = implode(",",$data['section_ids']);
                $impDoctype_ids = implode(",",$data['doctype_ids']);

                $project_category->prj_type_name = $data['prj_type_name'];
                $project_category->section_ids = $impSection_ids;
                $project_category->doctype_ids = $impDoctype_ids;
                $project_category->section_names = $data['section_names'];
                $project_category->doctype_names = $data['doctype_names'];

				$project_category->save();
				return redirect('projectcatergories')->with('status',"Saved Successfully");
			}
			catch(Exception $e){
				return redirect('projectcatergories')->with('failed',"Operation Failed");
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
        $show_projtypes = ProjectCategory::findOrFail($id);
        $sel_prjsections = ProjectSection::groupBy('section_name')->orderBy('section_name', 'ASC')->get();

        $exSel_prjsections = explode(',', $show_projtypes->section_ids);
        $exSel_prjdocu = explode(',', $show_projtypes->doctype_ids);

        $sel_prjdoctypes = ProjectDocumentTypes::groupBy('doctype_name')
        ->orderBy('doctype_name', 'ASC')
        ->get();
        

        return view('adminsettings/projectcat.edit', compact('show_projtypes','sel_prjsections','sel_prjdoctypes','exSel_prjsections','exSel_prjdocu'));
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
			'prj_type_name' => 'required|string|min:3|max:255',
            'section_ids' => 'required|min:3|max:255',
            'doctype_ids' => 'required|max:255',
            'section_names' => 'required|string|min:3',
            'doctype_names' => 'required|string|min:3',
        ]);

        ProjectCategory::where("prj_type_id", "=", $id)->update($validatedData);


        return redirect('projectcatergories')->with('status',"Category Updated Successfully"); 
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
