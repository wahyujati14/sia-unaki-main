<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubDistrict extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'district_id'
    ];

    protected $appends = [
        'city_name',
        'provincy_name',
        'district_name',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function getDistrictNameAttribute()
    {
        return $this->district->name;
    }

    public function getCityNameAttribute()
    {
        return $this->district->city->name;
    }

    public function getProvincyNameAttribute()
    {
        return $this->district->city->provincy->name;
    }

}
