<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductGroup extends Model implements Auditable
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
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }

    // Children
    public function compositeProducts()
    {
        return $this->hasMany('App\CompositeProduct');
    }
    public function products()
    {
        return $this->hasMany('App\Product');
    }
    public function productGroupImages()
    {
        return $this->hasMany('App\ProductGroupImage');
    }
    public function productGroupTaxes()
    {
        return $this->hasMany('App\ProductGroupTax');
    }
    public function toDos()
    {
        return $this->hasMany('App\ToDo');
    }

}
