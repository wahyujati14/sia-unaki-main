<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHealthContribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'is_validate', 'nominal', 'certificate_receive_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
