<?php

use Illuminate\Support\Facades\Auth;
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

/*
Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::prefix('api')->middleware('auth')->group(function () {
    Route::get('/statistics', 'Api\PlatesController@statisticsData');
    Route::get('/lastMonth', 'Api\PlatesController@lastMonth');
});

Route::middleware('auth')->namespace('Admin')->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', "HomeController@index");
    Route::get('/types', "HomeController@form_checkbox")->name('types');
    Route::get('/order', "HomeController@order")->name('order');
    Route::delete('/d_type/{id}/{where}', "HomeController@delete_type")->name('delete_type');
    Route::resource('/plate',"PlatesController");
    Route::get('/recap', "HomeController@recap")->name("recap");
    Route::get('/statistics', "HomeController@statistics")->name("statistics");
});

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('{any?}', function () { return view('front'); })->where("any",".*");