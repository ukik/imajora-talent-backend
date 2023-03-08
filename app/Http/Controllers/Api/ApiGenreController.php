<?php

namespace App\Http\Controllers\Api;

use App\Models\Genre;

class ApiGenreController extends TagBasedController
{
    protected $model = Genre::class;
}
