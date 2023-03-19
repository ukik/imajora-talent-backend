<?php

// namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserYoutube extends Model
{
    use SoftDeletes;
    use UserScope;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    use HasFactory;
    protected $table = 'user_youtube';
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
        return $this->hasMany(UserYoutubeComments::class, 'post_id');
    }

    public function liked_total()
    {
        return $this->hasOne(UserYoutubeLikedTotal::class, 'post_id');
    }
    public function liked()
    {
        return $this->hasOne(UserYoutubeLiked::class, 'post_id');
    }

    public function shared_total()
    {
        return $this->hasOne(UserYoutubeSharedTotal::class, 'post_id');
    }

    public function shared()
    {
        return $this->hasOne(UserYoutubeShared::class, 'post_id');
    }

    public function commented_total()
    {
        return $this->hasOne(UserYoutubeCommentedTotal::class, 'post_id');
    }

    public function commented()
    {
        return $this->hasOne(UserYoutubeCommented::class, 'post_id');
    }

    public function bookmarked_total()
    {
        return $this->hasOne(UserYoutubeBookmarkedTotal::class, 'post_id');
    }

    public function bookmarked()
    {
        return $this->hasOne(UserYoutubeBookmarked::class, 'post_id');
    }

    public function visited_total()
    {
        return $this->hasOne(UserYoutubeVisitedTotal::class, 'post_id');
    }

    public function visited()
    {
        return $this->hasOne(UserYoutubeVisited::class, 'post_id');
    }

}
