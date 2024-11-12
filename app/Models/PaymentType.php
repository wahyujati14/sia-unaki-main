<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory;
    const XENDIT = 1;
    const UPLOAD_BUKTI = 2;
    protected $table = 'payment_types';
    protected $fillable = [
        'name',
        'is_active'
    ];
}
