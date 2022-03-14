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

Route::get('/', 'MapDataController@gmaps');


// Projects

Route::get('/addproject', function () {
    return view('./projects/addproject');
});

Route::get('/projects', 'PsiProjectsController@index');



