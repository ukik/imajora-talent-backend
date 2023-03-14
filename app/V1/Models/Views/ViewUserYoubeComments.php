<?php

// namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewUserYoubeComments extends Model
{
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    use UserScope;
    use HasFactory;
    protected $table = 'view_user_youtube_comments';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function childs()
    {
        return $this->hasMany(ViewUserYoubeComments::class, 'parent_id'); //->limit(5);
    }
}
