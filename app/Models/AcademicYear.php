<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcademicYear extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_year', 'last_year', 'odd_even'
    ];

    public function toDescriptionString() {
        return $this->first_year . '/' . $this->last_year . " ({$this->odd_even})";
    }

    public function user_class_courses() {
        return $this->hasMany(UserClassCourse::class);
    }
}
