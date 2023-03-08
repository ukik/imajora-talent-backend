<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;

class Helper
{
    public static function uniqueSlug(string $str, $model): string
    {
        $slug = Str::slug($str);
        $count = $model::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
        return $count ? "{$slug}-{$count}" : $slug;
    }
}
