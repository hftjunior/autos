<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('profile-update', 'Admin\UserController@profileUpdate')->name('profile.update')->middleware('auth');
Route::get('profile', 'Admin\UserController@profile')->name('profile')->middleware('auth');


Route::middleware(['auth'])->prefix('admin')->namespace('Admin')->group(function(){
    Route::resource('users','UserController');
    Route::resource('roles','RoleController');
    Route::resource('states','StateController');
    Route::get('states-all','StateController@showall');
    Route::resource('cities','CityController');
    Route::get('cities-all/{id}','CityController@showall');
    Route::resource('clients','ClientController');
    Route::any('client-profile/{id}','ClientController@profile');
});

Route::middleware(['auth'])->prefix('vehicle')->namespace('Vehicle')->group(function(){
    Route::resource('categories','VehicleCategoryController');    
    Route::resource('veh-types','VehicleTypeController');
    Route::resource('species','VehicleSpeciesController');
    Route::resource('powers','VehiclePowerController');
    Route::resource('cylinders','VehicleCylinderController');
    Route::resource('fuels','FuelController');
    Route::resource('manufacturers','ManufacturerController');
    Route::resource('models','VehicleModelController');
    Route::get('models-rel/{id}','VehicleModelController@showRelManufacturer');
    Route::resource('vehicles','VehicleController');
});

Route::middleware(['auth'])->prefix('ait')->namespace('Ait')->group(function(){
    Route::resource('agencies','AgencyController');
    Route::resource('gravities','AitGravityController');
    Route::resource('measures','AitMeasureController');
    Route::resource('ait-statuses','AitStatusController');
    Route::resource('ait-types','AitTypeController');
    Route::resource('aits','AitController');
});

Route::middleware(['auth'])->prefix('ait/resource')->namespace('AitResource')->group(function(){
    Route::resource('res-statuses','AitResourceStatusController');
    Route::resource('resources','AitResourceController');
});

Route::middleware(['auth'])->prefix('ait/resource/progress')->namespace('AitResource')->group(function(){
    Route::resource('meanses','AitProgressMeansController');
    Route::resource('origins','AitProgressOriginController');
    Route::resource('progresses','AitResourceProgressController');
});

Route::middleware(['auth'])->prefix('document')->namespace('Document')->group(function(){
    Route::resource('doc-types','DocumentTypeController');
    Route::resource('entities','DocumentEntityController');
    Route::get('entity-id/{id}','DocumentEntityController@identity');
    Route::get('entity-type/{id}','DocumentEntityController@types');
    Route::resource('documents','DocumentController');
});