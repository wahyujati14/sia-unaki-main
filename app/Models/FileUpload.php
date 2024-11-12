<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FileUpload extends Model
{
    use SoftDeletes,HasFactory;

    const TRANSKRIP = 1;
    const SCAN_KIP = 2;
    const PIAGAM_TERBAIK = 3;
    const SCAN_BUKTI_PEMBAYARAN = 4;
    const KHS = 5;
    const PAS_PHOTO = 6;
    const RE_REGISTRATION = 7;
    
    const JALUR_TEST = [self::TRANSKRIP];
    const JALUR_NON_TEST = [self::TRANSKRIP];
    const JALUR_AKADEMIK = [self::TRANSKRIP, self::PIAGAM_TERBAIK];
    const JALUR_NON_AKADEMIK = [self::TRANSKRIP, self::PIAGAM_TERBAIK];
    const JALUR_KIP = [self::TRANSKRIP, self::SCAN_KIP];
    const JALUR_TRANSFER = [self::KHS];
    protected $fillable = [
        'name',
        'size',
        'type',
        'description'
    ];
}
