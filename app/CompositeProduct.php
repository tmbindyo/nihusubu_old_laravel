<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompositeProduct extends Model
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
    public function selling_account()
    {
        return $this->belongsTo('App\Account','selling_account_id');
    }
    public function purchase_account()
    {
        return $this->belongsTo('App\Account','purchase_account_id');
    }
    public function inventory_account()
    {
        return $this->belongsTo('App\Account','inventory_account_id');
    }
    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }
    public function manufacturer()
    {
        return $this->belongsTo('App\Manufacturer');
    }
    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }
    public function tax()
    {
        return $this->belongsTo('App\Tax');
    }
    public function product_group()
    {
        return $this->belongsTo('App\ProductGroup');
    }

    // Children
    public function composite_product_products()
    {
        return $this->belongsTo('App\CompositeProductProduct');
    }
}
