<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserClassCourse extends Model
{
    use HasFactory, SoftDeletes;

    const WAITING = 'WAITING';
    const APPROVED = 'APPROVED';
    const DECLINED = 'DECLINED';
    
    protected $fillable = [
        'class_course_id', 'study_plan_card_id', 'credit_course', 'course_id', 'lecturer_id', 'name', 'status'
    ];

    protected $appends = [
        'status_text'
    ];

    public static function statuses() {
        return [
            'WAITING' => 'Menunggu Konfirmasi',
            'APPROVED' => 'Terkonfirmasi',
            'DECLINED' => 'Ditolak'
        ];
    }

    public function getStatusTextAttribute() {
        return data_get(self::statuses(), $this->status ?? '', '-');
    } 

    public function markAsApproved() {
        $this->status = self::APPROVED;
        $this->save();

        return $this;
    }

    public function markAsDeclined() {
        $this->status = self::DECLINED;
        $this->save();

        return $this;
    }

    public function scopeOfForeignId($query, $column, $id = null) {
        $query->when($id, function($query) use ($column, $id) {
            $query->where($column, $id);
        });
    }

    public function class_course()
    {
        return $this->belongsTo(ClassCourse::class)->withTrashed();
    }

    public function study_plan_card()
    {
        return $this->belongsTo(StudyPlanCard::class)->withTrashed();
    }

    public function course() {
        return $this->belongsTo(Course::class)->withTrashed();
    }

    public function lecturer() {
        return $this->belongsTo(Lecturer::class)->withTrashed();
    }

    public function presence_class_courses(){
        return $this->hasMany(PresenceClassCourse::class);
    }

    public function study_result_card(){
        return $this->hasOne(StudyResultCard::class)->withTrashed();
    }

    public function academic_year() {
        return $this->belongsTo(AcademicYear::class)->withTrashed();
    }
}
