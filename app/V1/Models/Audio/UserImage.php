<?php

// namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAudio extends Model
{
    use SoftDeletes;
    use UserScope;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    use HasFactory;
    protected $table = 'user_audio';
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
        return $this->hasMany(UserAudioComments::class, 'post_id');
    }

    public function liked_total()
    {
        return $this->hasOne(UserAudioLikedTotal::class, 'post_id');
    }
    public function liked()
    {
        return $this->hasOne(UserAudioLiked::class, 'post_id');
    }

    public function shared_total()
    {
        return $this->hasOne(UserAudioSharedTotal::class, 'post_id');
    }

    public function shared()
    {
        return $this->hasOne(UserAudioShared::class, 'post_id');
    }

    public function commented_total()
    {
        return $this->hasOne(UserAudioCommentedTotal::class, 'post_id');
    }

    public function commented()
    {
        return $this->hasOne(UserAudioCommented::class, 'post_id');
    }

    public function bookmarked_total()
    {
        return $this->hasOne(UserAudioBookmarkedTotal::class, 'post_id');
    }

    public function bookmarked()
    {
        return $this->hasOne(UserAudioBookmarked::class, 'post_id');
    }

    public function visited_total()
    {
        return $this->hasOne(UserAudioVisitedTotal::class, 'post_id');
    }

    public function visited()
    {
        return $this->hasOne(UserAudioVisited::class, 'post_id');
    }

}
