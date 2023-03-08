<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'description',
        'content',
        'trailer',
        'status',
        'user_id',
        'genre_id',
    ];

    public function devices()
    {
        return $this->belongsToMany(Device::class, 'game_device', 'game_id', 'device_id')->withTimestamps();
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(GameComment::class);
    }
}