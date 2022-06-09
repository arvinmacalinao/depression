<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentCategory;
use App\Models\ProjectDocuments;
use App\Models\DocumentCategories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DocumentCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $docu_search = $request->input('docu_search');

        $sel_docus = DocumentCategories::DocumentSearch($docu_search)
        ->select(['psi_project_document_types.doctype_id AS doctype_id','psi_project_document_types.doctype_name AS doctype_name','psi_project_document_types.doctype_abbr AS doctype_abbr', 'psi_project_document_types.encoder AS encoder','psi_project_document_types.last_updated AS last_updated','psi_project_document_types.updater AS updater','vwpsi_project_document_type_counts.prj_count AS prj_count'])
        ->leftJoin('vwpsi_project_document_type_counts', 'vwpsi_project_document_type_counts.doctype_id', '=', 'psi_project_document_types.doctype_id')
        ->leftJoin('vwpsi_project_document_type_projects', 'vwpsi_project_document_type_projects.doctype_id', '=', 'psi_project_document_types.doctype_id')
        ->orderBy('doctype_name', 'ASC')
        ->where('deleted_at', null)
        ->get();

        return view('adminsettings/docucat.index', compact('sel_docus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminsettings/docucat.create');
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
			'doctype_name' => 'required|string|min:3|max:255',
            'doctype_abbr' => 'required|string|min:2|max:255',
		];

        $messages = [
            'doctype_name.required' => 'Category Name field is required.',
            'doctype_abbr.required' => 'Acronym field is required.',
        ];

        $validator = Validator::make($request->all(),$rules, $messages);

        if ($validator->fails()) {
			return redirect('documentcategory/create')
			->withInput()
			->withErrors($validator);
		}else{
            $data = $request->input();
			try{
				$document_cat = new DocumentCategories;
                $document_cat->doctype_name = $data['doctype_name'];
                $document_cat->doctype_abbr = $data['doctype_abbr'];

				$document_cat->save();
				return redirect('documentcategory')->with('status',"Saved Successfully");
			}
			catch(Exception $e){
				return redirect('documentcategory')->with('failed',"Operation Failed");
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
        $show_doctypecat = DocumentCategories::findOrFail($id);

        return view('adminsettings/docucat.edit', compact('show_doctypecat'));
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
            'doctype_name' => 'required|string|min:3|max:255',
            'doctype_abbr' => 'required|string|min:2|max:255',
        ]);

        DocumentCategories::where("doctype_id", "=", $id)->update($validatedData);


        return redirect('documentcategory')->with('status',"Updated Successfully");  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $show = DocumentCategories::findOrFail($id);
        $show->delete();

        return redirect('documentcategory')->with('status', 'Category Deleted');
    }

    public function refractor_index($id){
        $show_doctyperefrac = DocumentCategories::findOrFail($id);

        $sel_doctypes = DocumentCategory::select('*')
        ->orderBy('doctype_name', 'ASC')
        ->get();

        return view('adminsettings/docucat.refractor', compact('show_doctyperefrac', 'sel_doctypes'));
    }

    public function refactor_update(Request $request, $id){

        $validatedData = $request->validate([
            'doctype_id' => 'required|string|min:2|max:255',
        ]);

        ProjectDocuments::where("doctype_id", "=", $id)->update($validatedData);


        return redirect('documentcategory')->with('status',"Refactored Successfully");   
    }
}
