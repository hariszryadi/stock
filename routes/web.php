<?php

use App\Http\Controllers\RecapBasicMaterialController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::resource('basic_material','\App\Http\Controllers\BasicMaterialController');
Route::resource('finished_material','\App\Http\Controllers\FinishedMaterialController');
Route::resource('basic_material_in','\App\Http\Controllers\BasicMaterialInController');
Route::resource('finished_material_in','\App\Http\Controllers\FinishedMaterialInController');
Route::resource('basic_material_out','\App\Http\Controllers\BasicMaterialOutController');
Route::resource('finished_material_out','\App\Http\Controllers\FinishedMaterialOutController');
Route::resource('user', '\App\Http\Controllers\UserController');

Route::get('/recap_basic_material', 'App\Http\Controllers\RecapBasicMaterialController@index')->name('recap_basic_material.index');
Route::post('/recap_basic_material/get_recap', 'App\Http\Controllers\RecapBasicMaterialController@getRecap')->name('recap_basic_material.getRecap');
Route::get('/recap_finished_material', 'App\Http\Controllers\RecapFinishedMaterialController@index')->name('recap_finished_material.index');
Route::post('/recap_finished_material/get_recap', 'App\Http\Controllers\RecapFinishedMaterialController@getRecap')->name('recap_finished_material.getRecap');

Route::get('/import_basic/print/{id}', 'App\Http\Controllers\ImportController@print_basic')->name('import_basic.print');
Route::get('/import_finished/print/{id}', 'App\Http\Controllers\ImportController@print_finished')->name('import_finished.print');