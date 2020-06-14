<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model implements Auditable
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
    public function institutions()
    {
        return $this->hasMany('App\Institution');
    }
    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }
    public function expenses()
    {
        return $this->hasMany('App\Expense');
    }
    public function manualJournals()
    {
        return $this->hasMany('App\ManualJournal');
    }
    public function purchaseOrders()
    {
        return $this->hasMany('App\PurchaseOrder');
    }
}
