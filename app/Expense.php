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
    public function account()
    {
        return $this->belongsTo('App\Account');
    }
    public function campaign()
    {
        return $this->belongsTo('App\Campaign');
    }
    public function contact()
    {
        return $this->belongsTo('App\Contact');
    }
    public function expense_account()
    {
        return $this->belongsTo('App\ExpenseAccount','expense_account_id','id');
    }
    public function frequency()
    {
        return $this->belongsTo('App\Frequency');
    }
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }
    public function inventory_adjustment()
    {
        return $this->belongsTo('App\InventoryAdjustment');
    }
    public function liability()
    {
        return $this->belongsTo('App\Liability');
    }
    public function purchase_order()
    {
        return $this->belongsTo('App\PurchaseOrder');
    }
    public function sale()
    {
        return $this->belongsTo('App\Sale');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function tax()
    {
        return $this->belongsTo('App\Tax');
    }
    public function transaction()
    {
        return $this->belongsTo('App\Transaction');
    }
    public function transfer()
    {
        return $this->belongsTo('App\Transfer');
    }
    public function transfer_order()
    {
        return $this->belongsTo('App\TransferOrder');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }
    public function warehouse()
    {
        return $this->belongsTo('App\Warehouse');
    }


    // Children
    public function expense_items()
    {
        return $this->hasMany('App\ExpenseItem');
    }
    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }
}
