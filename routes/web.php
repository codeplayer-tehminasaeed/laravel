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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('department', 'DepartmentController');
Route::resource('upload', 'ExcelUploadController');
Route::resource('rooms', 'RoomsController');
Route::resource('request', 'RequestController');
Route::resource('programs', 'ProgramsController');
Route::resource('slots', 'SlotsController');
Route::resource('courses', 'CoursesController');
Route::resource('sections', 'SectionController');
Route::resource('student', 'studentInfoController');
Route::resource('teacher', 'teacherInfoController');
Route::resource('teacherCourses', 'TeacherCoursesController');
Route::resource('timetable', 'timetableController');
Route::resource('teachertimetable', 'teacherController');
Route::resource('stdtimetable', 'studentsController');
Route::resource('makeup', 'MakeupRequestesController');
Route::resource('labs', 'labController');
Route::resource('customtime', 'customTimetableController');
Route::resource('shiftLec', 'shiftLecController');
Route::post('/shift', 'shiftLecController@shift');
Route::post('/student/dep/', 'studentInfoController@checkDepartment');
Route::get('/shiftLecRequest', 'teacherController@showTable');
Route::get('/times/table/', 'studentsController@showTable');
Route::post('/teacherCourses/dep/', 'TeacherCoursesController@checkDepartment');
Route::post('/teacherCourses/course/', 'TeacherCoursesController@checkProgram');
Route::post('/teacherCourses/checklab/', 'TeacherCoursesController@checklab');
Route::post('/student/sec/', 'studentInfoController@checkProgram');
Route::post('/addCustom', 'customTimetableController@addCustom');