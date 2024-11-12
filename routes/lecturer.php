<?php

use App\Http\Controllers\Lecturer\AuthController;
use App\Http\Controllers\Lecturer\DashboardController;
use App\Http\Controllers\Lecturer\StudentController;
use App\Http\Controllers\Lecturer\StudyResultCardController;
use App\Http\Controllers\Lecturer\UserClassCourseController;
use Illuminate\Support\Facades\Route;

Route::name('lecturer.')->prefix('dosen')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('auth');
    Route::post('/', [AuthController::class, 'login'])->name('login');

    Route::resource('/user_class_courses', UserClassCourseController::class);
    Route::post('/user_class_courses/approve/{id}', [UserClassCourseController::class, 'approve'])->name('user_class_courses.approve');
    Route::post('/user_class_courses/decline/{id}', [UserClassCourseController::class, 'decline'])->name('user_class_courses.decline');

    Route::resource('/study_result_cards', StudyResultCardController::class);

    Route::resource('/students', StudentController::class);
    Route::put('/students/{user_id}/assign/lecturers/{lecturer_id}', [StudentController::class, 'submitAssignLecturer'])
        ->name('students.assign.lecturers.submit');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
