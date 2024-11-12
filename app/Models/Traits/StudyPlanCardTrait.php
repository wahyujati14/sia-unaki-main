<?php

namespace App\Models\Traits;

use App\Models\StudyPlanCard;

trait StudyPlanCardTrait
{

    public function getSemesterCanTakeKrs(){
        $previouseSemester = $this->hasMany(StudyPlanCard::class)->whereStatus(StudyPlanCard::STATUS_DONE)->count() > 1  ? $this->hasMany(StudyPlanCard::class)->whereStatus(StudyPlanCard::STATUS_DONE)->count() : 1;
        $isEven = $previouseSemester % 2 == 0 ? true : false;
        // $allSemeterAvailable = [3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25]; semeter 1 dan 2 gak boleh ambil krs sendiri
        $allSemeterAvailable = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25]; //sementera  semester 1 dan 2 bisa ambil buat testing
        $canTakeSemester = array_values(array_filter(collect($allSemeterAvailable)->map(function($query) use ($isEven){
             if($isEven){
                     return $query % 2 == 0 ? $query : null ; // jika semester genap
             }else{
                 return $query % 2 != 0 ? $query : null; // jika semeter ganjil
             }
        })->toArray()));
        return $canTakeSemester;
     }

     public function ongoing_study_plan_card(){
        return $this->hasMany(StudyPlanCard::class)->whereStatus(StudyPlanCard::STATUS_ONGOING)->latest()->first();
    }

    public function getOngoingSemesterAttribute(){
        return $this->hasMany(StudyPlanCard::class)->whereStatus(StudyPlanCard::STATUS_DONE)->count() + 1;
    }
}
