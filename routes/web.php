<?php

use App\Http\Controllers\MapDataController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'MapDataController@index');
Route::get('map-filter', 'MapFilterController@sort');

// Projects

Route::get('/projects', function () {
    return view('./projects/projects');
});
