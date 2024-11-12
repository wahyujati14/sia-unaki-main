<?php

namespace App\Http\Controllers\Api\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\StudyPlanCard;
use App\Models\StudyResultCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TranscriptsController extends Controller
{
    public function allTranscripts(Request $request){
        $transcripts = Cache::remember('transcripts', 5, function() {
            return StudyResultCard::with([
                'user_class_course.class_course.schedule_class_course',
                'user_class_course.class_course.course:id,name,code',
            ])
            ->whereHas('user_class_course.study_plan_card',fn($query) => $query->whereUserId(Auth::user()->id))
            ->get();
         });

        return $this->getSuccessResponse([
            'user' => $request->user(),
            'transcripts' => $transcripts,
            'credit_course_total' => $request->user()->credit_course_total,
            'total_credits_multiplied_by_grade' => $this->totalCreditsMultipliedByGrade(),
            'cumulative_performance_index' => $request->user()->cummulative_performance_index,
        ]);
    }

    //get total nilai mutu
    public function totalCreditsMultipliedByGrade(){
        $performanceIndexs = StudyPlanCard::whereUserId(Auth::user()->id)->has('user_class_courses.study_result_card')->get();
        $performanceIndexs->map(function($query){
            return array_merge([
                'credits_multiplied_by_grade' => $query->quality_total,
            ],$query->toArray());
        });
        return $performanceIndexs->sum('credits_multiplied_by_grade');
    }
}
