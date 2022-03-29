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
Route::get('/summary', 'ChartController@index');

// Route::get('/project-summary-regional', 'MapDataController@index');
Route::get('map-filter', 'MapFilterController@sort');

// Projects
Route::get('/projects', 'PsiProjectsController@index')->name('projects');
Route::get('/addproject', 'PsiProjectsController@addproject')->name('addproject');
Route::get('project-list', 'PsiProjectsController@projectList')->name('projlist');
Route::post('projects/store', 'PsiProjectsController@store')->name('project.store');


Route::get('/getCities/{id}', 'PsiProjectsController@getCities')->name('getCities');
Route::get('/getBarangays/{id}', 'PsiProjectsController@getBarangays')->name('getBarangays');

