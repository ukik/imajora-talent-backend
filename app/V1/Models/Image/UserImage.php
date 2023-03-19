<?php

// namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserImage extends Model
{
    use SoftDeletes;
    use UserScope;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    use HasFactory;
    protected $table = 'user_image';
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

    public function images()
    {
        return $this->hasMany(UserImageFile::class, 'post_id')->limit(5);
    }

    public function comments()
    {
        return $this->hasMany(UserImageComments::class, 'post_id');
    }

    public function liked_total()
    {
        return $this->hasOne(UserImageLikedTotal::class, 'post_id');
    }
    public function liked()
    {
        return $this->hasOne(UserImageLiked::class, 'post_id');
    }

    public function shared_total()
    {
        return $this->hasOne(UserImageSharedTotal::class, 'post_id');
    }

    public function shared()
    {
        return $this->hasOne(UserImageShared::class, 'post_id');
    }

    public function commented_total()
    {
        return $this->hasOne(UserImageCommentedTotal::class, 'post_id');
    }

    public function commented()
    {
        return $this->hasOne(UserImageCommented::class, 'post_id');
    }

    public function bookmarked_total()
    {
        return $this->hasOne(UserImageBookmarkedTotal::class, 'post_id');
    }

    public function bookmarked()
    {
        return $this->hasOne(UserImageBookmarked::class, 'post_id');
    }

    public function visited_total()
    {
        return $this->hasOne(UserImageVisitedTotal::class, 'post_id');
    }

    public function visited()
    {
        return $this->hasOne(UserImageVisited::class, 'post_id');
    }

}
