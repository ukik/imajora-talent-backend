<?php

// namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserImageFile extends Model
{
    use UserScope;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    use HasFactory;
    protected $table = 'user_image_file';
    protected $guarded = [];

    protected $fillable = [
        'post_id',
        'user_id',
        'parent_id',
        'comment',
        'diblokir',
    ];

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
        return $this->hasMany(ImageComment::class, 'parent_id');
    }
}
