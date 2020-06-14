<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ToDo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // Parents
    public function account()
    {
        return $this->belongsTo('App\Account');
    }
    public function accountAdjustment()
    {
        return $this->belongsTo('App\AccountAdjustment');
    }
    public function assignee()
    {
        return $this->belongsTo('App\User', 'assignee_id', 'id');
    }
    public function budget()
    {
        return $this->belongsTo('App\Budget');
    }
    public function campaign()
    {
        return $this->belongsTo('App\Campaign');
    }
    public function chamaMeeting()
    {
        return $this->belongsTo('App\ChamaMeeting');
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
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    public function productGroup()
    {
        return $this->belongsTo('App\ProductGroup');
    }
    public function refund()
    {
        return $this->belongsTo('App\Refund');
    }
    public function sale()
    {
        return $this->belongsTo('App\Sale');
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



    // Children
}
