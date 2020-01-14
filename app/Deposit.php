<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deposit extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // children
    public function account_adjustments()
    {
        return $this->hasMany('App\AccountAdjustment');
    }

    // parents
    public function account()
    {
        return $this->belongsTo('App\Account');
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
