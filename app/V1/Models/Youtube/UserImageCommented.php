<?php

// namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserYoutubeCommented extends Model
{
    use UserScope;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    use HasFactory;
    protected $table = 'user_youtube_commented';
    protected $guarded = [];

}
