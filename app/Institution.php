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
    public function address()
    {
        return $this->belongsTo('App\Address');
    }
    public function currency()
    {
        return $this->belongsTo('App\Currency');
    }
    public function fiscal_year()
    {
        return $this->belongsTo('App\FiscalYear');
    }
    public function language()
    {
        return $this->belongsTo('App\Language');
    }
    public function logo()
    {
        return $this->belongsTo('App\Upload','logo_id');
    }
    public function plan()
    {
        return $this->belongsTo('App\Plan');
    }
    public function primary_contact()
    {
        return $this->belongsTo('App\PrimaryContact','primary_contact_id','id');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function timezone()
    {
        return $this->belongsTo('App\Timezone');
    }

    // Children

    public function accounts()
    {
        return $this->hasMany('App\Account');
    }
    public function brands()
    {
        return $this->hasMany('App\Brand');
    }
    public function branches()
    {
        return $this->hasMany('App\Branch');
    }
    public function budgets()
    {
        return $this->hasMany('App\Budget');
    }
    public function composite_products()
    {
        return $this->hasMany('App\CompositeProduct');
    }
    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }
    public function estimates()
    {
        return $this->hasMany('App\Estimate');
    }
    public function expenses()
    {
        return $this->hasMany('App\Expense');
    }
    public function institution_sub_industries()
    {
        return $this->hasMany('App\InstitutionSubIndustry');
    }
    public function institution_services()
    {
        return $this->hasMany('App\InstitutionService');
    }
    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }
    public function manufacturers()
    {
        return $this->hasMany('App\Manufacturer');
    }
    public function roles()
    {
        return $this->hasMany('App\Role');
    }
    public function sales()
    {
        return $this->hasMany('App\Sale');
    }
    public function units()
    {
        return $this->hasMany('App\Unit');
    }
    public function user_accounts()
    {
        return $this->hasMany('App\UserAccount');
    }
    public function uploads()
    {
        return $this->hasMany('App\Upload');
    }
    public function taxes()
    {
        return $this->hasMany('App\Tax');
    }
    public function to_dos()
    {
        return $this->hasMany('App\ToDo');
    }
    public function product_groups()
    {
        return $this->hasMany('App\ProductGroup');
    }
    public function manual_journals()
    {
        return $this->hasMany('App\ManualJournal');
    }
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
    public function payment_terms()
    {
        return $this->hasMany('App\PaymentTerm');
    }
    public function payment_receiveds()
    {
        return $this->hasMany('App\PaymentReceived');
    }
    public function purchase_orders()
    {
        return $this->hasMany('App\PurchaseOrder');
    }
    public function projects()
    {
        return $this->hasMany('App\Project');
    }
    public function project_roles()
    {
        return $this->hasMany('App\ProjectRole');
    }
    public function purchase_order_settings()
    {
        return $this->hasMany('App\PurchaseOrderSetting');
    }
    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function reasons()
    {
        return $this->hasMany('App\Reason');
    }

    public function transfer_orders()
    {
        return $this->hasMany('App\TransferOrder');
    }
    public function warehouses()
    {
        return $this->hasMany('App\Warehouse');
    }

}
