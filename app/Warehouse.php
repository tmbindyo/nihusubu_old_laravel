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
    public function address()
    {
        return $this->belongsTo('App\Address');
    }
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function toDos()
    {
        return $this->hasMany('App\ToDo');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // Children
    public function transferOrderSourceWarehouses()
    {
        return $this->hasMany('App\Warehouse','source_warehouse_id','id');
    }
    public function transferOrderDestinationWarehouses()
    {
        return $this->hasMany('App\Warehouse','destination_warehouse_id','id');
    }
    public function estimateProducts()
    {
        return $this->hasMany('App\EstimateProduct');
    }
    public function inventoryAdjustments()
    {
        return $this->hasMany('App\InventoryAdjustment');
    }
    public function productReturns()
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
    public function saleProducts()
    {
        return $this->hasMany('App\SaleProduct');
    }
    public function invoiceProducts()
    {
        return $this->hasMany('App\InvoiceProduct');
    }
    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct');
    }

}
