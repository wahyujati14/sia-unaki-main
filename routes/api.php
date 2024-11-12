<?php

use App\Http\Controllers\Api\Mahasiswa\Auth\AuthController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\DistrictController;
use App\Http\Controllers\Api\Mahasiswa\CardController;
use App\Http\Controllers\Api\Mahasiswa\HomeController;
use App\Http\Controllers\Api\Mahasiswa\NewsController;
use App\Http\Controllers\Api\Mahasiswa\PerformanceIndexController;
use App\Http\Controllers\Api\Mahasiswa\PresenceController;
use App\Http\Controllers\Api\Mahasiswa\ProfileController;
use App\Http\Controllers\Api\Mahasiswa\StudyPlanCardController;
use App\Http\Controllers\Api\Mahasiswa\StudyResultCardController;
use App\Http\Controllers\Api\Mahasiswa\TranscriptsController;
use App\Http\Controllers\Api\Payment\XenditController;
use App\Http\Controllers\Api\ProvincyController;
use App\Http\Controllers\Api\SubDistrictController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'v1'], function () {
    Route::get('provincies', [ProvincyController::class, 'index']);
    Route::get('cities', [CityController::class, 'index']);
    Route::get('districts', [DistrictController::class, 'index']);
    Route::get('sub-districts', [SubDistrictController::class, 'index']);
    Route::post('xendit-callback', [XenditController::class, 'callback']);

    //route for mahasiswa
    Route::group(['prefix' => 'mahasiswa'], function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::post('login',[AuthController::class,'login']);
        });
        Route::group(['middleware' => 'auth:api'], function () {
            Route::post('logout',[AuthController::class,'logout']);
            Route::get('/home',[HomeController::class,'index']);
            Route::get('profile',[ProfileController::class,'index']);
            Route::post('profile',[ProfileController::class,'update']);
            Route::get('academic-information',[ProfileController::class,'academicInformation']);
            Route::get('parent-information',[ProfileController::class,'parentInformation']);
            Route::get('news', [NewsController::class,'index']);
            Route::get('news/{id}', [NewsController::class,'show']);
            Route::get('my_student_card',[CardController::class,'myStudentCard']);

            Route::group(['prefix' => 'study_plan_card'], function () {
                Route::get('/',[StudyPlanCardController::class,'studyPlanCard']);
                Route::get('/class_course',[StudyPlanCardController::class,'classCourseList']);
                Route::post('/',[StudyPlanCardController::class,'studyPlanCardStore']);
            });

            Route::group(['prefix' => 'study_result_card'], function () {
                Route::get('/my_study_result_card',[StudyResultCardController::class,'myStudyResultCard']);
            });

            Route::group(['prefix' => 'presence'], function () {
                Route::get('/course_schedule',[PresenceController::class,'courseScheduleList']);
                Route::get('/class_course',[PresenceController::class,'classCourseShow']);
                Route::post('/presence_qrcode',[PresenceController::class,'presenceQrcode']);
                Route::get('/class_course/presence_list',[PresenceController::class,'presenceList']);
                Route::get('/class_course/presence_show',[PresenceController::class,'presenceShow']);
            });
            Route::get('/transcripts',[TranscriptsController::class,'allTranscripts']);
            Route::get('/performance_index',[PerformanceIndexController::class,'performanceIndex']);
        });
    });
});
