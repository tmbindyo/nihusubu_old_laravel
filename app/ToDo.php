<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ToDo extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // Parents
    public function account()
    {
        return $this->belongsTo('App\Account');
    }
    public function account_adjustment()
    {
        return $this->belongsTo('App\AccountAdjustment');
    }
    public function assignee()
    {
        return $this->belongsTo('App\User','assignee_id', 'id');
    }
    public function campaign()
    {
        return $this->belongsTo('App\Campaign');
    }
    public function contact()
    {
        return $this->belongsTo('App\Contact');
    }
    public function deposit()
    {
        return $this->belongsTo('App\Deposit');
    }
    public function expense()
    {
        return $this->belongsTo('App\Expense');
    }
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }
    public function liability()
    {
        return $this->belongsTo('App\Liability');
    }
    public function loan()
    {
        return $this->belongsTo('App\Loan');
    }
    public function organization()
    {
        return $this->belongsTo('App\Organization');
    }
    public function payment()
    {
        return $this->belongsTo('App\Payment');
    }
    public function product_group()
    {
        return $this->belongsTo('App\ProductGroup');
    }
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    public function refund()
    {
        return $this->belongsTo('App\Refund');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function transaction()
    {
        return $this->belongsTo('App\Transaction');
    }
    public function transfer()
    {
        return $this->belongsTo('App\Transfer');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function warehouse()
    {
        return $this->belongsTo('App\Warehouse');
    }
    public function withdrawal()
    {
        return $this->belongsTo('App\Withdrawal');
    }
    public function sale()
    {
        return $this->belongsTo('App\Sale');
    }


    // Children
}
