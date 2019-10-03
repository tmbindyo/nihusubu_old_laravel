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
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function source_account()
    {
        return $this->belongsTo('App\Account','source_account_id','id');
    }
    public function destination_account()
    {
        return $this->belongsTo('App\Account','destination_account_id','id');
    }
}
