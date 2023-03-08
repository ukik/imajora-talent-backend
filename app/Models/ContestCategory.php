<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContestCategory extends Model
{
    use HasFactory;

    protected $table = 'contest_categories';
    protected $guarded = [];

    public function contests()
    {
        return $this->hasMany(Contest::class);
    }
}
