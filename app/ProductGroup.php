<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductGroup extends Model
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
    public function composite_products()
    {
        return $this->hasMany('App\CompositeProduct');
    }
    public function products()
    {
        return $this->hasMany('App\Product');
    }
    public function product_group_images()
    {
        return $this->hasMany('App\ProductGroupImage');
    }
    public function product_group_taxes()
    {
        return $this->hasMany('App\ProductGroupTax');
    }
    public function to_dos()
    {
        return $this->hasMany('App\ToDo');
    }

}
