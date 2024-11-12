<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformationService extends Model
{
    use HasFactory;
    protected $fillable = [
        'email', 'phone', 'whatsapp', 'account_number', 'payment_registrations', 'initial_payment', 'health_payment',
        'kemahasiswaan_contribution',
        'library_contribution',
        'ematerai',
        'discount',
        'institute_development_contribution_reguler',
        'institute_development_contribution',
        'education_construction_contribution',
        'sks'
    ];

    public static function re_registration_price()
    {
        return 
        self::find(1)->initial_payment +
        self::find(1)->kemahasiswaan_contribution +
        self::find(1)->library_contribution +
        self::find(1)->health_payment +
        self::find(1)->ematerai -
        self::find(1)->discount;
    }
}
