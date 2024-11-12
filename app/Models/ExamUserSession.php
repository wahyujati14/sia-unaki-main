<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamUserSession extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'exam_session_id',
        'is_success',
        'is_failed',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exam_session()
    {
        return $this->belongsTo(ExamSession::class);
    }

    public function exam_user_answers()
    {
        return $this->hasMany(ExamUserAnswer::class);
    }
}
