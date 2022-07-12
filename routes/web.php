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
Route::get('/statreport', 'StatusReportController@index');
Route::get('/project-monitoring', 'StatusReportController@index');
Route::get('/project-collage', 'ProjectGalleryController@index')->name('Hehe');

Route::resource('usergroups', 'UserGroupsController');
Route::resource('collabcategories', 'CollabCategoriesController');
Route::resource('collabagency', 'CollabAgencyController');
Route::resource('consultcategory', 'ConsultCategoryController');
Route::get('documentcategory/{documentcategory}/refactor', 'DocumentCategoryController@refractor_index')->name('documentcategory.refactor');
Route::match(['put', 'patch'],'documentcategory/{documentcategory}/update', 'DocumentCategoryController@refactor_update')->name('documentcategory.refupdate');
Route::resource('documentcategory', 'DocumentCategoryController');
Route::get('equipmentnames/{documentcategory}/refactor', 'EquipmentNameController@refractor_index')->name('equipmentnames.refactor');
Route::match(['put', 'patch'],'equipmentnames/{documentcategory}/update', 'EquipmentNameController@refactor_update')->name('equipmentnames.refupdate');
Route::resource('equipmentnames', 'EquipmentNameController');
Route::resource('organizationcategories', 'OrganizationCategoryController');
Route::resource('productunits', 'ProductUnitsController');
Route::resource('projectcategories', 'ProjectCategoryController');
Route::resource('activitycategories', 'ActivityCategoriesController');
Route::resource('sectors', 'SectorController');
Route::resource('technologies', 'TechnologiesContoller');
Route::resource('coursecategory', 'CourseCategoryController');
Route::resource('course', 'CourseController');
Route::resource('scholarprograms', 'ScholarProgramsController');
Route::resource('schools', 'SchoolController');
Route::resource('locationlistings/Regions', 'LocationListingRegionController');

Route::resource('locationlistings/{Region}/Province', 'LocationListingProvinceController');
Route::resource('locationlistings/{Province}/City', 'LocationListingCityController');
Route::resource('locationlistings/{City}/Barangay', 'LocationListingBarangayController');
Route::resource('users', 'UserController');

Route::resource('usergroups', 'UserGroupController');

// Route::get('usergroups/create', 'UserGroupsController@create');
// Route::post('store','UserGroupsController@store');
// Route::get('usergroup/refactor', 'UserGroupsController@refactor_index');

// Route::post('ugUpdate','UserGroupsController@update');

// Route::get('/project-summary-regional', 'MapDataController@index');
Route::get('map-filter', 'MapFilterController@sort');
Route::get('get-by-year', 'StatusReportFilter@status_sort');
Route::get('get-by-imgid', 'ProjectGalleryController@getImg');
Route::get('usergroups/create/get-by-selid', 'UserGroupsController@getChkData');


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
Route::post('project/{id}/PIS/store/{pis_id}', 'ProjectPISController@store')->name('PIS Save');
Route::get('project/{id}/PIS/delete/{pis_id}', 'ProjectPISController@delete')->name('Delete PIS');
Route::get('project/{id}/PIS/edit/{pis_id}', 'ProjectPISController@edit')->name('Edit PIS');

//Products
Route::get('project/{id}/Product/', 'ProjectProductController@index')->name('Product');
Route::get('project/{id}/Product/add', 'ProjectProductController@new')->name('New Product');
Route::post('project/{id}/Product/store/{prod_id}', 'ProjectProductController@store')->name('Product Save');
Route::get('project/{id}/Product/delete/{prod_id}', 'ProjectProductController@delete')->name('Delete Product');
Route::get('project/{id}/Product/edit/{prod_id}', 'ProjectProductController@edit')->name('Edit Product');

//Monitoring
//Monitoring2

//Equipment
Route::get('project/{id}/Equipment/', 'ProjectEquipmentController@index')->name('Equipment');
Route::get('project/{id}/Equipment/add', 'ProjectEquipmentController@new')->name('New Equipment');
Route::post('project/{id}/Equipment/store/{eq_id}', 'ProjectEquipmentController@store')->name('Equipment Save');
Route::get('project/{id}/Equipment/edit/{eq_id}', 'ProjectEquipmentController@edit')->name('Edit Equipment');
Route::get('project/{id}/Equipment/delete/{eq_id}', 'ProjectEquipmentController@delete')->name('Delete Equipment');
Route::get('project/{id}/Equipment/{eq_id}/view', 'ProjectEquipmentController@view')->name('View Equipment');

//Calibration
Route::get('project/{id}/Calibration/', 'ProjectCalibrationController@index')->name('Calibration');
Route::get('project/{id}/Calibration/add', 'ProjectCalibrationController@new')->name('New Calibration');
Route::post('project/{id}/Calibration/store/{cal_id}', 'ProjectCalibrationController@store')->name('Calibration Save');
Route::get('project/{id}/Calibration/edit/{cal_id}', 'ProjectCalibrationController@edit')->name('Edit Calibration');
Route::get('project/{id}/Calibration/delete/{cal_id}', 'ProjectCalibrationController@delete')->name('Delete Calibration');

//Packaging and Labeling
Route::get('project/{id}/Packaging/', 'ProjectPackagingController@index')->name('Packaging');
Route::get('project/{id}/Packaging/add', 'ProjectPackagingController@new')->name('New Packaging');
Route::post('project/{id}/Packaging/store/{pack_id}', 'ProjectPackagingController@store')->name('Packaging Save');
Route::get('project/{id}/Packaging/edit/{pack_id}', 'ProjectPackagingController@edit')->name('Edit Packaging');
Route::get('project/{id}/Packaging/delete/{pack_id}', 'ProjectPackagingController@delete')->name('Delete Packaging');
Route::get('project/{id}/Packaging/{pack_id}/view', 'ProjectPackagingController@view')->name('View Packaging');
//(Packaging Design)
Route::get('project/{id}/Packaging/{pack_id}/Design/', 'PackagingDesignController@index')->name('Designs');
Route::get('project/{id}/Packaging/{pack_id}/Design/add', 'PackagingDesignController@new')->name('New Design');
Route::post('project/{id}/Packaging/{pack_id}/store/{des_id}', 'PackagingDesignController@store')->name('Design Save');
Route::get('project/{id}/Packaging/{pack_id}/delete/{des_id}', 'PackagingDesignController@delete')->name('Delete Design');
Route::get('project/{id}/Packaging/{pack_id}/edit/{des_id}', 'PackagingDesignController@edit')->name('Edit Design');

//Consultancy
Route::get('project/{id}/Consultancy/', 'ProjectConsultancyController@index')->name('Consultancy');
Route::get('project/{id}/Consultancy/add', 'ProjectConsultancyController@new')->name('New Consultancy');
Route::post('project/{id}/Consultancy/store/{con_id}', 'ProjectConsultancyController@store')->name('Consultancy Save');
Route::get('project/{id}/Consultancy/edit/{con_id}', 'ProjectConsultancyController@edit')->name('Edit Consultancy');
Route::get('project/{id}/Consultancy/delete/{con_id}', 'ProjectConsultancyController@delete')->name('Delete Consultancy');
// Route::get('project/{id}/Consultancy/{con_id}/view', 'ProjectConsultancyController@view')->name('View Consultancy');
//(Consultancy Documents)
Route::get('project/{id}/Consultancy/{con_id}/Documents/', 'ConsultancyDocumentsController@index')->name('Consultancy Documents');
Route::get('project/{id}/Consultancy/{con_id}/Documents/add', 'ConsultancyDocumentsController@new')->name('New Documents');




Route::get('/getCities/{id}', 'PsiProjectsController@getCities')->name('getCities');
Route::get('/getBarangays/{id}', 'PsiProjectsController@getBarangays')->name('getBarangays');

