<?php

namespace App;

use App\Traits\InstitutionTrait;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use institutionTrait;
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // Parents
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }
    public function inventoryAccount()
    {
        return $this->belongsTo('App\Account','inventory_account_id','id');
    }
    public function sellingAccount()
    {
        return $this->belongsTo('App\Account','selling_account_id','id');
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
    public function purchaseAccount()
    {
        return $this->belongsTo('App\Account','purchase_account_id','id');
    }
    public function preferred_vendor()
    {
        return $this->belongsTo('App\Contact','preferred_vendor_id','id');
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
    public function productGroup()
    {
        return $this->belongsTo('App\ProductGroup');
    }

    // Children
    public function transferOrderProducts()
    {
        return $this->hasMany('App\TransferOrderProduct');
    }
    public function inventoryAdjustmentProducts()
    {
        return $this->hasMany('App\InventoryAdjustmentProduct');
    }
    public function inventory()
    {
        return $this->hasMany('App\Inventory');
    }
    public function productImages()
    {
        return $this->hasMany('App\ProductImage');
    }
    public function saleProducts()
    {
        return $this->hasMany('App\SaleProduct');
    }
    public function compositeProductProducts()
    {
        return $this->hasMany('App\CompositeProductProduct','composite_product_id');
    }
    public function productReturns()
    {
        return $this->hasMany('App\ProductReturn');
    }
    public function restock()
    {
        return $this->hasMany('App\Restock');
    }
    public function estimateProducts()
    {
        return $this->hasMany('App\EstimateProduct');
    }
    public function invoiceProducts()
    {
        return $this->hasMany('App\InvoiceProduct');
    }
    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct');
    }
    public function productTaxes()
    {
        return $this->hasMany('App\ProductTax');
    }
    public function product_discounts()
    {
        return $this->hasMany('App\ProductDiscount');
    }
    public function stock_on_hand()
    {
        return $this->hasMany('App\Inventory')
            ->selectRaw('product_id,SUM(quantity) as stock_on_hand')
            ->groupBy('product_id');
    }
}
