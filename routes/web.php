<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{RoleController,UserController,CourseController,StudentController,StudentCourseController,PaymentHistoryController,PaymentPlanController};
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// SET VIEW PAges ROUTES

//PREVILAGES PAGES

Route::view('/add_role','pages.previlages.role')->name('add_role');
Route::get('/role_permission',[RoleController::class , 'index'])->name('role_permission');
Route::get('/add_user',[RoleController::class , 'show_role'])->name('add_user');
Route::get('/user_role',[UserController::class,'index'])->name('user_role');

//EDIT ROLE PERMISSIONS
Route::post('/set_permissions',[ RoleController::class, 'edit_permissions'])->name('edit_permissions');
//EDIT USER ROLES
Route::post('/set_roles',[ UserController::class, 'edit_roles'])->name('edit_roles');
// INSTRUCTIRS LIST PAGE
Route::get('/instructor_list',[CourseController::class , 'fetchInstructors'])->name('instructor_list');
// MAKE ENROLLMENT PAGE
Route::view('/make_enrollment','pages.students.make_enrollment')->name('make_enrollment');
//SHOW PAY FEE PAGE
Route::view('/pay_fee','pages.payments.pay_fee')->name('pay_fee');
// STUDENT PAYMENT SHEDULE
// routes/web.php
Route::get('/student/payment-schedule', [PaymentPlanController::class, 'get_student_payment_shedule'])
    ->name('student.payment_schedule');

Route::post('/payment-plan/confirm-payment', [PaymentPlanController::class, 'confirmPayment'])
    ->name('payment_plan.confirm_payment');

//RESOURCES CONTROLLERS
Route::resource('/role',RoleController::class);
Route::resource('/user',UserController::class);
Route::resource('/course',CourseController::class);
Route::resource('/student',StudentController::class);
Route::resource('/student_course',StudentCourseController::class);
Route::resource('/payment_plan',PaymentPlanController::class);
Route::resource('/payment_history',PaymentHistoryController::class);




// FOR USER SEARCH
Route::get('/users/search', [UserController::class, 'search'])
    ->name('users.search');
// FOR COURSE SEARCH
Route::get('/courses/search', [CourseController::class, 'search'])
    ->name('courses.search');
// FOR STUDENT SEARCH
Route::get('/students/search', [StudentController::class, 'search'])
    ->name('students.search');
// FOR MAKING ENROLLMENTS
Route::post('/students/enroll', [StudentController::class, 'makeEnrollment'])
    ->name('students.enroll');
// GET PAYMENT DETAILS FOR STUDENT COURSE
Route::get('/payment_plan/details/{id}', [PaymentPlanController::class, 'getPaymentPlanDetails'])->name('payment_plan.details');

Route::post('/fetch-student-course', [StudentController::class, 'fetchStudentAndCourseData'])->name('fetch-student-course');
require __DIR__.'/auth.php';
