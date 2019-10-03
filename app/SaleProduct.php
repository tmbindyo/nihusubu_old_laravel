<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleProduct extends Model
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
    public function sale()
    {
        return $this->belongsTo('App\Sale');
    }
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    public function warehouse()
    {
        return $this->belongsTo('App\Warehouse');
    }
}
