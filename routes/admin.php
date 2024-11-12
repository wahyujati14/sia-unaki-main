<?php

use App\Http\Controllers\Admin\AcademicYearController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ApproveStudentController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CertificateReceiveController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ClassCourseController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\ExamLevelController;
use App\Http\Controllers\Admin\ExamQuestionController;
use App\Http\Controllers\Admin\ExamScoreController;
use App\Http\Controllers\Admin\ExamSessionController;
use App\Http\Controllers\Admin\ExamUserSessionController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\FileUplaodController;
use App\Http\Controllers\Admin\User\StudentController;
use App\Http\Controllers\Admin\UserFileUploadController;
use App\Http\Controllers\Admin\UserInformationController;
use App\Http\Controllers\Admin\UserPaymentController;
use App\Http\Controllers\Admin\InformationServiceController;
use App\Http\Controllers\Admin\InformationSourceController;
use App\Http\Controllers\Admin\LecturerController;
use App\Http\Controllers\Admin\NewsCategoryController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PaymentTypeController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\RegistrationPeriodeController;
use App\Http\Controllers\Admin\SubDistrictController;
use App\Http\Controllers\Admin\UserStudyProgramController;
use App\Http\Controllers\Admin\RegistrationPathController;
use App\Http\Controllers\Admin\ReligionController;
use App\Http\Controllers\Admin\ReregistrationController;
use App\Http\Controllers\Admin\ScheduleClassCourseController;
use App\Http\Controllers\Admin\StudyPlanCardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\ScheduleStudyPlanCardController;
use App\Http\Controllers\Admin\StudyProgramController;
use App\Http\Controllers\Admin\UserClassCourseController;
use Illuminate\Support\Facades\Route;

// exam
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [AuthController::class, 'index'])->name('admin');
    Route::post('/', [AuthController::class, 'login'])->name('admin.login');
    Route::group(['middleware'=>'admin'], function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('admin_logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard_admin');
        Route::resources([
            'admins' => AdminController::class,
            'students' => StudentController::class,
            'exams' => ExamController::class,
            'exam_levels' => ExamLevelController::class,
            'exam_questions' => ExamQuestionController::class,
            'exam_sessions' => ExamSessionController::class,
            'exam_scores' => ExamScoreController::class,
            'exam_user_sessions' => ExamUserSessionController::class,
            'user_informations' => UserInformationController::class,
            'user_file_uploads' => UserFileUploadController::class,
            'payment_types' => PaymentTypeController::class,
            'information_services' => InformationServiceController::class,
            'information_service_payments' => InformationServiceController::class,
            'user_payments' => UserPaymentController::class,
            'certificate_receives' => CertificateReceiveController::class,
            'user_study_programs' => UserStudyProgramController::class,
            'registration_periodes' => RegistrationPeriodeController::class,
            'file_uploads' => FileUplaodController::class,
            'sub_districts' => SubDistrictController::class,
            'districts' => DistrictController::class,
            'cities' => CityController::class,
            'provincies' => ProvinceController::class,
            'registration_paths' => RegistrationPathController::class,
            're_registrations' => ReregistrationController::class,
            'faculties' => FacultyController::class,
            'information_sources' => InformationSourceController::class,
            'religions' => ReligionController::class,
            'study_programs' => StudyProgramController::class,
            'news' => NewsController::class,
            'news-category' => NewsCategoryController::class,
            'academic_years' => AcademicYearController::class,
            'courses' => CourseController::class,
            'lecturers' => LecturerController::class,
            'class_courses' => ClassCourseController::class,
            'user_class_courses' => UserClassCourseController::class,
            'schedule_class_courses' => ScheduleClassCourseController::class,
            'study_plan_cards' => StudyPlanCardController::class,
            'roles' => RoleController::class,
            'lecturers' => LecturerController::class,
            'schedule_study_plan_cards' => ScheduleStudyPlanCardController::class,
            'rooms' => RoomController::class
        ]);
    });

    Route::get('students/{id}/assign/lecturer', [StudentController::class, 'assigningLecturer'])->name('students.assign.lecturers.create');
    Route::post('students/{id}/assign/lecturer', [StudentController::class, 'assignLecturer'])->name('students.assign.lecturers.store');

    Route::get('approve_students', [ApproveStudentController::class, 'index'])->name('approve_students');
    Route::post('approve_students', [ApproveStudentController::class, 'assignUserLecturer'])->name('approve_students.store');
    Route::get('approve_students/study_program', [ApproveStudentController::class, 'getLectureByStudyProgram'])->name('approve_students.study_program');
});
