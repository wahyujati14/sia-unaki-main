<?php

namespace App\Http\Controllers\Api\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\StudyPlanCard;
use App\Models\StudyResultCard;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $user =  User::find(Auth::user()->id);
        return $this->getSuccessResponse([
            'user' => $user,
            'academic_year' => $user->academic_year,
            'ongoing_semester'=> $user->ongoing_semester,
            'credit_course_total' => $user->credit_course_total,
            'previous_performance_index' => $user->ongoing_semester > 1 ? $this->previousPerformanceIndex() : 0,
            'cummulative_performance_index' => $user->cummulative_performance_index,
            'semesters' => $this->getAllSemester()
        ]);
    }

    public function previousPerformanceIndex(){
        $ongoingAcademicYear = Auth::user()->academic_year;
        $previousAcademicYearId = AcademicYear::where('id','<',$ongoingAcademicYear->id)->max('id');
        return StudyResultCard::whereHas('user_class_course.study_plan_card',fn($query) => $query->whereUserId(Auth::user()->id)->whereAcademicYearId($previousAcademicYearId))->first()?->semester_performance_index;
    }

    public function getAllSemester(){
        //semester yg sudah selesai khs
        $doneSemeter = StudyPlanCard::whereUserId(Auth::user()->id)
        ->whereStatus(StudyPlanCard::STATUS_DONE)
        ->pluck('id');

        for($i = 1;$i < 30; $i ++){
            $manyPossibleSemester[] = $i;
        }
        $availableSemester = collect($manyPossibleSemester)->filter(function($item) use ($doneSemeter) {
           if($item <= ($doneSemeter->count() + 1)) return $item;
        });
        return $availableSemester;
    }
}
