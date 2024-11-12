<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'code', 'study_program_id'
    ];

    public function study_program()
    {
        return $this->belongsTo(StudyProgram::class)->withTrashed();
    }
}
