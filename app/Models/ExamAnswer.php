<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamAnswer extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'answer',
        'question_id',
        'is_correct'
    ];

    public function question()
    {
        return $this->belongsTo(ExamQuestion::class);
    }
}
