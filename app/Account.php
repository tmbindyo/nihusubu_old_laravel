<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
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

    // Children
    public function account_adjustments()
    {
        return $this->hasMany('App\AccountAdjustment');
    }
    public function deposits()
    {
        return $this->hasMany('App\Deposit');
    }
    public function destination_account()
    {
        return $this->hasMany('App\Transfer','destination_account_id','id');
    }
    public function liabilities()
    {
        return $this->hasMany('App\Liability');
    }
    public function loans()
    {
        return $this->hasMany('App\Loan');
    }
    public function payments()
    {
        return $this->hasMany('App\Payment');
    }
    public function refunds()
    {
        return $this->hasMany('App\Refund');
    }
    public function source_account()
    {
        return $this->hasMany('App\Transfer','source_account_id','id');
    }
    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }
    public function withdrawals()
    {
        return $this->hasMany('App\Withdrawal');
    }
}
