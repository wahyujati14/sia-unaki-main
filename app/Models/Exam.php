<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Exam extends Model
{
    use HasFactory, SoftDeletes;
    const REGISTRATION = 1;
    protected $fillable = [
        'name',
        'exam_level_id',
        'is_active',
        'duration',
    ];

    public function questions()
    {
        return $this->hasMany(ExamQuestion::class);
    }

    public function exam_level()
    {
        return $this->belongsTo(ExamLevel::class);
    }

    public function exam_registration_paths()
    {
        return $this->hasMany(ExamRegistrationPath::class, 'exam_id', 'id');
    }

    public function getQuestionRandom($exam_id, $question_id = null)
    {
        $exam = Exam::find($exam_id);
        if($question_id){
            return $this->questions()->where('id', $question_id)->first();
        }
        return $this->questions()->whereNotIn('id', ExamUserAnswer::where('exam_user_session_id', ExamUserSession::where('user_id', Auth::user()->id)->first()->id)->pluck('exam_question_id')->toArray())->inRandomOrder()->first();
    }
}
