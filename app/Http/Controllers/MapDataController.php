<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class MapDataController extends Controller
{
    public function gmaps(){
        $locations = DB::select('select * from map_markers', array(1));
        return view('home.home',compact('locations'));
    }
}
