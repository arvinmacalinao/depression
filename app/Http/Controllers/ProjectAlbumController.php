<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\PsiProject;
use App\Models\ProjectAlbum;
use Illuminate\Http\Request;
use App\Models\ProjectAlbumType;
use App\Models\ProjectAlbumPhoto;

class ProjectAlbumController extends Controller
{
    public function index(Request $request, $id)
    {
        $project = PsiProject::FindorFail($id);

        // $con_cat = $request->get('qcat');
        // $con_year = $request->get('qyear');
        // $con_qtr = $request->get('qqtr');

        // $sel_category = ConsultancyType::orderBy('con_type_id', 'asc')->get();
        // $sel_years = Consultancy::groupBy('con_end_yr')->orderBy('con_end_yr', 'asc')->get();
        // $sel_quarters = Quarter::orderBy('quarter_id', 'asc')->get();

        $albums = ProjectAlbum::where('prj_id', $id)->get();

        return view('./projects/details/Album/index', compact('project', 'albums'));
    }

    public function new($id)
    {
        {   
            $project        =   PsiProject::FindorFail($id);
            $album_id       =   0;
            
            $sel_types  =   ProjectAlbumType::get();
            
            $album = new ProjectAlbum;

            return view('./projects/details/Album/form', compact('project', 'album', 'id', 'album_id', 'sel_types'));    
        } 
    }

    public function store(Request $request, $id, $album_id)
    {   
        $now  = date('Ymdhis');

        if($album_id == 0) 
        {
            $alert 					= 'alert-success';
			$message				= 'New Project Album record successfully added.';
            $request->request->add(['prj_id' => $id]);
            $album = ProjectAlbum::create($request->all());

            //SAVE all images to Album photos table
            $last_id = $album->album_id;
            if ($request->hasFile('album_photos'))
            {
                $attachments = $request->file('album_photos');
                foreach($attachments as $photo)
                {
                    $extension      = $photo->getClientOriginalExtension();
                    $orig_name      = $photo->getClientOriginalName();
                    $filename       = explode('.',$orig_name)[0];
                    $image          = $now.'_'.$orig_name;
                    $photo->storeAs('public/uploads/images/', $image);
                    ProjectAlbumPhoto::create([
                        'album_id' => $last_id,
                        'photo_file' => $image,
                        'photo_filename' => $filename,
                    ]);
                }      
            } 
            else
            {
                $image = null;
            }
        }
        else 
        {
            $alert 					= 'alert-info';
			$message				= 'Project Album record successfully updated.';
            $album = ProjectAlbum::find($album_id);
            $album->update($request->all());

            if ($request->hasFile('album_photos'))
            {
                $photo = ProjectAlbumPhoto::where('album_id', $album_id);
                $photo->delete();

                $attachments = $request->file('album_photos');
                foreach($attachments as $photo)
                {
                    $extension      = $photo->getClientOriginalExtension();
                    $orig_name      = $photo->getClientOriginalName();
                    $filename       = explode('.',$orig_name)[0];
                    $image          = $now.'_'.$orig_name;
                    $photo->storeAs('public/uploads/images/', $image);
                    ProjectAlbumPhoto::create([
                        'album_id' => $album_id,
                        'photo_file' => $image,
                        'photo_filename' => $filename,
                    ]);
                }      
            }
        }

        return redirect()->route('Project Album', $id)->with('message', $message)->with('alert', $alert);
    }

    public function edit($id, $album_id)
    {
        $project = PsiProject::FindorFail($id);
        $album = ProjectAlbum::Find($album_id);
        $photos = ProjectAlbumPhoto::where('album_id', $album_id)->get();
    
        $sel_types  =   ProjectAlbumType::get();

        return view('./projects/details/Album/form', compact('project', 'id', 'album', 'album_id', 'sel_types', 'photos'));    
    }

    public function delete($id, $album_id)
	{
		$alert 					= 'alert-warning';
		$message				= 'Consultancy successfully deleted.';
		$album = ProjectAlbum::find($album_id);
        $photo = ProjectAlbumPhoto::where('album_id', $album_id)->get();
        $photo->delete();
		$album->delete();

		return redirect()->back()->with('message', $message)->with('alert', $alert);
	}

    public function view($id, $album_id)
	{
		$project = PsiProject::FindorFail($id);
        $album = ProjectAlbum::find($album_id);

        $photos = ProjectAlbumPhoto::where('album_id', $album_id)->get();

		return view('./projects/details/Album/view', compact('project', 'album', 'photos'));    
	}
}
