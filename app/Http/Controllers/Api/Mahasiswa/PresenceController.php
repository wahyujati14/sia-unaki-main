<?php

namespace App\Http\Controllers\Api\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\ClassCourse;
use App\Models\MeetingClassCourse;
use App\Models\PresenceClassCourse;
use App\Models\StudyPlanCard;
use App\Models\UserClassCourse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class PresenceController extends Controller
{
    public function courseScheduleList(){
        $userClassCourses = Cache::remember('my_course_schedules', 10, function() {
            return UserClassCourse::with([
                'class_course.schedule_class_course.room',
                'course',
                'class_course.lecturer'
            ])
            ->whereHas('study_plan_card',function($query){
                $query->whereUserId(Auth::user()->id)->whereStatus(StudyPlanCard::STATUS_ONGOING);
            })
            ->get()
            ->sortBy('class_course.schedule_class_course.day')
            ->sortBy('class_course.schedule_class_course.start_time')
            ->groupBy(function($query){
                return $query->class_course->schedule_class_course->day;
            });
        });

        return $this->getSuccessResponse(['user_class_courses' => $userClassCourses]);
    }

    public function classCourseShow(Request $request){
       $userClassCourse = UserClassCourse::with([
        'class_course.schedule_class_course.room',
        'course',
        'class_course.lecturer',
        'class_course.meeting_class_courses',
        'presence_class_courses'
        ])
        ->whereHas('study_plan_card',function($query){
            $query->whereUserId(Auth::user()->id)->whereStatus(StudyPlanCard::STATUS_ONGOING);
        })
        ->find($request->user_class_course_id);
        return $this->getSuccessResponse(['user_class_course' => $userClassCourse]);
    }

    public function presenceQrcode(Request $request){
        $rule = [
            'user_class_course_id' => 'required|exists:user_class_courses,id'
        ];
        $validator = Validator::make($request->all(), $rule);
        if($validator->fails()) {
            return $this->errorValidationResponse($validator);
        }

        // cek valid apa tidak
        if(!$this->qrcodeValidate($request)){
            return $this->failedResponse([],'Maaf Qr Code tidak valid atau expired');
        }

        //cek sudah pernah absen apa belum
        $presenceExists =  PresenceClassCourse::whereUserId($request->user()->id)
        ->whereUserClassCourseId($request->user_class_course_id)
        ->whereDate('created_at',Carbon::now()->toDate())
        ->exists();
        if($presenceExists) return $this->failedResponse([],'Maaf anda telah melakukan presensi kehadiran sebelumnya');

        $presenceClassCourse = PresenceClassCourse::create([
            'user_id' => $request->user()->id,
            'user_class_course_id' => $request->user_class_course_id
        ]);

        return $this->getSuccessResponse(['presence_class_course' => $presenceClassCourse]);
    }

    public function qrcodeValidate($request){
       return UserClassCourse::find($request->user_class_course_id)->whereHas('class_course',function($query) use ($request){
            $query->wherePresenceQrcode($request->qrcode)
            ->whereDate('updated_at',Carbon::now()->toDate());
        })->exists();
    }

    public function presenceList(Request $request){
       $classCourse = ClassCourse::whereHas('user_class_courses.study_plan_card',fn($query) => $query->whereUserId($request->user()->id))
       ->with([
        'schedule_class_course.room',
        'course',
        'lecturer',
        'meeting_class_courses'
       ])
       ->find($request->class_course_id);
       $userClassCourses = $classCourse->user_class_courses()->get()->map(function($query){
           return array_merge([
                'user' => $query->study_plan_card->user,
                'present_total' => $query->presence_class_courses->count()
            ],$query->makeHidden(['presence_class_courses'])->toArray());
       });
       return $this->getSuccessResponse([
            'class_course' => $classCourse,
            'user_class_courses' => $userClassCourses
        ]);
    }

    public function presenceShow(Request $request){
        $presence = PresenceClassCourse::whereHas('user_class_course',fn($query) => $query->whereClassCourseId($request->class_course_id));
        $meetTotal = MeetingClassCourse::whereClassCourseId($request->class_course_id)->count();

        return $this->getSuccessResponse([
            'user' => $request->user(),
            'presence' => $presence->count(),
            'meet_total' => $meetTotal,
            'percentage' => $presence->count() > 0 ? ($presence->count() / $meetTotal ) * 100 : 0
        ]);
    }
}
