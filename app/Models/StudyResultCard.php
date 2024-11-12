<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class StudyResultCard extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_class_course_id',
        'actual_score',
        'letter_value',
    ];

    public function user_class_course(){
        return $this->belongsTo(UserClassCourse::class);
    }

}
