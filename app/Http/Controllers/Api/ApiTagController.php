<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;

class ApiTagController extends TagBasedController
{
    protected $model = Tag::class;
}
