<?php

use App\Http\Controllers\API\BackendAPIController;
use App\Http\Controllers\API\MediaAPIController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'media'], function () {
    Route::post('uploads/rte', [MediaAPIController::class, 'uploadRTE']);
});

Route::group(['prefix' => 'backend'], function () {
    Route::get('weblink-types', [BackendAPIController::class, 'getWeblinkTypes']);
    Route::get('main-menus', [BackendAPIController::class, 'getMainNenus']);
    Route::get('contents/{content}/files', [BackendAPIController::class, 'getContentFiles']);
    Route::get('albums/{album}/gallery', [BackendAPIController::class, 'getGallery']);
    Route::delete('medias/{media}', [BackendAPIController::class, 'deleteMedia']);
});
