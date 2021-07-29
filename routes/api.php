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

Route::put('/calllog/update-recording-url','Api\CallLogController@update_recording_url')->name('api.calllog.upd_recording_url');