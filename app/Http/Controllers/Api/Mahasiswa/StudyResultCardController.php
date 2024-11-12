<?php

namespace App\Http\Controllers\Api\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\StudyPlanCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudyResultCardController extends Controller
{
    public function myStudyResultCard(Request $request){
        $myStudyResultCard = StudyPlanCard::with([
            'user_class_courses.class_course.course:id,name,code',
            'user_class_courses.study_result_card'
        ])
        ->has('user_class_courses.study_result_card')
        ->whereUserId($request->user()->id)
        ->get()->map(function($query) use ($request){
            $i = 1;
            if($i ++ == $request->semester) return $query;
        })->first();
        return $this->getSuccessResponse([
            'user' => $request->user(),
            'my_study_result_card' => $myStudyResultCard,
            'credit_course_total' => $myStudyResultCard->credit_course_total ?? 0,
            'semester_performance_index' => $myStudyResultCard->semester_performance_index ?? 0.00,
            'next_credit_course_total_max' => $this->nextCreditCourseMaxTake(),
        ]);
    }

    // sks maksimal yg diambil semester depan
    public function nextCreditCourseMaxTake(){
        $ongoingPerformanceIndexSemester = Auth::user()->ongoing_semester_performance_index;
        switch (true) {
            case $ongoingPerformanceIndexSemester >= 3:
                $value = 25;
                break;
            case $ongoingPerformanceIndexSemester >= 2.5 && $ongoingPerformanceIndexSemester >= 2.99:
                $value = 22;
                break;
            case $ongoingPerformanceIndexSemester >= 2 && $ongoingPerformanceIndexSemester >= 2.49:
                $value = 20;
                break;
            default:
                $value = 18;
          }
          return $value;
    }
}
