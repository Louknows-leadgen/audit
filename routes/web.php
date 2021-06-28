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

// Route::get('/template',function(){
// 	return view('template');
// });

// Route::get('/template1',function(){
// 	return view('template1');
// });

Route::get('/manual/run','TestController@update_url')->name('test.run');
//Route::get('/call-logs/audited-by-agents','CallLogController@audited_by_agents')->name('call.audited_agents');
// Route::get('/call-logs/search-form','CallLogController@search_form')->name('call.search_form');
Route::get('/call-logs/search','CallLogController@search')->name('call.search');
Route::post('/call-logs/tag','CallLogController@tag_call')->name('call.tag');

Route::get('/','SuperAdminController@index')->name('root');
Route::get('/admin','AdminController@index')->name('admin.index');

Route::get('/account','UserController@index')->name('user.index');
Route::put('/account/update','UserController@update_account')->name('user.update_account');
Route::put('/account/password/update','UserController@update_password')->name('user.update_password');

Route::get('/auditor','AuditorController@index')->name('auditor.index');
Route::get('/auditor/my-logs','AuditorController@my_call_logs')->name('auditor.my_call_logs');
Route::get('/auditor/my-logs/completed','AuditorController@my_call_logs_completed')->name('auditor.my_call_logs_completed');
Route::get('/auditor/my-logs/completed/{recording}','AuditorController@recording_completed')->name('auditor.recording_completed');
Route::get('/auditor/team-claimed','AuditorController@team_claimed_logs')->name('auditor.team_claimed');
Route::get('/auditor/my-logs/{recording}','AuditorController@recording')->name('auditor.recording');
Route::post('/auditor/my-logs/{ctr}/destroy','AuditorController@destroy_mylog')->name('auditor.destroy_mylog');
Route::post('/auditor/claim_call','AuditorController@claim_call')->name('auditor.claim_call');
Route::post('/auditor/bulk_claim','AuditorController@bulk_claim')->name('auditor.bulk_claim');
Route::post('/auditor/submit_audit','AuditorController@submit_audit')->name('auditor.submit_audit');
Route::get('/auditor/my-audits','AuditorController@audits_form_page')->name('auditor.my-audits');
Route::get('/auditor/count-audits','AuditorController@audits_form_page_count')->name('auditor.count-audits');

Route::get('/reports','ReportController@index')->name('report.index');
Route::get('/reports/calllog-responses','ReportController@calllog_responses')->name('report.calllog_responses');
Route::get('/reports/auditors-hourly','ReportController@auditors_hourly')->name('report.auditors_hourly');
Route::post('/reports/auditors_hourly_content','ReportController@auditors_hourly_content')->name('report.auditors_hourly_content');
Route::post('/download/calllog-responses','DownloadController@downloadCallLogResponses')->name('dl.calllog_responses');

Route::resource('findings','FindingController')->only(['store']);

Route::get('/supervisor','SupervisorController@index')->name('supervisor.index');
// Route::get('/search-calls','SupervisorController@search_calls')->name('supervisor.search_calls');
// Route::get('/search','SupervisorController@search')->name('supervisor.search');
Route::post('/assign-calls','SupervisorController@assign_calls')->name('supervisor.assign_calls');
Route::get('/supervisor/manage-teams','SupervisorController@manage_teams')->name('supervisor.manage_teams');
Route::get('/supervisor/call-assignment-preference','SupervisorController@assign_preference')->name('supervisor.assign_preference');
Route::get('/supervisor/call-assignment-preference/{id}/edit','SupervisorController@assign_preference_edit')->name('supervisor.assign_preference_edit');
Route::get('/supervisor/call-assignment-preference/new','SupervisorController@assign_preference_new')->name('supervisor.assign_preference_new');
Route::post('/supervisor/call-assignment-preference/create','SupervisorController@assign_preference_create')->name('supervisor.assign_preference_create');
Route::post('/supervisor/call-assignment-preference/{id}/update','SupervisorController@assign_preference_update')->name('supervisor.assign_preference_update');

Route::resource('teams','TeamController')->only(['show','update','store','destroy']);

Route::resource('user_teams','UserTeamController')->only(['store','destroy']);


Route::get('/operation','OperationAuditorController@index')->name('ops.index');
Route::get('/operation/search/{type}','OperationAuditorController@search')->name('ops.search');
Route::get('/operation/audited/{recording}','OperationAuditorController@audited')->name('ops.audited');
Route::get('/operation/recordings/{ops_user}/{ctr}','OperationAuditorController@recording')->name('ops.recording');
Route::post('/operation/submit_audit','OperationAuditorController@submit_audit')->name('ops.submit_audit');
Route::get('/operation/my-audits','OperationAuditorController@my_audits')->name('ops.my_audits');
Route::delete('/operation/my-audits/{ctr}','OperationAuditorController@destroy_audit')->name('ops.destroy_audit');
Route::get('/operation/my-audits/{ctr}','OperationAuditorController@show')->name('ops.show');
Route::get('/operation/search-preference','OperationAuditorController@search_preference')->name('ops.search_preference');

Auth::routes();




// Route::resource('products','ProductController');