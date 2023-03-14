<?php

// namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserVideo extends Model
{
    use SoftDeletes;
    use UserScope;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    use HasFactory;
    protected $table = 'user_video';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(UserVideoComments::class, 'post_id');
        return $this->hasMany(ViewUserVideoComments::class, 'post_id');
    }

    public function liked_total()
    {
        return $this->hasOne(UserVideoLikedTotal::class, 'post_id');
    }
    public function liked()
    {
        return $this->hasOne(UserVideoLiked::class, 'post_id');
    }

    public function shared_total()
    {
        return $this->hasOne(UserVideoSharedTotal::class, 'post_id');
    }

    public function shared()
    {
        return $this->hasOne(UserVideoShared::class, 'post_id');
    }

    public function commented_total()
    {
        return $this->hasOne(UserVideoCommentedTotal::class, 'post_id');
    }

    public function commented()
    {
        return $this->hasOne(UserVideoCommented::class, 'post_id');
    }

    public function bookmarked_total()
    {
        return $this->hasOne(UserVideoBookmarkedTotal::class, 'post_id');
    }

    public function bookmarked()
    {
        return $this->hasOne(UserVideoBookmarked::class, 'post_id');
    }

    public function visited_total()
    {
        return $this->hasOne(UserVideoVisitedTotal::class, 'post_id');
    }

    public function visited()
    {
        return $this->hasOne(UserVideoVisited::class, 'post_id');
    }

    // public function follow()
    // {
    //     return $this->hasOne(UserFollow::class, 'user_id', 'follower_id');
    // }

    public function childs()
    {
        return $this->hasMany(VideoComment::class, 'parent_id');
    }
}
