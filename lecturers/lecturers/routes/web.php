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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/login/custom',[
    'uses' =>'LoginController@login',
    'as' => 'login.custom'
]);

Route::get('/', function () {
    return view('welcome');
});

Route::get('lecturer/', function () {
    return view('lecturer.index');
});

//protect routes
Route::group(['middleware' => 'auth'], function(){

Route::get('lecturer/downloadems', function () {
    return view('lecturer.download');
});

Route::get('lecturer/uploadems', function () {
    return view('lecturer.upload');
});
//upload controllers
Route::get('lecturer/downloademsdept', 'ResultuploadController@indexdept');
Route::get('lecturer/downloadresult', 'ResultuploadController@downloadpdfindex');
Route::get('lecturer/downloadems', 'ResultuploadController@index');
Route::get('lecturer/resultupload', 'ResultuploadController@uploadindex');
Route::get('lecturer/studentlist', 'ResultuploadController@studentlistindex');
Route::post('lecturer/studentlists', 'ResultuploadController@studentlist');
//scorelist
Route::get('lecturer/studentscorelist', 'ResultuploadController@studentscorelistindex');
Route::post('lecturer/studentscorelists', 'ResultuploadController@studentscorelist');

Route::post('lecturer/import', 'ResultuploadController@import');
Route::get('lecturer/export', 'ResultuploadController@export');
Route::get('lecturer/preview', 'ResultuploadController@preview');
Route::post('lecturer/previewd', 'ResultuploadController@previewd');
Route::post('lecturer/previewcontinue', 'ResultuploadController@previewcontinue');
Route::get('lecturer/previewdownload', 'ResultuploadController@previewdownload');
Route::post('lecturer/exportDept', 'ResultuploadController@exportDept');
Route::post('lecturer/downloadPDF', 'ResultuploadController@downloadPDF');

Route::get('lecturer/score', 'ResultuploadController@scoreindex');
Route::post('lecturer/scorestudent', 'ResultuploadController@scorestudent');
Route::post('lecturer/insertscore', 'ResultuploadController@insertscore');

//reset password
Route::get('lecturer/resetpassword', 'ResultuploadController@resetPasswordIndex');
Route::post('lecturer/setpassword', 'ResultuploadController@resetPassword');

Route::get('lecturer/editprofile', 'ResultuploadController@editprofileIndex');
Route::post('lecturer/editprofileaction', 'ResultuploadController@editprofile');

//view result controls
Route::get('mms/', 'MmsController@index');
Route::post('mms/search', 'MmsController@search');

//autoload ajax controller
//begin json ajax search for faculty, deparment and subject combinations
//Route::get('CurriculumManager/searches','AjaxController@jsfaculties');
//Route::get('/json-departments','AjaxController@jsdepartments');
Route::get('/json-programmes', 'AjaxController@jsprogrammes');
Route::get('json-courses', 'AjaxController@jscourses');


});//end group routing to protect pages

Route::get('/clearcache', function() {
    $exitCode = Artisan::call('cache:clear');
    // $exitCode =Artisan::call('route:cache');
    $exitCode =Artisan::call('config:cache');
    $exitCode =Artisan::call('view:clear');
    return 'Application cache cleared';
});

