<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tax extends Model
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
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }

    // Children
    public function expenses()
    {
        return $this->hasMany('App\Expense');
    }
    public function products()
    {
        return $this->hasMany('App\Product');
    }
    public function composite_products()
    {
        return $this->hasMany('App\CompositeProduct');
    }
    public function purchase_orders()
    {
        return $this->hasMany('App\PurchaseOrder');
    }
}
