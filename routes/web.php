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
    Route::get('/dashboard/check','DashboardController@dashboardCheck')->name('dashboard.check');
    Route::get('/dashboard/notifications','DashboardController@notifications')->name('notifications.check');
    Route::resource('/dashboard/profile','Profile\ProfileController');    
    Route::get('/dashboard/cor/print/{id}','Students\StudentsController@print')->name('cor.print');
    Route::post('/dashboard/profile/password/reset/','Users\UsersController@resetPassword')->name('reset.password');
    Route::get('/dashboard/profile/check/profile/{id}','Profile\ProfileController@profileCheck')->name('profile.check');

    Route::resource('/dashboard/enrollment/admission/requests', 'Enrollment\Admission\AdmissionRequestsController');
    Route::resource('/dashboard/enrollment/admission/rejected', 'Enrollment\Admission\RejectedRequestsController');
    Route::resource('/dashboard/enrollment/admission/for-enrollment', 'Enrollment\Admission\ForEnrollmentController');
    Route::resource('/dashboard/enrollment/admission/enrolled', 'Enrollment\Admission\EnrolledController');

    Route::post('/dashboard/enrollment/admission/requests/accept', 'Enrollment\Admission\AdmissionRequestsController@markAccept')->name('requests.accept');
    Route::get('/dashboard/enrollment/cashier/lists','Enrollment\Cashier\CashierController@index')->name('cashier.list');
    Route::get('/dashboard/enrollment/enrolled-subjects/edit/{id}','Enrollment\Enroll\EnrollController@getEnrolledSubjects')->name('enrolledSubjects.get');
    Route::resource('/dashboard/enrollment/enroll', 'Enrollment\Enroll\EnrollController');

    Route::resource('/dashboard/cashier-clearances','Cashier\CashierClearancesController');

    Route::resource('/dashboard/instructors', 'Instructors\InstructorsController');
    Route::get('/dashboard/instructors-list', 'Instructors\InstructorsController@instructorList')->name('instructors.list');
    Route::resource('/dashboard/instructor-subjects','Instructors\InstructorSubjectsController');
    Route::get('/dashboard/print/subject-load/{id}','Instructors\InstructorSubjectsController@print')->name('subject-load.print');
    Route::resource('/dashboard/instructor-grades','Instructors\InstructorGradesController');
    Route::resource('/dashboard/instructor-clearances','Instructors\InstructorClearancesController');
    Route::post('/dashboard/instructor/subject/update/{id}','Subjects\SubjectsController@updateInstructorSubject')->name('instructorSubject.update');

    Route::resource('/dashboard/students', 'Students\StudentsController');
    Route::resource('/dashboard/student-subjects','Students\StudentSubjectsController');
    Route::resource('/dashboard/student-grades','Students\StudentGradesController');
    Route::resource('/dashboard/student-billings','Students\StudentBillingsController');
    Route::resource('/dashboard/student-clearances','Students\StudentClearancesController');

    Route::get('/dashboard/subjects/enroll-subjects', 'Subjects\SubjectsController@enrollSubjects')->name('enroll-subjects.list');
    Route::get('/dashboard/subjects/pick-subjects/{id}', 'Subjects\SubjectsController@pickedSubjects')->name('subjects.pick');
    Route::resource('/dashboard/subjects', 'Subjects\SubjectsController');

    Route::resource('/dashboard/payments','Payments\PaymentsController');
    Route::get('/dashboard/payments/confirmation/{id}','Payments\PaymentsController@printConfirmation')->name('confirmation.print');

    Route::resource('/dashboard/announcements','Announcements\AnnouncementsController');

    Route::get('/dashboard/enrollment/settings/options/lists','Enrollment\Settings\OptionsController@lists')->name('options.lists');
    Route::resource('/dashboard/users', 'Users\UsersController')->middleware('admin.super');
    Route::resource('/dashboard/enrollment/settings/options', 'Enrollment\Settings\OptionsController');
});