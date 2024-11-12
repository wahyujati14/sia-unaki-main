<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReregistration extends Model
{
    use HasFactory;
    protected $table = 're_registrations';
    protected $fillable = [
        'user_id', 'is_approve', 'user_payment_id', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function user_payment()
    {
        return $this->belongsTo(UserPayment::class);
    }
}
