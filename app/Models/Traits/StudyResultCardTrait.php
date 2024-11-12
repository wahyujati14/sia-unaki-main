<?php

namespace App\Models\Traits;

use App\Models\StudyPlanCard;
use App\Models\UserClassCourse;

trait StudyResultCardTrait
{

    public function getOngoingSemesterPerformanceIndexAttribute(){
        // get IPS semester sekarang
        return number_format($this->hasMany(StudyPlanCard::class)->latest()->whereStatus(StudyPlanCard::STATUS_DONE)->latest()->first()->semester_performance_index ?? 0,2);
    }

    public function getCummulativePerformanceIndexAttribute(){
      $performanceIndexs =  $this->hasMany(StudyPlanCard::class)->whereStatus(StudyPlanCard::STATUS_DONE)->get()
      ->map(function($query){
            return array_merge([
                'credits_multiplied_by_grade' => $query->credits_multiplied_by_grade,
                'credit_course_total' => $query->credit_course_total
            ],$query->toArray());
        });
        //index prestasi kumulatif = total jumlah mutu / total jumlah kredit
        $cummulativePerformaneIndex = $performanceIndexs->sum('credits_multiplied_by_grade') > 0 ? $performanceIndexs->sum('credits_multiplied_by_grade') / $performanceIndexs->sum('credit_course_total') : 0;
        return number_format($cummulativePerformaneIndex,2);
    }

    public function getCreditCourseTotalAttribute(){
        // total semua sks yang di diambil sampai saat ini
        return  UserClassCourse::whereHas('study_plan_card',fn($query) => $query->whereUserId(request()->user()->id)->whereStatus(StudyPlanCard::STATUS_DONE))->sum('credit_course');
    }
}
