<?php

namespace App\Http\Controllers\Api\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\StudyPlanCard;
use Illuminate\Http\Request;

class PerformanceIndexController extends Controller
{
    public function performanceIndex(Request $request){
        $performanceIndexs = StudyPlanCard::with([
            'user_class_courses.class_course.course',
            'academic_year'
        ])
        ->whereUserId($request->user()->id)
        ->get()->map(function($query){
            return array_merge([
                'credit_course_taken'=> $query->credit_course_total,
                'semester_performance_index' => $query->semester_performance_index,
                'credits_multiplied_by_grade' => $query->credits_multiplied_by_grade,
                'credit_course_total' => $query->credit_course_total
            ],$query->toArray());
        });

        return $this->getSuccessResponse([
            'user' => $request->user(),
            'performance_indexs' => $performanceIndexs,
            'credit_course_total' => $performanceIndexs->sum('credit_course_total'),
            'total_credits_multiplied_by_grade' => $performanceIndexs->sum('credits_multiplied_by_grade'),
            'cumulative_performance_index' => $request->user()->cummulative_performance_index,
        ]);
    }

}
