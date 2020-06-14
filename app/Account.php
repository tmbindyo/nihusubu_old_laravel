<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
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
    public function accountAdjustments()
    {
        return $this->hasMany('App\AccountAdjustment');
    }
    public function deposits()
    {
        return $this->hasMany('App\Deposit');
    }
    public function destinationAccount()
    {
        return $this->hasMany('App\Transfer','destination_account_id','id');
    }
    public function incomes()
    {
        return $this->hasMany('App\Income');
    }
    public function incomeDebits()
    {
        return $this->hasMany('App\IncomeDebit');
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
    public function sourceAccount()
    {
        return $this->hasMany('App\Transfer','source_account_id','id');
    }
    public function toDos()
    {
        return $this->hasMany('App\ToDo');
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
