<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class MapDataController extends Controller
{
    public function gmaps(){
        $locations = DB::table('map_markers')->get();
        return view('home.home',compact('locations'));
    }
}
