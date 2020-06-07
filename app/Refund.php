<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Refund extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // parents
    public function account()
    {
        return $this->belongsTo('App\Account');
    }
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }
    public function payment()
    {
        return $this->belongsTo('App\Payment');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // children
    public function toDos()
    {
        return $this->hasMany('App\ToDo');
    }
}
