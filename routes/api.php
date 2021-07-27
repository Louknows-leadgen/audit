<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/recording/check-url','Api\RecordingController@check_url')->name('api.recording.check_url');
Route::get('/recording/{server}/{date}/{filename}','Api\RecordingController@recording_url')->name('api.recording.recording_url');