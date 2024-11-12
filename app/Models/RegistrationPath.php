<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegistrationPath extends Model
{
    use SoftDeletes, HasFactory;

    const JALUR_TEST = 1;
    const JALUR_NON_TEST = 2;
    const JALUR_AKADEMIK = 3;
    const JALUR_NON_AKADEMIK = 4;
    const JALUR_TRANSFER = 5;
    const JALUR_KIP = 6;
    const JALUR_KARYAWAN = 7;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'code',
        'is_active'
    ];

    public function exam_registration_path()
    {
        return $this->hasOne(ExamRegistrationPath::class);
    }
}
