<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
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
    public function transfer_order_source_warehouses()
    {
        return $this->hasMany('App\Warehouse','source_warehouse_id','id');
    }
    public function transfer_order_destination_warehouses()
    {
        return $this->hasMany('App\Warehouse','destination_warehouse_id','id');
    }
    public function estimate_products()
    {
        return $this->hasMany('App\EstimateProduct');
    }
    public function inventory_adjustments()
    {
        return $this->hasMany('App\InventoryAdjustment');
    }
    public function product_returns()
    {
        return $this->hasMany('App\ProductReturn');
    }
    public function inventories()
    {
        return $this->hasMany('App\Inventory');
    }
    public function restocks()
    {
        return $this->hasMany('App\Restock');
    }
    public function sale_products()
    {
        return $this->hasMany('App\SaleProduct');
    }
    public function invoice_products()
    {
        return $this->hasMany('App\InvoiceProduct');
    }
    public function order_products()
    {
        return $this->hasMany('App\OrderProduct');
    }
}
