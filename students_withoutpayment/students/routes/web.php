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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/login/custom',[
    'uses' =>'LoginController@login',
    'as' => 'login.custom'
]);
Route::post('getmatric', 'LoginController@getMatric');

Route::group(['middleware' => 'auth'], function(){



Route::post('student/AddOlevel', 'OlevelController@AddOlevel');
Route::post('student/AddJamb', 'OlevelController@AddJamb');
Route::get('student/level', 'OlevelController@thelevel');
//student result page by semester
Route::get('student/resultbysemester', 'ResultController@thelevel');
Route::post('student/semesterresult', 'ResultController@ResultBySemester');

//student result page by level
Route::get('student/resultbylevel', 'ResultController@thelevel2');
Route::post('student/levelresult', 'ResultController@ResultBylevel');

//getting student carryover
Route::get('student/carryover', 'ResultController@CarryOver');


//student profile
Route::get('student/editprofile', 'EditProfileController@showprofile');
Route::post('student/updateinfo', 'EditProfileController@updateInfo');
Route::post('student/editprofiles', 'EditProfileController@editprofile');

Route::get('student/bedas', 'BiodataController@checkbed');
Route::post('student/addbedas', 'BiodataController@addbedas');
Route::resource('student/biodata', 'BiodataController');

Route::resource('student/courseform', 'CourseformController');
Route::get('student/olevel', 'OlevelController@getOlevel');

Route::post('student/registercourse', 'CourseRegistrationController@RegisterCourseform');
Route::resource('student/courseregistration', 'CourseRegistrationController');

Route::get('student/payment', 'PaymentController@payment');  



//Route::get('student/invoice', 'InvoiceController');

Route::get('student/home', function () {
    return view('student.dashboard');
    });

});//end group routing to protect pages

Route::get('student/register', function () {
    return view('student.register');
});
// Route::get('/invoice', function () {
//     return view('invoice');
// });

//Route::post('student/postinvoice', 'InvoiceController');

Route::get('/insert','StudInsertController@insertform');
Route::post('/create','StudInsertController@insert');

Route::get('jsonlga', 'InvoiceController@jslocalgovt');
Route::get('jsonstates', 'InvoiceController@jsstates');

Route::get('student/invoice', 'InvoiceController@invoice');
Route::post('student/postinvoice', 'InvoiceController@postinvoice');
Route::get('student/showinvoice', 'InvoiceController@showinvoice');