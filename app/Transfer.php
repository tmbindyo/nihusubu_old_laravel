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

    // Parents
    public function destination_account()
    {
        return $this->belongsTo('App\Account','destination_account_id','id');
    }
    public function source_account()
    {
        return $this->belongsTo('App\Account','source_account_id','id');
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
