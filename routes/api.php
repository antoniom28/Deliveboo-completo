<?php

use App\Http\Controllers\Admin\PlatesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get("/plates","Api\PlatesController@index");
Route::get("/users","Api\PlatesController@users"); //prende tutti i ristoranti
Route::get("/type/{type_id}","Api\PlatesController@users_type"); 
Route::get("/user/{id}","Api\PlatesController@user");

Route::get("/searcht/{name}","Api\PlatesController@searchTypes");
Route::get("/searchu/{id}","Api\PlatesController@searchUsers");

Route::get("/allTypes","Api\PlatesController@getAllTypes");
Route::get("/exist/{id}/{order}","Api\PlatesController@userExist");
Route::post("/payment","Api\PlatesController@payment");

Route::get("/card-user/{activity}","Api\PlatesController@getUser"); //prende lo specifico ristorante

Route::get("/types/{typeArr}","Api\PlatesController@getUserFromType"); //prende i ristoranti filtrando per categoria

Route::get('/order/generate', 'Api\PlatesController@generate');
Route::post('/order/make/payment', 'Api\PlatesController@makePayment');

