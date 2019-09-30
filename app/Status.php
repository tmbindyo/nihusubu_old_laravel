<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // Parents
    public function status_type()
    {
        return $this->belongsTo('App\StatusType');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
