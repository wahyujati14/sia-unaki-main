<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudyProgram extends Model
{
    use softDeletes,HasFactory;

    protected $fillable = [
        'name',
        'faculty_id',
        'code'
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculties::class);
    }
}
