<?php

namespace App\Http\Controllers\Api\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\ClassCourse;
use App\Models\RegistrationPath;
use App\Models\ScheduleStudyPlanCard;
use App\Models\StudyPlanCard;
use App\Models\UserClassCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class StudyPlanCardController extends Controller
{
    public function studyPlanCard(Request $request){
        $myStudyPlanCard = StudyPlanCard::with([
            'user_class_courses.class_course.schedule_class_course',
            'academic_year',
            'user_class_courses.class_course.course:id,name,code',
            'user_class_courses.class_course.lecturer:id,name,code'
        ])
        ->whereUserId($request->user()->id)
        ->get()->map(function($query) use ($request){
            $i = 1;
            if($i ++ == $request->semester){
                return $query;
            }
        })->first();
        return $this->getSuccessResponse([
            'user' => $request->user(),
            'my_study_plan_card' => $myStudyPlanCard
        ]);
    }
    public function scheduleStudyPlanCardList(){
        $scheduleStudyPlanCardList = ScheduleStudyPlanCard::with(['academic_year','study_program'])
        ->whereAcademicYearId(Auth::user()->academic_year->id);
        return $scheduleStudyPlanCardList;
    }
    public function classCourseList(Request $request){

        $dateValidate = $this->scheduleStudyPlanCardList()->whereStudyProgramId(Auth::user()->study_program_selected->study_program_id)->first();
        if(!$dateValidate){
            return $this->failedResponse([],'Maaf belum ada jadwal KRS');
        }
        if(Carbon::now() < $dateValidate->start_time){
            return $this->failedResponse([],'Maaf saat ini belum masa KRS');
        }
        if(Carbon::now() > $dateValidate->end_time){
            return $this->failedResponse([],'Maaf waktu KRS telah berakhir');
        }

        //list kelas yang dapat diambil
        $search = $request->class_course;
        $class_courses = ClassCourse::with(['course','schedule_class_course'])
        ->whereIn('semester',$request->user()->getSemesterCanTakeKrs())
        ->has('schedule_class_course')
        ->whereHas('course',function($query){
            $query->whereStudyProgramId(Auth::user()->study_program_selected->study_program_id);
        })
        ->when($search,function($query) use ($search){
            $query->whereHas('course',fn($secondQuery) => $secondQuery->where('name', 'ilike', '%' . $search . '%'));
        })
        ->orderBy('semester')
        ->get()->map(function($query){
            $query->quota_available = $query->quota_available;
            return $query;
        });

        //jika jalur karyawan yg mengisikan krs admin
        if($request->user()->user_information->registration_path->id == RegistrationPath::JALUR_KARYAWAN){
            $class_courses = [];
        }
        return $this->getSuccessResponse([
            'class_courses' => $class_courses,
            'schedule_study_plan_cards' => $this->scheduleStudyPlanCardList()->get()
        ]);
    }

    public function studyPlanCardStore(Request $request){
        $rule = [
            'class_course_id' => 'required|array',
        ];
        $validator = Validator::make($request->all(), $rule);
        if ($validator->fails()) {
            return $this->errorValidationResponse($validator);
        }

        DB::beginTransaction();
        try {
            $studyPlanCard = StudyPlanCard::firstOrCreate([
                'user_id' => $request->user()->id,
                'academic_year_id' => $request->user()->academic_year->id
            ],[
                'user_id' => $request->user()->id,
                'academic_year_id' => $request->user()->academic_year->id,
                'note' => '-'
            ]);
            $userClassCourses = ClassCourse::whereIn('id',$request->class_course_id)->get()->map(function($query) use ($studyPlanCard){
                return [
                    'class_course_id' => $query->id,
                    'study_plan_card_id' => $studyPlanCard->id,
                    'credit_course' => $query->credit_course,
                    'course_id' => $query->course_id,
                    'lecturer_id' => $query->lecturer_id,
                    'status' => StudyPlanCard::STATUS_WAITING,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            })->toArray();
            if(UserClassCourse::whereIn('class_course_id',$request->class_course_id)->exists()){
                return $this->failedResponse([],'Maaf ada kelas matakuliah yg telah anda simpan sebelumnya, silakan hapus matakuliah untuk melanjutkan !!');
            }
            if(collect($userClassCourses)->sum('credit_course') > $this->creditCourseMaxTake()){
                return $this->failedResponse([],'Maaf anda hanya diijinkan maksimal mengambil '.$this->creditCourseMaxTake().' SKS');
            }
            UserClassCourse::insert($userClassCourses);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::debug($e->getMessage());
            return $this->failedResponse([],$e->getMessage());
        }
        return $this->postSuccessResponse([],'Krs berhasil disimpan');
    }


    /*
     IPS >= 3 Max ambil 24 SKS
     IPS 2,5 sampai 2.99 Max ambil 22 SKS
     IPS 2 sampai 2.49 Max ambil 20 SKS
     IPS < 2 Max ambil 18 SKS

    */
    public function creditCourseMaxTake(){
        $previousPerformanceIndexSemester = $this->previousPerformanceIndex();
        switch (true) {
            case ($previousPerformanceIndexSemester >= 3):
                return 25;
                break;
            case ($previousPerformanceIndexSemester >= 25 && $previousPerformanceIndexSemester >= 2.99):
                return 22;
                break;
            case ($previousPerformanceIndexSemester >= 2 && $previousPerformanceIndexSemester >= 2.49):
                return 20;
                break;
            default:
                return 18;
          }
    }

    public function previousPerformanceIndex(){
        $ongoingAcademicYear = Auth::user()->academic_year;
        $previousAcademicYearId = AcademicYear::where('id','<',$ongoingAcademicYear->id)->max('id');
        return StudyPlanCard::whereUserId( Auth::user()->id)->whereAcademicYearId($previousAcademicYearId)->first()->semester_performance_index ?? 0;
    }


}
