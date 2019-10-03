<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
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
    public function purchase_order()
    {
        return $this->belongsTo('App\PurchaseOrder');
    }
    public function project()
    {
        return $this->belongsTo('App\Project');
    }
    public function expense_account()
    {
        return $this->belongsTo('App\ExpenseAccount','expense_account_id','id');
    }
    public function expense_type()
    {
        return $this->belongsTo('App\ExpenseType');
    }
    public function currency()
    {
        return $this->belongsTo('App\Currency');
    }
    public function tax()
    {
        return $this->belongsTo('App\Tax');
    }
    public function account()
    {
        return $this->belongsTo('App\Account');
    }
    public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }
    public function customer()
    {
        return $this->belongsTo('App\Contact','customer_id','id');
    }
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }


    // Children
    public function expense_items()
    {
        return $this->hasMany('App\ExpenseItem');
    }
    public function payment_mades()
    {
        return $this->hasMany('App\PaymentMade');
    }
}
