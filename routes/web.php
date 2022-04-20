<?php

use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\FixDocumentController;

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
    return redirect("/admin");
});

Route::group([
    'middleware' => config('backpack.base.web_middleware', 'web'),
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
], function () {
    Route::post("/user/generateToken/{id}", "Web\UserController@generateToken");
});

Route::get('fixdocument', [FixDocumentController::class, 'fix']); //Delete document and keyword
Route::get('fixalldocument', [FixDocumentController::class, 'truncate_all']); //Delete all document and keyword

Route::get('search', [SearchController::class, 'search']);
