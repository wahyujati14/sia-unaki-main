<?php

use App\Http\Controllers\Exam\QuestionController;
use Illuminate\Support\Facades\Route;

// exam
Route::group(['prefix' => 'exam','middleware'=>'exam'], function () {
    Route::resource('exam-questions', QuestionController::class);
//     Route::get('/', [App\Http\Controllers\PMB\ExamController::class, 'index']);
//     Route::get('/show-question/{id}', [App\Http\Controllers\PMB\ExamController::class, 'show_question']);
//     Route::get('/next-question/{id}', [App\Http\Controllers\PMB\ExamController::class, 'next_question']);
//     Route::get('/previous-question/{id}', [App\Http\Controllers\PMB\ExamController::class, 'previous_question']);
//     Route::put('/choose-answer/{id}', [App\Http\Controllers\PMB\ExamController::class, 'choose_answer']);
//     Route::get('/show-question-map/{id}', [App\Http\Controllers\PMB\ExamController::class, 'show_question_map']);
//     Route::post('/start', [App\Http\Controllers\PMB\ExamController::class, 'start']);
//     Route::post('/finish', [App\Http\Controllers\PMB\ExamController::class, 'finish']);
});