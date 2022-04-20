<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectGalleryController extends Controller
{
    public function index () {

        

        $proj_details = DB::table('psi_project_albums')
            ->select("psi_project_albums.*", "psi_projects.prj_title")
            ->leftJoin('psi_projects', 'psi_project_albums.prj_id', '=', 'psi_projects.prj_id')
            ->orderBy('date_encoded', 'DESC')
            ->simplePaginate(15);

        return view("projects.projectgallery", compact('proj_details'));
    }

    public function getImg(){
        $img_album_id = $_GET['img_album_id'];

        $img_datas = DB::table('psi_project_album_photos')
        ->select("photo_file", "photo_filename", "album_id", "photo_id")
        ->where("album_id", "=", $img_album_id)
        ->get();

        return $img_datas;
    }
}
