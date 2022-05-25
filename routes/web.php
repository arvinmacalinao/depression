<?php

use App\Http\Controllers\MapDataController;
use App\Http\Controllers\PsiProjectsController;


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
Route::get('projects', 'PsiProjectsController@index')->name('Projects');
Route::get('project/add', 'PsiProjectsController@new')->name('New Project');
Route::post('projects/store', 'PsiProjectsController@store')->name('project.store');
Route::get('project/{id}/edit', 'PsiProjectsController@edit')->name('Edit Project');
Route::get('projects/gallery', 'PsiProjectsController@projectGallery')->name('gallery');
Route::get('project/{id}/view', 'PsiProjectsController@view')->name('View Project');
Route::get('projects/export/', 'PsiProjectsController@import_to_excel')->name('Download Project To Excel');
Route::get('project/delete/{id}', 'PsiProjectsController@delete')->name('Delete Project');
//Route::get('project/details/details', 'PsiProjectsController@detailsheader');

//Project Details

//PIS
Route::get('project/{id}/PIS/', 'ProjectPISController@index')->name('PIS');
Route::get('project/{id}/PIS/add', 'ProjectPISController@new')->name('New PIS');
Route::post('projects/{id}/PIS/store/{pis_id}', 'ProjectPISController@store')->name('PIS Save');
Route::get('project/{id}/PIS/delete/{pis_id}', 'ProjectPISController@delete')->name('Delete PIS');
Route::get('project/{id}/PIS/edit/{pis_id}', 'ProjectPISController@edit')->name('Edit PIS');

//Products
Route::get('project/{id}/Product/', 'ProjectProductController@index')->name('Product');
Route::get('project/{id}/Product/add', 'ProjectProductController@new')->name('New Product');
Route::post('projects/{id}/Product/store/{prod_id}', 'ProjectProductController@store')->name('Product Save');
Route::get('project/{id}/Product/delete/{prod_id}', 'ProjectProductController@delete')->name('Delete Product');
Route::get('project/{id}/Product/edit/{prod_id}', 'ProjectProductController@edit')->name('Edit Product');

//Monitoring
//Monitoring2

//Equipment
Route::get('project/{id}/Equipment/', 'ProjectEquipmentController@index')->name('Equipment');

Route::get('/getCities/{id}', 'PsiProjectsController@getCities')->name('getCities');
Route::get('/getBarangays/{id}', 'PsiProjectsController@getBarangays')->name('getBarangays');

