<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use HasFactory;
    protected $table = 'contests';
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(CommentContest::class);
    }

    public function categories()
    {
        return $this->belongsTo(ContestCategory::class, 'contest_category_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(ContestTag::class, 'tags_contests', 'contest_id', 'tag_id')->withTimestamps();
    }
}
