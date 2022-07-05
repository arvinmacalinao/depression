<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Brand;
use App\Models\Quarter;
use App\Models\Barangay;
use App\Models\Province;
use App\Models\PsiProject;
use App\Models\ProjectSite;
use Illuminate\Http\Request;

class ProjectSiteController extends Controller
{
    public function index(Request $request, $id)
	{
        $site_brand = $request->get('qbrand');
        $site_year = $request->get('qyear');
        $site_search = $request->get('qsearch');
        // $site_qtr = $request->get('qqtr');
		
        $sel_brands = Brand::get();
        $sel_qtrs = Quarter::get();

        $project = PsiProject::FindorFail($id);
        $sites = ProjectSite::where('prj_id', $id)->SiteBrand($site_brand)->SiteYear($site_year)->SiteYear($site_search)->paginate(20);
    
		return view('./projects/details/Sites/index', compact('project', 'sites', 'sel_brands', 'sel_qtrs', 'site_search'))->with('i', ($request->input('page', 1) - 1) * 20);    
	}
    

    public function new($id)
    {
        {   
            $project        =   PsiProject::FindorFail($id);
            $ps_id         =   0;
            
            $sel_brands = Brand::orderBy('brand_name', 'asc')->get();
            $sel_provinces = Province::where('region_id', $project->region_id)->get();
            
            $site = new ProjectSite;

            return view('./projects/details/Sites/form', compact('project', 'site', 'id', 'ps_id', 'sel_brands', 'sel_provinces'));
        }
    }

    public function store(Request $request, $id, $ps_id)
    {
        
        if($ps_id == 0) {
            $alert 					= 'alert-success';
			$message				= 'New Project Site record successfully added.';
            $request->request->add(['prj_id' => $id]);
            $site = ProjectSite::create($request->all());

        } else {
            $alert 			= 'alert-info';
			$message		= 'Project Site record successfully updated.';
            $site           = ProjectSite::find($ps_id);
            $site->update($request->all());
        }

        return redirect()->route('Sites', $id)->with('message', $message)->with('alert', $alert);
    }

    public function delete($id, $ps_id)
	{
		$alert 		        = 'alert-warning';
		$message	        = 'Project Site record successfully deleted.';
        $site               = ProjectSite::find($ps_id);
		$site->delete();

		return redirect()->back()->with('message', $message)->with('alert', $alert);
	}

    public function edit($id, $ps_id)
    {
        $project = PsiProject::FindorFail($id);
        $site = ProjectSite::Find($ps_id);

        $sel_brands = Brand::orderBy('brand_name', 'asc')->get();
        $sel_provinces = Province::where('region_id', $project->region_id)->get();
        $sel_cities = City::where('province_id', $site->province_id)->get();
        $sel_barangays = Barangay::where('city_id', $site->city_id)->get();
        
        return view('./projects/details/Sites/form', compact('project', 'id', 'ps_id', 'site', 'sel_brands', 'sel_provinces', 'sel_cities', 'sel_barangays'));    
    }
}
