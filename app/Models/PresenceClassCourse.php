<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresenceClassCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_class_course_id',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function user_class_course(){
        return $this->belongsTo(UserClassCourse::class);
    }
}
