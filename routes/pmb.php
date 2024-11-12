<?php

use App\Http\Controllers\PMB\CertificateReceiveController;
use App\Http\Controllers\PMB\DashboardController;
use App\Http\Controllers\PMB\ExamSessionController;
use App\Http\Controllers\PMB\FileUploadController;
use App\Http\Controllers\PMB\PaymentController;
use App\Http\Controllers\PMB\RegistrationPathController;
use App\Http\Controllers\PMB\ReRegistrationController;
use App\Http\Controllers\PMB\SchoolOriginController;
use App\Http\Controllers\PMB\UserInformationController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'penerimaan-mahasiswa-baru'], function () {
    Route::group(['middleware'=>['auth', 'verified']], function(){
        Route::group(['middleware'=>['whereiam']], function(){
            Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
        });
        Route::get('/registered', [UserInformationController::class, 'index'])->name('registered');
        Route::post('/registered', [UserInformationController::class, 'store']);
        Route::get('/school-origin', [SchoolOriginController::class, 'index'])->name('school_origin');
        Route::post('/school-origin', [SchoolOriginController::class, 'store']);
        Route::get('/registration-path', [RegistrationPathController::class, 'index'])->name('registration_path');
        Route::post('/registration-path', [RegistrationPathController::class, 'store']);
        Route::get('/file-upload', [FileUploadController::class, 'index'])->name('file_upload');
        Route::post('/file-upload', [FileUploadController::class, 'store']);
        Route::get('/payment', [PaymentController::class, 'index'])->name('payment');
        Route::get('/payment/{id}', [PaymentController::class, 'show'])->name('payment.show');
        Route::post('/payment', [PaymentController::class, 'store']);
        Route::get('/xendit', [PaymentController::class, 'invoice'])->name('xendit_invoice');
        Route::post('/certificate-receive', [CertificateReceiveController::class, 'store'])->name('certificate-receive');
        Route::get('/certificate-receive', [CertificateReceiveController::class, 'index'])->name('certificate-receive');
        Route::get('/reexam', [CertificateReceiveController::class, 'reexam'])->name('reexam');
        Route::get('/re-registration', [ReRegistrationController::class, 'index'])->name('re-registration');
        Route::post('/re-registration', [ReRegistrationController::class, 'store']);
        Route::get('/re-registration/{id}', [ReRegistrationController::class, 'show'])->name('re-registration.show');
        Route::post('/exam-session', [ExamSessionController::class, 'store'])->name('exam_session');

    });


});
