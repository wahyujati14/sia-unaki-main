<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleClassCourse extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'class_course_id', 'room_id', 'code', 'days', 'quota',
        'start_time', 'end_time'
    ];

    protected $appends = [
        'day'
    ];

    public static function days(?int $index = null) {
        $arr = [
            '1' => 'Senin',
            '2' => 'Selasa',
            '3' => 'Rabu',
            '4' => 'Kamis',
            '5' => 'Jumat',
            '6' => 'Sabtu',
            '7' => 'Minggu'
        ];

        return $index == null ? $arr : $arr[$index];
    }

    public function getDayAttribute() {
        return $this->days($this->days);
    }

    public function class_course()
    {
        return $this->belongsTo(ClassCourse::class)->withTrashed();
    }

    public function room() {
        return $this->belongsTo(Room::class)->withTrashed();
    }
}
