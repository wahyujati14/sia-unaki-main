<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyResultCardScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'study_result_card_id',
        'user_class_course_id',
        'course_id',
        'user_id',
        'letter_value',
        'score',
        'credit_course'
    ];

    public function study_result_card(){
        return $this->belongsTo(StudyResultCard::class)->withTrashed();
    }

    public function user_class_course(){
        return $this->belongsTo(UserClassCourse::class)->withTrashed();
    }
    public function course(){
        return $this->belongsTo(Course::class)->withTrashed();
    }
}
