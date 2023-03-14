<?php

// namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVideoBookmarkedTotal extends Model
{
    use UserScope;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    use HasFactory;
    protected $table = 'user_video_bookmarked_total';
    protected $guarded = [];
    protected $fillable = ['post_id','total'];

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
