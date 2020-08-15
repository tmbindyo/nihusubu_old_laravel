<?php

namespace App;

use App\Traits\UuidTrait;
use App\Traits\InstitutionTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
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
        return $this->belongsTo('App\Account', 'inventory_account_id', 'id');
    }
    public function sellingAccount()
    {
        return $this->belongsTo('App\Account', 'selling_account_id', 'id');
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
        return $this->belongsTo('App\Account', 'purchase_account_id', 'id');
    }
    public function preferred_vendor()
    {
        return $this->belongsTo('App\Contact', 'preferred_vendor_id', 'id');
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
    public function taxMethod()
    {
        return $this->belongsTo('App\TaxMethod');
    }
    public function productSubCategory()
    {
        return $this->belongsTo('App\ProductSubCategory');
    }
    public function productGroup()
    {
        return $this->belongsTo('App\ProductGroup');
    }
    public function productGroupProduct()
    {
        return $this->belongsTo('App\Product', 'product_group_id');
    }


    // Children
    public function compositeProductProducts()
    {
        return $this->hasMany('App\CompositeProductProduct', 'composite_product_id');
    }
    public function estimateProducts()
    {
        return $this->hasMany('App\EstimateProduct');
    }
    public function invoiceProducts()
    {
        return $this->hasMany('App\InvoiceProduct');
    }
    public function items()
    {
        return $this->hasMany('App\Item');
    }
    public function inventoryAdjustmentProducts()
    {
        return $this->hasMany('App\InventoryAdjustmentProduct');
    }
    public function inventory()
    {
        return $this->hasMany('App\Inventory');
    }
    public function itemProducts()
    {
        return $this->hasMany('App\ItemProduct', 'item_id');
    }
    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct');
    }
    public function productGroupProducts()
    {
        return $this->hasMany('App\Product', 'product_group_id');
    }
    public function product_discounts()
    {
        return $this->hasMany('App\ProductDiscount');
    }
    public function productImages()
    {
        return $this->hasMany('App\ProductImage');
    }
    public function productReturns()
    {
        return $this->hasMany('App\ProductReturn');
    }
    public function productGroupProductMin()
    {
        return $this->productGroupProducts()->orderBy('selling_price', 'desc')->take(1);
    }
    public function productGroupProductMax()
    {
        return $this->productGroupProducts()->orderBy('selling_price', 'asc')->take(1);
    }
    public function productTaxes()
    {
        return $this->hasMany('App\ProductTax');
    }
    public function productItems()
    {
        return $this->hasMany('App\ProductItem');
    }
    public function restock()
    {
        return $this->hasMany('App\Restock');
    }
    public function saleProducts()
    {
        return $this->hasMany('App\SaleProduct');
    }
    public function stock_on_hand()
    {
        return $this->hasMany('App\Inventory')
            ->selectRaw('product_id,SUM(quantity) as stock_on_hand')
            ->groupBy('product_id');
    }
    public function transferOrderProducts()
    {
        return $this->hasMany('App\TransferOrderProduct');
    }
}
