<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassCourse extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'course_id', 'lecturer_id', 'code', 'type', 'credit_course', 'credit_course_hourly', 'credit_course_payment', 'note', 'semester',
        'presence_weight', 'quiz_weight', 'task_weight', 'tts_weight', 'tas_weight', 'scoring_system', 'avg_score', 'deviation', 'valid_score'
    ];

    protected $appends = [
        'total_weight'
    ];

    public function getTotalWeightAttribute() {
        return $this->presence_weight + $this->quiz_weight + $this->task_weight + $this->tts_weight + $this->tas_weight;
    }

    public function course()
    {
        return $this->belongsTo(Course::class)->withTrashed();
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class)->withTrashed();
    }

    public function schedule_class_course(){
         return $this->hasOne(ScheduleClassCourse::class);
    }

    public function getQuotaAvailableAttribute(){
        return $this->schedule_class_course?->quota > 0 ? $this->schedule_class_course->quota - $this->user_class_course?->count() : 0;
    }

    public function user_class_courses(){
        return $this->hasMany(UserClassCourse::class,'class_course_id');
    }

    public function presence_class_courses(){
        return $this->hasMany(PresenceClassCourse::class);
    }

    public function meeting_class_courses(){
        return $this->hasMany(MeetingClassCourse::class);
    }
}
