<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
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
    public function to_dos()
    {
        return $this->hasMany('App\ToDo');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // Children
    public function sale_products()
    {
        return $this->hasMany('App\SaleProduct');
    }
    public function payments_received()
    {
        return $this->hasMany('App\PaymentReceived');
    }
    public function product_returns()
    {
        return $this->hasMany('App\ProductReturn');
    }
}
