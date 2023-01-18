<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('basic_material','\App\Http\Controllers\BasicMaterialController');
Route::resource('finished_material','\App\Http\Controllers\FinishedMaterialController');
Route::resource('detail_basic_material','\App\Http\Controllers\DetailBasicMaterialController');
Route::resource('detail_finished_material','\App\Http\Controllers\DetailFinishedMaterialController');