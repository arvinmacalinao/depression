<?php

namespace App\Http\Controllers;
use App\Markers;
use Illuminate\Http\Request;

class MapDataController extends Controller
{
    public function index(){
        $markers = Markers::all();
        return view('home.home', compact('markers'));
    }
}
