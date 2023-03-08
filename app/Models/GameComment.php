<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameComment extends Model
{
    use HasFactory;
    protected $table = 'game_comments';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function childs()
    {
        return $this->hasMany(Comment::class, 'parent');
    }
}