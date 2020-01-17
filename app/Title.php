<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Title extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // children
    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }

    // parents
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
