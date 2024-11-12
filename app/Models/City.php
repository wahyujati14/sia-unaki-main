<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use SoftDeletes,HasFactory;
    protected $fillable = [
        'name',
        'provincy_id'
    ];

    protected $appends = [
        'provincy_name'
    ];

    public function provincy()
    {
        return $this->belongsTo(Provincy::class);
    }

    public function getProvincyNameAttribute()
    {
        return $this->provincy->name??'';
    }
}
