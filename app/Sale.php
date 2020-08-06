<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // Parents
    public function contact()
    {
        return $this->belongsTo('App\Contact');
    }
    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }
    public function project()
    {
        return $this->belongsTo('App\Project');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function toDos()
    {
        return $this->hasMany('App\ToDo');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // Children
    public function saleProducts()
    {
        return $this->hasMany('App\SaleProduct');
    }
    public function saleEmails()
    {
        return $this->hasMany('App\SaleEmail');
    }
    public function paymentsReceived()
    {
        return $this->hasMany('App\PaymentReceived');
    }
    public function productReturns()
    {
        return $this->hasMany('App\ProductReturn');
    }
}
