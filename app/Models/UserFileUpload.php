<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserFileUpload extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'file',
        'file_name',
        'file_type',
        'file_upload_id',
        'file_verification'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
