<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusType extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // Parents
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //Children
    public function statuses()
    {
        return $this->hasMany('App\Status');
    }
}
