<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends Model
{
    use SoftDeletes,HasFactory;

    protected $fillable = [
        'name',
        'city_id',
    ];

    protected $appends = [
        'city_name',
        'provincy_name',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function getCityNameAttribute()
    {
        return $this->city->name;
    }

    public function getProvincyNameAttribute()
    {
        return $this->city->provincy->name;
    }
}
