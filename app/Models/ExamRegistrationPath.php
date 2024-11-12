<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamRegistrationPath extends Model
{
    use HasFactory;
    protected $fillable = [
        'exam_id', 'registration_path_id'
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function registration_path()
    {
        return $this->belongsTo(RegistrationPath::class);
    }
}
