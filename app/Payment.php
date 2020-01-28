<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // Children
    public function refunds()
    {
        return $this->hasMany('App\Refund');
    }
    public function to_dos()
    {
        return $this->hasMany('App\ToDo');
    }

    // Parents
    public function account()
    {
        return $this->belongsTo('App\Account');
    }
    public function loan()
    {
        return $this->belongsTo('App\Loan');
    }
    public function sale()
    {
        return $this->belongsTo('App\Sale');
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
