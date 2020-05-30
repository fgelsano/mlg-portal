<?php

use Illuminate\Support\Facades\Route;

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
    return view('front.index');
});

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('/online-admission', 'Front\FrontContentsController@createAdmission')->name('admission.index');
Route::post('/online-admission', 'Front\FrontContentsController@storeAdmission')->name('admission.store');

Route::prefix('/')->middleware(['auth'])->namespace('Dashboard')->group( function(){
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::resource('/dashboard/admission/pending-requests', 'Enrolment\AcceptedRequestsController');
    Route::resource('/dashboard/admission/all-requests', 'Enrolment\AllRequestsController');
    Route::resource('/dashboard/admission/pending-requests', 'Enrolment\PendingRequestsController');
    Route::resource('/dashboard/admission/accepted-requests', 'Enrolment\AcceptedRequestsController');
    Route::resource('/dashboard/admission/rejected-requests', 'Enrolment\RejectedRequestsController');

    Route::resource('/dashboard/enrolment/schedules', 'Enrolment\Others\SchedulesController');
    Route::resource('/dashboard/enrolment/rooms-labs', 'Enrolment\Others\LabsAndRoomsController');

    Route::resource('/dashboard/instructors', 'Instructors\InstructorsController');
    Route::resource('/dashboard/students', 'Students\StudentsController');
    Route::resource('/dashboard/subjects', 'Subjects\SubjectsController');

    Route::resource('/dashboard/users', 'Admin\UsersController');
});