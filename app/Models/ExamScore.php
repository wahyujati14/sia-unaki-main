<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamScore extends Model
{
    use HasFactory, SoftDeletes;
    const AKADEMIK = 'AKADEMIK';
    const NON_AKADEMIK = 'NON_AKADEMIK';
    protected $fillable = [
        'name',
        'start_score',
        'end_score',
        'type'
    ];

    public static function getExamScore($score)
    {
        return self::where('start_score', '>=', $score)->where('type', self::AKADEMIK)->where('end_score', '<=', $score)->first()?->name??'SCORE TIDAK DI TEMUKAN';
    }
}
