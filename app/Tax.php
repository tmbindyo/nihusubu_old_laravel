<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tax extends Model implements Auditable
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
    public function productTaxes()
    {
        return $this->hasMany('App\ProductTax');
    }
    public function compositeProductTaxes()
    {
        return $this->hasMany('App\CompositeProductTax');
    }
}
