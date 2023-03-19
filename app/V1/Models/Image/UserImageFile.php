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
        'file',
        'thumbnail',
        // 'diblokir',
    ];

}
