<?php

namespace App\Models;

use App\Models\Traits\StudyPlanCardTrait;
use App\Models\Traits\StudyResultCardTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, StudyPlanCardTrait, StudyResultCardTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'nim',
        'nik',
        'phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // protected $appends = [
    //     'study_program_first',
    //     'study_program_second'
    // ];

    public function user_information()
    {
        return $this->hasOne(UserInformation::class);
    }

    public function user_information_source()
    {
        return $this->hasMany(UserInformationSource::class);
    }

    public function school_origin()
    {
        return $this->hasOne(SchoolOrigin::class);
    }

    public function user_study_program()
    {
        return $this->hasMany(UserStudyProgram::class);
    }

    public function user_file_upload()
    {
        return $this->hasMany(UserFileUpload::class, 'user_id', 'id');
    }

    public function study_program_first()
    {
        return $this->user_study_program()->where('type', 'FIRST')->first()->study_program->name;
    }

    public function study_program_selected()
    {
        return $this->hasOne(UserStudyProgram::class)->where('is_confirmed', true);
    }

    public function study_program_second()
    {
        return $this->user_study_program()->where('type', 'SECOND')->first()->study_program->name;
    }

    public function study_plan_card() {
        return $this->hasMany(StudyPlanCard::class);
    }

    public function user_lecturer() {
        return $this->hasOne(UserLecturer::class)->orderBy('created_at', 'desc');
    }

    public function lecturer() {
        return $this->hasOneThrough(Lecturer::class, UserLecturer::class, 'user_id', 'id', 'id', 'lecturer_id');
    }

    public function is_complate_data()
    {
        if($this->user_information()->exists() && $this->school_origin()->exists() && $this->user_file_upload()->exists() && $this->user_study_program()->exists() && $this->user_information_source()->exists()){
            return true;
        }
        return false;
    }

    public function user_exam()
    {
        return $this->belongsTo(UserExam::class, 'id', 'user_id');
    }

    public function user_payments()
    {
        return $this->hasMany(UserPayment::class);
    }

    public function user_registration()
    {
        return $this->user_payments()->where('type', UserPayment::TYPE_REGISTRATION)->first();
    }

    public function certificate_receive()
    {
        return $this->hasOne(CertificateReceive::class);
    }

    public function user_reregistration()
    {
        return $this->hasOne(UserReregistration::class);
    }

    public function user_initial_payment()
    {
        return $this->hasOne(UserInitialPayment::class);
    }

    public function kemahasiswaan_contribution()
    {
        return $this->hasOne(UserKemahasiswaanContribution::class);
    }

    public function library_contribution()
    {
        return $this->hasOne(UserLibraryContribution::class);
    }

    public function health_payment()
    {
        return $this->hasOne(UserLibraryContribution::class);
    }

    public function exam_user_session()
    {
        return $this->hasOne(ExamUserSession::class);
    }

    public function study_plan_cards() {
        return $this->hasMany(StudyPlanCard::class);
    }

    public static function getNim($periode, $user)
    {
        $user_before = DB::table('users')
        ->select('*', DB::raw("SPLIT_PART(nim,  '.', 3) AS nomor"), DB::raw("SPLIT_PART(nim,  '.', 2) AS year"))
        ->orderBy('year', 'desc')
        ->orderBy('nomor', 'desc')
        ->whereNotNull('nim')
        ->first();
        $year = $periode?->year??date('Y');
        $number = $user_before?->nomor??0;
        return $user->study_program_selected()->first()->study_program->code.".".substr($year, -2).".".str_pad($number + 1, 4, "0", STR_PAD_LEFT);
    }

    // this is a recommended way to declare event handlers
    public static function boot() {
        parent::boot();

        static::deleting(function($user) { // before delete() method call this
            $user->user_information()->delete();
            $user->user_information_source()->delete();
            $user->school_origin()->delete();
            $user->user_study_program()->delete();
            $user->user_file_upload()->delete();
            $user->exam_user_session()->delete();
            $user->user_payments()->delete();
            $user->certificate_receive()->delete();
            $user->user_reregistration()->delete();
            $user->user_initial_payment()->delete();
            $user->kemahasiswaan_contribution()->delete();
            $user->library_contribution()->delete();
            $user->health_payment()->delete();
             // do the rest of the cleanup...
        });
    }

     public function getAcademicYearAttribute(){
         return AcademicYear::latest()->first();
     }

     public function getCurrentSemester($academic_year_id = null) {
        if ($academic_year_id) {
            return $this->study_plan_card
                ->where('academic_year_id', $academic_year_id)
                ->whereIn('status', [StudyPlanCard::STATUS_DONE, StudyPlanCard::STATUS_ONGOING])
                ->count();
        }

        return $this->study_plan_card
            ->whereIn('status', [StudyPlanCard::STATUS_DONE, StudyPlanCard::STATUS_ONGOING])
            ->count();
     }

}
