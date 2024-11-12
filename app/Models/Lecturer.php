<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Lecturer extends Authenticatable
{
    use HasFactory, SoftDeletes;

    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_OFF = 'OFF'; 

    protected $fillable = [
        'study_program_id', 'academic_degree', 'code', 'number', 'name', 'address', 'phone', 'email', 'certificate_sign', 'status', 'password'
    ];

    public static function statuses() {
        return [
            self::STATUS_ACTIVE => 'Aktif Mengajar',
            self::STATUS_OFF => 'Off',
        ];
    }

    public function scopeOfCode($query, $code) {
        return $query->where('code', $code);
    }

    public function study_program()
    {
        return $this->belongsTo(StudyProgram::class)->withTrashed();
    }
}
