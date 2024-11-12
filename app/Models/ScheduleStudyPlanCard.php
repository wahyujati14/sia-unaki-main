<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Date;

class ScheduleStudyPlanCard extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $appends = [
        'duration'
    ];

    public function getDurationAttribute() {
        return (Date::parse($this->end_time)->unix() - Date::parse($this->start_time)->unix()) / 3600;
    }

    public function scopeOfForeignId($query, $column, $id = null) {
        $query->when($id, function($query) use ($column, $id) {
            $query->where($column, $id);
        });
    }

    public function academic_year()
    {
        return $this->belongsTo(AcademicYear::class)->withTrashed();
    }

    public function study_program() {
        return $this->belongsTo(StudyProgram::class)->withTrashed();
    }

}
