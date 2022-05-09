<?php

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

Route::group(['middleware' => ['auth:sanctum']], function () {
  // Protect Route With Laravel Sanctum
});


Route::group(['middleware' => ['auth:api']], function () {
  Route::post('/documents/store', 'Api\DocumentController@store');
  Route::get('/documents/search', 'Api\DocumentController@search');
  Route::get('/documents/get', 'Api\DocumentController@get');
});
