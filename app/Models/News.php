<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'news_category_id',
        'description'
    ];

    public function news_category(){
        return $this->belongsTo(NewsCategory::class);
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('Y-m-d h:i:s');
    }

    protected static function boot() {
        parent::boot();
        static::creating(function ($news) {
            $news->slug = Str::slug($news->title);
        });
        static::updating(function ($news) {
            $news->slug = Str::slug($news->title);
        });
    }
}
