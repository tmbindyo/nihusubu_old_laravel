<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // Parents
    public function account()
    {
        return $this->belongsTo('App\Account');
    }
    public function expense()
    {
        return $this->belongsTo('App\Expense');
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
