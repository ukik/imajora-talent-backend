<?php

// namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFollow extends Model
{
    use UserScope;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    use HasFactory;
    protected $table = 'user_follow';
    protected $guarded = [];
    protected $fillable = [
        'user_id',
        'follower_id',
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function post()
    // {
    //     return $this->belongsTo(Post::class);
    // }

    // public function comments()
    // {
    //     return $this->hasMany(ViewUserVideoComments::class, 'post_id');
    // }

    // public function childs()
    // {
    //     return $this->hasMany(VideoComment::class, 'parent_id');
    // }
}
