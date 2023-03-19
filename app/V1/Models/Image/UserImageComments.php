<?php

// namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserImageComments extends Model
{
    use SoftDeletes;
    use UserScope;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    use HasFactory;
    protected $table = 'user_image_comments';
    protected $guarded = [];
    protected $dates = ['deleted_at'];
    protected $appends = ['lines','pressed'];

    protected $fillable = [
        'post_id',
        'user_id',
        'parent_id',
        'replied_id',
        'comment',
        'diblokir',
    ];

    public function getLinesAttribute() {
        return 2;
    }

    public function getPressedAttribute() {
        return false;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replied()
    {
        return $this->belongsTo(User::class, 'replied_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // public function childs()
    // {
    //     return $this->hasMany(VideoComment::class, 'parent_id');
    // }
}
