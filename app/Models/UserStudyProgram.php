<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserStudyProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'study_program_id',
        'type',
        'is_confirmed'
    ];

    public function study_program()
    {
        return $this->belongsTo(StudyProgram::class)->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
