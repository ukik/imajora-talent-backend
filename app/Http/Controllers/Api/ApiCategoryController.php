<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;

class ApiCategoryController extends TagBasedController
{
    protected $model = Category::class;
}
