<?php

# dipakai oleh Model
trait UserScope
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new UserScopeStatus);
    }
}

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class UserScopeStatus implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        // query will result
        # select * from `user` where `user`.`deleted_at` is null and `status` = ?
        // $builder->whereStatus('enable');

        // query will result
        # select * from `user` where `user`.`deleted_at` is null and status = "enable"
        // $builder->whereRaw('user_id = 1'); # memberikan default value pada query
    }
}
