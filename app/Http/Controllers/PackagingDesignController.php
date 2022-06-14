<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Packaging;
use App\Models\DraftLevel;
use App\Models\PsiProject;
use Illuminate\Http\Request;
use App\Models\PackagingDesign;

class PackagingDesignController extends Controller
{
    public function index($id, $pack_id)
    {
        $project = PsiProject::FindorFail($id);
        $packaging = Packaging::FindorFail($pack_id);
        $designs = PackagingDesign::where('pkg_id', $pack_id)->Orderby('last_updated', 'desc')->get();

        return view('./projects/details/Packaging/Design/index', compact('project', 'packaging', 'designs'));    
    }

    public function new($id, $pack_id)
    {
        {   $alert 					= 'alert-danger';
			$message				= 'Final Draft has been already added.';
            $project = PsiProject::FindorFail($id);
            $packaging = Packaging::find($pack_id);
            $des_id = 0;

            $draft_id = PackagingDesign::where('pkg_id', $pack_id)->pluck('draftlevel_id');

            $sel_drafts = DraftLevel::whereNotIn('draftlevel_id', $draft_id)->Orderby('draftlevel_id', 'asc')->get();

            $pgkdesign = PackagingDesign::where('pkg_id',$pack_id);


            $pgkcount = $pgkdesign->count();
            $design = new PackagingDesign;
            if($pgkcount == 3)
            {
            return redirect()->back()->with('message', $message)->with('alert', $alert);
            }
            else
            {
            return view('./projects/details/Packaging/Design/form', compact('project', 'packaging', 'design', 'id', 'pack_id', 'des_id', 'sel_drafts'));
            }
        } 
    }

    public function store(Request $request, $id, $pack_id, $des_id)
    {   
        $now            = date('Ymdhis');        
        if ($request->hasFile('design_image1')) {
            $attachment     = $request->file('design_image1');
            $extension      = $attachment->getClientOriginalExtension();
            $orig_name      = $attachment->getClientOriginalName();
            $image1         = $now.'_'.$orig_name.'.'.$extension;

            $attachment->storeAs('public/uploads/designs/', $image1);            
        } else {
            $image1         = NULL;
        }
    
        if ($request->hasFile('design_image2')) {
            $attachment2    = $request->file('design_image2');
            $extension2     = $attachment2->getClientOriginalExtension();
            $orig_name2     = $attachment2->getClientOriginalName();
            $image2         = $now.'_'.$orig_name2.'.'.$extension2;

            $attachment2->storeAs('public/uploads/designs/', $image2);            
        } else {
            $image2         = NULL;
        }


        if($des_id == 0) {
            $alert 					= 'alert-success';
			$message				= 'New Packaging & Labeling Designs record successfully added.';
            $request->request->add(['pkg_id' => $pack_id]);
            $request->request->add(['design_date' => $now]);
            
            $design = PackagingDesign::create($request->except(['design_image1', 'design_image2']));
            $design->update(['design_image1' => $image1, 'design_image2' => $image2]);
        } 
        else {
            $alert 					= 'alert-info';
			$message				= 'Packaging & Labeling Designs record successfully updated.';
            $design = PackagingDesign::find($des_id);
            $design->update($request->except(['design_image1', 'design_image2']));

            if($request->hasFile('design_image1')){
            $design->update(['design_image1' => $image1]);
            }
            if($request->hasFile('design_image2')){
                $design->update(['design_image2' => $image2]);
            }
           
        }
        
        return redirect()->route('Designs', [$id, $pack_id])->with('message', $message)->with('alert', $alert);
    }

    public function delete($id, $pack_id, $des_id)
	{
		$alert 					= 'alert-warning';
		$message				= 'Project Packaging & Labeling record successfully deleted.';
		$design = PackagingDesign::find($des_id);
		$design->delete();

		return redirect()->back()->with('message', $message)->with('alert', $alert);
	}

    public function edit($id, $pack_id, $des_id)
    {
        $project = PsiProject::FindorFail($id);
        $packaging = Packaging::Find($pack_id);
        $design = PackagingDesign::Find($des_id);


        

        $sel_drafts = DraftLevel::Orderby('draftlevel_id', 'asc')->get();
        
        return view('./projects/details/Packaging/Design/form', compact('project', 'id', 'pack_id', 'packaging', 'design' , 'des_id', 'sel_drafts'));    
    }


}
