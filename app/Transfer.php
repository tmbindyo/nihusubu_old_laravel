<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transfer extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // children
    public function expenses()
    {
        return $this->hasMany('App\Expense');
    }
    public function toDos()
    {
        return $this->hasMany('App\ToDo');
    }

    // Parents
    public function destinationAccount()
    {
        return $this->belongsTo('App\Account', 'destination_account_id', 'id');
    }
    public function sourceAccount()
    {
        return $this->belongsTo('App\Account', 'source_account_id', 'id');
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
