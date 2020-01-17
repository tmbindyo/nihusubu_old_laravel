<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // Children
    public function payments()
    {
        return $this->hasMany('App\Payment');
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
