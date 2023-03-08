<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContestTag extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeSearch($query, $title)
    {
        return $query->where('title', 'LIKE', "%{$title}%");
    }

    public function contest()
    {
        return $this->belongsToMany(Contest::class)->withTimestamps();
    }
}
