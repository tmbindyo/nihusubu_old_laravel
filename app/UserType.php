<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserType extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
