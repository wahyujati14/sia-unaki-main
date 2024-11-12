<?php

namespace App\Models;

use App\Models\Concerns\HasForeignFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudyPlanCard extends Model
{
    use HasFactory, SoftDeletes, HasForeignFilter;

    const STATUS_WAITING = 'WAITING';
    const STATUS_DECLINED = 'DECLINED';
    const STATUS_DONE = 'DONE';
    const STATUS_ONGOING = 'ONGOING';

    protected $fillable = [
        'user_id', 'academic_year_id', 'note', 'status'
    ];

    public static function statuses() {
        return [
            self::STATUS_WAITING => 'Menunggu (Baru Dibuat)',
            self::STATUS_DECLINED => 'Ditolak',
            self::STATUS_DONE => 'Tamat (Closed)',
            self::STATUS_ONGOING => 'Sedang Menjalani',
        ];
    }
    
    public function scopeOfStudyProgram($query, $study_program_id = null) {
        return $query->when($study_program_id, function($query) use ($study_program_id) {
            $query->whereHas('user.study_program_selected', function($q) use ($study_program_id) {
                $q->where('study_program_id', $study_program_id);
            });
        });
    }

    public function scopeOfStatus($query, $status = null) {
        return $query->when($status, function($query) use ($status) {
            $query->where('status', $status);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function academic_year()
    {
        return $this->belongsTo(AcademicYear::class)->withTrashed();
    }

    public function faculties()
    {
        return $this->hasOne(Faculties::class);
    }

    public function user_class_courses(){
        return $this->hasMany(UserClassCourse::class);
    }

    public function getCreditCourseTotalAttribute()
    {
        // total sks yang di diambil
        return $this->user_class_courses()->sum('credit_course');
    }

    public function getCreditsMultipliedByGradeAttribute(){
        //jumlah mutu = angka mutu (actual score) x Kredit (credit_course)
        return $this->hasMany(UserClassCourse::class)->has('study_result_card')->get()->reduce(function ($total,$userClassCourse) {
            return $total + ($userClassCourse->study_result_card->count() > 0 ? $userClassCourse->study_result_card->actual_score * $userClassCourse->credit_course : 0);
        },0);
    }

    public function getSemesterPerformanceIndexAttribute()
    {
        //index prestasi semester = jumlah mutu / jumlah kredit (sks)
        return number_format($this->getCreditsMultipliedByGradeAttribute() / $this->getCreditCourseTotalAttribute(),2);
    }

}
