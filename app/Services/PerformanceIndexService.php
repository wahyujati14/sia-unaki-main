<?php

namespace App\Services;

use App\Models\StudyResultCard;

/**
 * Class PerformanceIndexService.
 */
class PerformanceIndexService
{
    public function cummulativePerformanceIndex($user_id = null){
        if($user_id){
           $performanceIndexs = StudyResultCard::whereUserId($user_id)->get();
        }else{
            $performanceIndexs = StudyResultCard::whereUserId(request()->user()->id)->get();
        }
        $performanceIndexs->map(function($query){
            return array_merge([
                'quality_total' => $query->quality_total,
                'credit_course_total' => $query->credit_course_total
            ],$query->toArray());
        });
        //index prestasi kumulatif = total jumlah mutu / total jumlah kredit
        $cummulativePerformaneIndex = $performanceIndexs->sum('quality_total') / $performanceIndexs->sum('credit_course_total');
        return $cummulativePerformaneIndex;
    }

    //get total nilai mutu
    public function qualityTotal($user_id = null){
        if($user_id){
           $performanceIndexs = StudyResultCard::whereUserId($user_id)->get();
        }else{
            $performanceIndexs = StudyResultCard::whereUserId(request()->user()->id)->get();
        }
        $performanceIndexs->map(function($query){
            return array_merge([
                'quality_total' => $query->quality_total,
            ],$query->toArray());
        });
        return $performanceIndexs->sum('quality_total');
    }
}
