<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagContest extends Model
{
    use HasFactory;

    protected $table = 'tags_contests';
    protected $guarded = [];
}
