<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamUserAnswer extends Model
{
    use HasFactory;
    protected $fillable = [
        'exam_user_session_id',
        'exam_answer_id',
        'exam_question_id',
    ];

    protected $appends = [
        'answer_name'
    ];

    public function exam_answer()
    {
        return $this->belongsTo(ExamAnswer::class);
    }

    public function exam_question()
    {
        return $this->belongsTo(ExamQuestion::class);
    }

    public function exam_user_session()
    {
        return $this->belongsTo(ExamUserSession::class);
    }

    public function getAnswerNameAttribute()
    {
        return $this->exam_answer->answer;
    }
}
