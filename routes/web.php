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
Route::get('/statreport', 'StatusReportController@index');
Route::get('/project-monitoring', 'StatusReportController@index');
Route::get('/project-collage', 'ProjectGalleryController@index')->name('Hehe');
Route::resource('usergroups', 'UserGroupsController');
Route::resource('collabcategories', 'CollabCategoriesController');
Route::get('usergroups/create', 'UserGroupsController@create');
Route::post('store','UserGroupsController@store');
Route::get('usergroup/refactor', 'UserGroupsController@refactor_index');

// Route::post('ugUpdate','UserGroupsController@update');

// Route::get('/project-summary-regional', 'MapDataController@index');
Route::get('map-filter', 'MapFilterController@sort');
Route::get('get-by-year', 'StatusReportFilter@status_sort');
Route::get('get-by-imgid', 'ProjectGalleryController@getImg');
Route::get('usergroups/create/get-by-selid', 'UserGroupsController@getChkData');


// Projects
Route::get('/projects', 'PsiProjectsController@index');
Route::get('/addproject', 'PsiProjectsController@addproject')->name('/addproject');
Route::get('project-list', 'PsiProjectsController@projectList');


Route::get('/getCities/{id}', 'PsiProjectsController@getCities')->name('getCities');
Route::get('/getBarangays/{id}', 'PsiProjectsController@getBarangays')->name('getBarangays');

