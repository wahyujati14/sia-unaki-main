<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolOrigin extends Model
{
    use SoftDeletes, HasFactory;
    
    protected $fillable = [
        'user_id',
        'name',
        'major',
        'graduation_year'
    ];
}
