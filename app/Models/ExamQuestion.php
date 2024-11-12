<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamQuestion extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'question',
        'image',
        'exam_id',
    ];

    public function user_answer()
    {
        return $this->hasMany(ExamUserAnswer::class);
    }

    public function exam_answers()
    {
        return $this->hasMany(ExamAnswer::class, 'question_id', 'id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
