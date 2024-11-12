<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserInformation extends Model
{
    use SoftDeletes, HasFactory;
    protected $table = 'user_informations';

    protected $fillable = [
            'user_id',
            'religion_id',
            'province_id',
            'city_id',
            'district_id',
            'sub_district_id',
            'registration_path_id',
            'registration_periode_id',
            'birth_place',
            'birth',
            'is_work',
            'last_education',
            'gender',
            'parent_name',
            'biological_mother',
            'parent_phone',
            'parent_address',
            'identity_address',
            'current_address',
            'avatar',
            'user_verification',
        ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class);        
    }

    public function province()
    {
        return $this->belongsTo(Provincy::class);
    }

    public function city()
    {    
        return $this->belongsTo(City::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function sub_district()
    {
        return $this->belongsTo(SubDistrict::class);
    }

    public function registration_path()
    {
        return $this->belongsTo(RegistrationPath::class);
    }

    public function registration_periode()
    {
        return $this->belongsTo(RegistrationPeriode::class);
    }
    
}
