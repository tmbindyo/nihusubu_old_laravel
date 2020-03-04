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
    public function inventory_account()
    {
        return $this->belongsTo('App\Account','inventory_account_id','id');
    }
    public function selling_account()
    {
        return $this->belongsTo('App\Account','selling_account_id','id');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function to_dos()
    {
        return $this->hasMany('App\ToDo');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function purchase_account()
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
    public function product_group()
    {
        return $this->belongsTo('App\ProductGroup');
    }

    // Children
    public function transfer_order_products()
    {
        return $this->hasMany('App\TransferOrderProduct');
    }
    public function inventory_adjustment_products()
    {
        return $this->hasMany('App\InventoryAdjustmentProduct');
    }
    public function inventory()
    {
        return $this->hasMany('App\Inventory');
    }
    public function product_images()
    {
        return $this->hasMany('App\ProductImage');
    }
    public function sale_products()
    {
        return $this->hasMany('App\SaleProduct');
    }
    public function composite_product_products()
    {
        return $this->hasMany('App\CompositeProductProduct','composite_product_id');
    }
    public function product_returns()
    {
        return $this->hasMany('App\ProductReturn');
    }
    public function restock()
    {
        return $this->hasMany('App\Restock');
    }
    public function estimate_products()
    {
        return $this->hasMany('App\EstimateProduct');
    }
    public function invoice_products()
    {
        return $this->hasMany('App\InvoiceProduct');
    }
    public function order_products()
    {
        return $this->hasMany('App\OrderProduct');
    }
    public function product_taxes()
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
