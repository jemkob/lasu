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

//Auth::routes();


//protect routes
Route::group(['middleware' => 'auth'], function(){

    Route::get('/home', 'HomeController@index')->name('home');

Route::get('minmax', 'MinmaxController@index');
Route::post('minmax/update', 'MinmaxController@update');
//Fresher upload
Route::post('studentmanager/importfresher', 'StudentManagerController@import');
Route::get('studentmanager/fresher', 'StudentManagerController@fresherindex');

Route::post('studentmanager/importcur', 'StudentManagerController@importCurriculum');
Route::get('studentmanager/cur', 'StudentManagerController@curindex');

Route::get('updateserrors', 'StudentManagerController@updateserrors');

Route::get('student/payment', 'PaymentController@payment');
Route::post('student/verifypayment', 'PaymentController@verifyPayment');

//change of department
Route::get('studentmanager/changedept', 'StudentManagerController@changedeptindex');
Route::post('studentmanager/changedept', 'StudentManagerController@changedept');
Route::get('json-student', 'StudentManagerController@jsonstudent');

Route::get('probation', 'StudentManagerController@probation');

Route::get('promote300', 'StudentManagerController@promote300');
Route::post('studentmanager/search', 'StudentManagerController@searchStudent');
Route::get('search', 'StudentManagerController@searchview');
Route::get('promote', 'StudentManagerController@promoteview');
Route::post('studentmanager/promote', 'StudentManagerController@promote');
Route::post('studentmanager/deletestudent', 'StudentManagerController@deleteStudent');
Route::resource('studentmanager', 'StudentManagerController');

Route::get('matric/generate', 'MatricController@generateMatric');
Route::get('matric/generated', 'MatricController@generated');
Route::resource('matric', 'MatricController');

Route::get('schoolmanager/delete', 'SchoolController@deleteSchool');
Route::resource('schoolmanager', 'SchoolController');

Route::post('course/search', 'CourseController@searchCourse');
Route::get('course/delete', 'CourseController@deleteCourse');
Route::resource('course', 'CourseController');

Route::resource('sessionmanager', 'SessionController');

Route::resource('usermanager', 'UserController');

Route::post('staffmanager/search', 'StaffController@searchLecturer');
Route::resource('staffmanager', 'StaffController');

Route::get('subjectcombinationindex', 'DepartmentController@subjectcombinationIndex');
Route::get('createcombinationindex', 'DepartmentController@createcombination');
Route::post('createcombination', 'DepartmentController@subjectcombinationNew');

Route::post('departmentmanager/search', 'DepartmentController@searchDept');
Route::resource('departmentmanager', 'DepartmentController');

//course registration
Route::post('courseregistration/search', 'CourseRegistrationController@search');
Route::post('courseregistration/searchadmissioncode', 'CourseRegistrationController@searchByAdmissionCode');
Route::post('courseregistration/addcourse', 'CourseRegistrationController@addcourse');
Route::post('courseregistration/deletecourse', 'CourseRegistrationController@deletecourse');

//cancel registraion
Route::post('courseregistration/cancel', 'CourseRegistrationController@cancelRegistration');
Route::get('courseregistration/cancel', 'CourseRegistrationController@cancelRegIndex');

Route::post('courseregistration/print', 'CourseRegistrationController@printcourse');
Route::get('courseregistration/printindex', 'CourseRegistrationController@printindex');

Route::get('courseregistration/admissioncode', 'CourseRegistrationController@admissionCodeIndex');

Route::get('courseregistration/printbysessionindex', 'CourseRegistrationController@printbysessionindex');
Route::post('courseregistration/printbysession', 'CourseRegistrationController@printcoursebysession');

Route::get('courseregistration/searchbysession', 'CourseRegistrationController@searchbysession');
Route::get('courseregistration/sessionindex', 'CourseRegistrationController@coursesessionindex');
Route::resource('courseregistration', 'CourseRegistrationController');

//curriculum
Route::get('CurriculumManager/search', 'CurriculumController@search');
Route::get('CurriculumManager/deletecourse', 'CurriculumController@deletecourse');
Route::post('CurriculumManager/newcurriculum', 'CurriculumController@newcurriculum');
Route::get('addcur', 'CurriculumController@newcurriculum');
Route::get('thecur', 'CurriculumController@thecur');
Route::post('CurriculumManager/addcourse', 'CurriculumController@addtocurriculum');

Route::get('courseassignment/remove', 'CourseAssignmentController@RemoveLecturer');
Route::post('courseassignment/search', 'CourseAssignmentController@SearchAssignment');
Route::post('courseassignment/assign', 'CourseAssignmentController@AssignLecturer');
Route::post('courseassignment/showassign', 'CourseAssignmentController@ShowCourseAssignment');
Route::resource('courseassignment', 'CourseAssignmentController');

//begin json ajax search for faculty, deparment and subject combinations
Route::get('CurriculumManager/searches','CurriculumController@jsfaculties');
Route::get('/json-departments','CurriculumController@jsdepartments');
Route::get('/json-programmes', 'CurriculumController@jsprogrammes');
Route::get('curriculumcourses','CurriculumController@curriculumcourses');

//Route::get('/json-session', 'CurriculumController@search');
//end of json ajax search

Route::resource('CurriculumManager', 'CurriculumController');

/* Route::post('mms1/search', 'Mms1Controller@search');
Route::resource('mms1', 'Mms1Controller'); */

Route::post('graduate/search', 'GraduateController@search');
Route::resource('graduates', 'GraduateController');

Route::post('summary/search', 'Mms1Controller@search');
Route::post('graduating/searchgraduating', 'Mms1Controller@searchGraduating');
Route::post('summary/print', 'Mms1Controller@print');
Route::get('summary/300plus', 'Mms1Controller@index300plus');
Route::get('graduating', 'Mms1Controller@indexGraduating');
Route::resource('summary', 'Mms1Controller');

Route::post('akokasummary/search', 'Mms1AkokaController@search');
Route::post('akokasummary/print', 'Mms1AkokaController@print');
Route::resource('akokasummary', 'Mms1AkokaController');

Route::post('mmsgraduating/search', 'MmsGraduatingController@search');
Route::post('mmsgraduating/print', 'MmsGraduatingController@print');
Route::resource('mmsgraduating', 'MmsGraduatingController');

Route::post('summarypassed/search', 'SummaryPassedController@search');
Route::post('summarypassed/print', 'SummaryPassedController@print');
Route::resource('summarypassed', 'SummaryPassedController');

Route::post('mms2/search', 'Mms2Controller@search');
Route::resource('mms2', 'Mms2Controller');

// Route::post('detailedresult2/search', 'DetailedResult2Controller@search');
// Route::post('detailedresult2/print', 'DetailedResult2Controller@print');
// Route::resource('detailedresult2', 'DetailedResult2Controller');

Route::get('senate/index', 'ResultController@senateIndex');
Route::post('senate/result', 'ResultController@senateResult');

Route::get('senate/provisional', 'ResultController@provisionalIndex');
Route::post('senate/provisional', 'ResultController@provisionalResult');



Route::post('detailedresult/search', 'DetailedResultController@search');
Route::post('detailedresult2/search', 'DetailedResultController@detailView');
Route::get('detailedresult2/index', 'DetailedResultController@detailViewIndex');
Route::post('detailedresult/print', 'DetailedResultController@print');
Route::resource('detailedresult', 'DetailedResultController');

Route::post('markmastersheet/search', 'MarkmastersheetController@search');
Route::post('markmastersheet/print', 'MarkmastersheetController@print');
Route::resource('markmastersheet', 'MarkmastersheetController');

Route::get('emsupdate', 'EMSController@updatesubcom');
//Exam mark sheet (EMS 1 - 3)
Route::post('ems2/search', 'EMSController@searchems2');
Route::get('ems2', 'EMSController@index2');
//Route::resource('ems', 'EMSController');

Route::post('ems3/search', 'EMSController@searchems3');
Route::get('ems3', 'EMSController@index3');

Route::post('ems4/search', 'EMSController@searchems4');
Route::get('ems4', 'EMSController@index4');

Route::post('attendance', 'EMSController@attendance');
Route::get('attendance', 'EMSController@attendance');

Route::post('ems/search', 'EMSController@search');
Route::resource('ems', 'EMSController');

//Statistics
Route::get('statistics/lecturerlist', 'StatsController@lecturerinfoindex');
Route::post('statistics/getlecturerlist', 'StatsController@lecturerinfo');

Route::get('statistics/courselist', 'StatsController@courselist');
Route::get('statistics/majorminortotal', 'StatsController@majorminor');

Route::get('statistics/studentinfo', 'StatsController@studentinfoindex');
Route::get('statistics/getinfo', 'StatsController@studentinfo');

Route::post('statistics/search', 'StatsController@search');
Route::get('statistics/studentlist', 'StatsController@studentlistindex');
Route::post('statistics/getlist', 'StatsController@studentlist');
Route::resource('statistics', 'StatsController');

/* //Fresher upload
Route::post('fresher/importfresher', 'FresherController@import');
Route::get('fresher/home', 'FresherController@fresherindex');
Route::resource('fresher', 'FresherController');
 */

//Add/Delete:: rectify result controller
Route::get('lecturer/previewdownload', 'RectifyResultController@previewdownload');
Route::post('rectify/search', 'RectifyResultController@search');
Route::post('rectify/updated', 'RectifyResultController@updated');
Route::resource('rectify', 'RectifyResultController');

//Route::resource('resultviewer', 'ResultviewController');
//Route::get('resultviewer', 'ResultviewController@index');

//Academic Standing
Route::get('academicstanding', 'ResultviewController@academicindex');
Route::post('academicstanding', 'ResultviewController@academicstanding');

//upload result
Route::post('uploadresultcourse', 'ResultviewController@uploadresultcourse');
Route::post('uploadzeroresult', 'ResultviewController@uploadzeroresult');
Route::post('uploadresult', 'ResultviewController@uploadresult');
Route::get('uploadresultindex', 'ResultviewController@uploadresultindex');

Route::get('esaviewer/esaresults', 'ESAController@index');
Route::post('esaviewer/getesaresults', 'ESAController@getESA');
Route::resource('esaviewer', 'ESAController');

Route::get('resultviewer/', 'ResultviewController@index');
Route::post('resultviewer/search', 'ResultviewController@search');

//json routes
Route::get('resultviewer/','ResultviewController@sessions');
//Route::get('resultviewer/json-results','ResultviewController@results');

//Reset upload
Route::get('resetuploadindex', 'ResultviewController@resetuploadindex');
Route::post('resetupload', 'ResultviewController@resetupload');

//result slip
Route::get('resultslipindex', 'ResultviewController@resultslipindex');
Route::post('resultslip', 'ResultviewController@resultslip');

Route::get('printcount', 'ResultviewController@printcount');
Route::get('printcounter', 'ResultviewController@printcounter');
Route::post('printcounterstart', 'ResultviewController@printcounterstart');

//statement of result
Route::get('resultstmtindex', 'ResultviewController@resultstmtindex');
Route::post('resultstmt', 'ResultviewController@resultstmt');

//Suspension Cases
Route::post('suspension/effectprobation', 'SuspensionController@placeonprobation');
Route::get('suspension/probation', 'SuspensionController@probation');
Route::post('suspension/suspend', 'SuspensionController@suspend');
Route::resource('suspension', 'SuspensionController');

//student pin
Route::get('pin/searchpin', 'PinController@searchpin');
Route::get('printpin', 'PinController@printpin');
Route::get('generatepinpage', 'PinController@generatePinIndex');
Route::post('generatepin', 'PinController@generatePin');
Route::post('addpin', 'PinController@addPin');
Route::get('addpin', 'PinController@addPinindex');
Route::resource('pin', 'PinController');

//transcript
Route::get('transcriptindex', 'ResultviewController@transcriptindex');
Route::post('transcript', 'ResultviewController@transcript');

//score range
Route::get('scorerange', 'ResultviewController@scorerangeindex');
Route::post('scoreranges', 'ResultviewController@scoreranges');

//uploaded score
Route::get('uploadedscore', 'ResultviewController@uploadedscoreindex');
Route::post('uploadedscores', 'ResultviewController@uploadedscore');

//uploaded score by level
Route::get('uploadedscorelevel', 'ResultviewController@uploadedscorelevelindex');
Route::post('uploadedscoreslevel', 'ResultviewController@uploadedscorelevel');

Route::get('lectureins', 'ResultviewController@insertlecturer');

//Activity Schedule
Route::get('activityschedule/delete', 'ActivityController@ActivityScheduleDelete');
Route::get('activityschedule/create', 'ActivityController@ActivityScheduleNew');
Route::get('activityschedule/createnew', 'ActivityController@ActivityScheduleCreate');
Route::get('activityschedule', 'ActivityController@ActivityScheduleIndex');

//Activity
Route::get('activity/update', 'ActivityController@ActivityUpdate');
Route::get('activity/edit', 'ActivityController@ActivityEdit');
Route::get('activity/delete', 'ActivityController@deleteActivity');
Route::get('activity/addnew', 'ActivityController@AddNew');
Route::resource('activity', 'ActivityController');



Route::get('/dynamic_dependent', 'AjaxController@index');

Route::post('dynamic_dependent/fetch', 'AjaxController@fetch')->name('dynamicdependent.fetch');

});//end of route group for middleware

Auth::routes();
Route::post('/login/custom',[
    'uses' =>'LoginController@login',
    'as' => 'login.custom'
]);

Route::get('/clearcache', function() {
    $exitCode = Artisan::call('cache:clear');
    // $exitCode =Artisan::call('route:cache');
    $exitCode =Artisan::call('config:cache');
    $exitCode =Artisan::call('view:clear');
    return 'Application cache cleared. Go back to dashboard <a href="" onclick="window.history.go(-1); return false;"> click here</a>';
});