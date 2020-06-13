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

Route::get('/', 'Front\FrontContentsController@index');

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('/online-admission', 'Front\FrontContentsController@createAdmission')->name('admission.index');
Route::post('/online-admission', 'Front\FrontContentsController@storeAdmission')->name('admission.store');
Route::get('/fetchOldStudent/{name}', 'Front\FrontContentsController@fetchOldStudent')->name('oldStudent.fetch');

Route::prefix('/')->middleware(['auth'])->namespace('Dashboard')->group( function(){
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::resource('/dashboard/enrollment/admission/requests', 'Enrollment\Admission\AdmissionRequestsController');
    Route::post('/dashboard/enrollment/admission/requests/accept', 'Enrollment\Admission\AdmissionRequestsController@markAccept')->name('requests.accept');
    
    Route::get('/dashboard/enrollment/cashier/lists','Enrollment\Cashier\CashierController@index')->name('cashier.list');
    Route::get('/dashboard/enrollment/settings/options/lists','Enrollment\Settings\OptionsController@lists')->name('options.lists');
    Route::resource('/dashboard/enrollment/settings/options', 'Enrollment\Settings\OptionsController');
    Route::resource('/dashboard/enrollment/enroll', 'Enrollment\Enroll\EnrollController');

    Route::resource('/dashboard/instructors', 'Instructors\InstructorsController');
    Route::get('/dashboard/instructors-list', 'Instructors\InstructorsController@instructorList')->name('instructors.list');
    
    Route::resource('/dashboard/students', 'Students\StudentsController');

    Route::get('/dashboard/subjects/enroll-subjects', 'Subjects\SubjectsController@enrollSubjects')->name('enroll-subjects.list');
    Route::get('/dashboard/subjects/pick-subjects/{id}', 'Subjects\SubjectsController@pickedSubjects')->name('subjects.pick');
    Route::resource('/dashboard/subjects', 'Subjects\SubjectsController');

    Route::resource('/dashboard/payments','Payments\PaymentsController');

    Route::resource('/dashboard/users', 'Admin\UsersController');
});