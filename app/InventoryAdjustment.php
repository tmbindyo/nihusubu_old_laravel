<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryAdjustment extends Model implements Auditable
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
    public function account()
    {
        return $this->belongsTo('App\Account');
    }
    public function warehouse()
    {
        return $this->belongsTo('App\Warehouse');
    }
    public function reason()
    {
        return $this->belongsTo('App\Reason');
    }

    // Children
    public function inventoryAdjustmentProducts()
    {
        return $this->hasMany('App\InventoryAdjustmentProduct');
    }
}
