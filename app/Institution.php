<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Institution extends Model
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

    // Children
    public function roles()
    {
        return $this->hasMany('App\Role');
    }
    public function manufacturers()
    {
        return $this->hasMany('App\Manufacturer');
    }
    public function units()
    {
        return $this->hasMany('App\Unit');
    }
    public function brands()
    {
        return $this->hasMany('App\Brand');
    }
    public function institution_sub_industries()
    {
        return $this->hasMany('App\InstitutionSubIndustry');
    }
    public function branches()
    {
        return $this->hasMany('App\Branch');
    }
    public function warehouses()
    {
        return $this->hasMany('App\Warehouse');
    }
    public function institution_services()
    {
        return $this->hasMany('App\InstitutionService');
    }
    public function uploads()
    {
        return $this->hasMany('App\Upload');
    }
    public function estimates()
    {
        return $this->hasMany('App\Estimate');
    }
    public function to_dos()
    {
        return $this->hasMany('App\ToDo');
    }
    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }
    public function sales()
    {
        return $this->hasMany('App\Sale');
    }
    public function product_groups()
    {
        return $this->hasMany('App\ProductGroup');
    }
    public function taxes()
    {
        return $this->hasMany('App\Tax');
    }
    public function expenses()
    {
        return $this->hasMany('App\Expense');
    }
    public function manual_journals()
    {
        return $this->hasMany('App\ManualJournal');
    }
    public function purchase_orders()
    {
        return $this->hasMany('App\PurchaseOrder');
    }
    public function accounts()
    {
        return $this->hasMany('App\Account');
    }
    public function projects()
    {
        return $this->hasMany('App\Project');
    }
    public function project_roles()
    {
        return $this->hasMany('App\ProjectRole');
    }
    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }
    public function purchase_order_settings()
    {
        return $this->hasMany('App\PurchaseOrderSetting');
    }
    public function products()
    {
        return $this->hasMany('App\Product');
    }
    public function composite_products()
    {
        return $this->hasMany('App\CompositeProduct');
    }
    public function payment_terms()
    {
        return $this->hasMany('App\PaymentTerm');
    }
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
    // institution relationship
}
