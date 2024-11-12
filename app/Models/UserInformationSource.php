<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserInformationSource extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'information_source_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function information_source()
    {
        return $this->belongsTo(InformationSource::class);
    }
}
