<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLecturer extends Model
{
    use HasFactory;

    const STATUS_WAITING = 'WAITING';
    const STATUS_APPROVED = 'APPROVED';
    const STATUS_DECLINED = 'DECLINED';

    protected $fillable = [
        'user_id', 'lecturer_id', 'status'
    ];

    public static function statuses() {
        return [
            self::STATUS_WAITING => 'Menunggu Konfirmasi',
            self::STATUS_APPROVED => 'Disetujui',
            self::STATUS_DECLINED => 'Ditolak',
        ];
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function lecturer() {
        return $this->belongsTo(Lecturer::class)->withTrashed();
    }
}
