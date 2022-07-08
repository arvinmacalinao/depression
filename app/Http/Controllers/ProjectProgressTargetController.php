<?php

namespace App\Http\Controllers;

use App\Models\PsiProject;
use Illuminate\Http\Request;
use App\Models\ProjectProgressTarget;

class ProjectProgressTargetController extends Controller
{
    public function index(Request $request, $id)
	{
        $project = PsiProject::FindorFail($id);
        $targets = ProjectProgressTarget::where('prj_id', $id)->orderby('prjprogtarget_order', 'asc')->get();

		return view('./projects/details/Monitoring2/Targets/index', compact('project', 'targets'));
	}

	public function new($id)
    {
        {   
            $project = PsiProject::FindorFail($id);
            $tar_id = 0;
            $target = new ProjectProgressTarget;

            $ordervalue = ProjectProgressTarget::where('prj_id', $id)->orderby('prjprogtarget_order', 'desc')->first();
            
            return view('./projects/details/Monitoring2/Targets/form', compact('project', 'id', 'tar_id', 'target', 'ordervalue'));
        } 
    }

    public function store(Request $request, $id, $tar_id)
    {   
        
        
        if($tar_id == 0) {

            $ordervalue = $request->get('prjprogtarget_order');
            $sample     = ProjectProgressTarget::where('prj_id', $id)->where('prjprogtarget_order', $ordervalue)->first();        

            $alert 					= 'alert-success';
            $message				= 'New Project Progress Target record successfully added.';
            $request->request->add(['prj_id' => $id]);

            if($sample) {
                $order = ProjectProgressTarget::where('prj_id', $id)->orderby('prjprogtarget_order', 'desc')->first();
                //$order->prjprogtarget_order + 1;
                $request->request->add(['prjprogtarget_order' => $order->prjprogtarget_order + 1]);
            } else {
                $to = $request->get('prjprogtarget_order');
                $request->request->add(['prjprogtarget_order' => $to]);
            }
            $target = ProjectProgressTarget::create($request->all());
            
        } else {
            $alert 					= 'alert-info';
            $message				= 'Project Progress Target record successfully updated.';
            $target = ProjectProgressTarget::FindorFail($tar_id);
            $target->update($request->all());
        }

        return redirect()->route('Progress Reports Targets', $id)->with('message', $message)->with('alert', $alert);
    }

    public function delete($id, $tar_id)
	{
		$alert 					= 'alert-warning';
		$message				= 'Project Progress Target record successfully deleted.';
		$target = ProjectProgressTarget::FindorFail($tar_id);
		$target->delete();

		return redirect()->back()->with('message', $message)->with('alert', $alert);
	}

    public function edit($id, $tar_id)
    {
        $project = PsiProject::FindorFail($id);
        $target = ProjectProgressTarget::FindorFail($tar_id);
        
        return view('./projects/details/Monitoring2/Targets/form', compact('project', 'target', 'id', 'tar_id'));
    }
}
