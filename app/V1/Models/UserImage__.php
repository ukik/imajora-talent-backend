<?php

// namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserImage__ extends Model
{
    use UserScope;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    use HasFactory;
    protected $table = 'user_image';
    protected $guarded = [];

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
        return $this->hasMany(ViewUserImageComments::class, 'post_id');
    }

    public function images()
    {
        return $this->hasMany(UserImageFile::class, 'post_id');
    }

    public function childs()
    {
        return $this->hasMany(ImageComment::class, 'parent_id');
    }
}
