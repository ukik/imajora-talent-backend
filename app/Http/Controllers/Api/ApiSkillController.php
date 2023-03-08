<?php

namespace App\Http\Controllers\Api;

use App\Models\Skill;

class ApiSkillController extends TagBasedController
{
    protected $model = Skill::class;
}
