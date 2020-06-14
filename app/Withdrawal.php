<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Withdrawal extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // children
    public function accountAdjustments()
    {
        return $this->hasMany('App\AccountAdjustment');
    }
    public function toDos()
    {
        return $this->hasMany('App\ToDo');
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
