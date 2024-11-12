<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDiscountPayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'nominal', 'certificate_receive_id'
    ];
}
