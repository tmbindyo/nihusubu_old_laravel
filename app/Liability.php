<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Liability extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // Children
    public function expenses()
    {
        return $this->hasMany('App\Expense');
    }
    public function toDos()
    {
        return $this->hasMany('App\ToDo');
    }

    // Parents
    public function account()
    {
        return $this->belongsTo('App\Account');
    }
    public function contact()
    {
        return $this->belongsTo('App\Contact');
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
