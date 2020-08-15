<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Item extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // Parents
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    // children
    public function inventory()
    {
        return $this->hasMany('App\Inventory');
    }
    public function inventoryAdjustmentItems()
    {
        return $this->hasMany('App\InventoryAdjustmentProduct');
    }
    public function restock()
    {
        return $this->hasMany('App\Restock');
    }
    public function stock_on_hand()
    {
        return $this->hasMany('App\Inventory')
            ->selectRaw('item_id,SUM(quantity) as stock_on_hand')
            ->groupBy('item_id');
    }

}
