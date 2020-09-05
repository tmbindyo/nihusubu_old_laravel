<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Institution extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // Parents
    public function address()
    {
        return $this->belongsTo('App\Address');
    }
    public function commerceTemplate()
    {
        return $this->belongsTo('App\CommerceTemplate');
    }
    public function currency()
    {
        return $this->belongsTo('App\Currency');
    }
    public function fiscalYear()
    {
        return $this->belongsTo('App\FiscalYear');
    }
    public function language()
    {
        return $this->belongsTo('App\Language');
    }
    public function logo()
    {
        return $this->belongsTo('App\Upload', 'logo_id');
    }
    public function plan()
    {
        return $this->belongsTo('App\Plan');
    }
    public function primaryContact()
    {
        return $this->belongsTo('App\PrimaryContact', 'primary_contact_id', 'id');
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
    public function campaigns()
    {
        return $this->hasMany('App\Campaign');
    }
    public function compositeProducts()
    {
        return $this->hasMany('App\Product')->where('is_composite_product', true);
    }
    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }
    public function estimates()
    {
        return $this->hasMany('App\Sale')->where('is_estimate', true);
    }
    public function expenses()
    {
        return $this->hasMany('App\Expense');
    }
    public function institutionModules()
    {
        return $this->hasMany('App\InstitutionModule');
    }
    public function institutionModuleNames()
    {
        return $this->hasMany('App\InstitutionModule')->with('module');
    }
    public function institutionSubIndustries()
    {
        return $this->hasMany('App\InstitutionSubIndustry');
    }
    public function institutionServices()
    {
        return $this->hasMany('App\InstitutionService');
    }
    public function invoices()
    {
        return $this->hasMany('App\Sale')->where('is_invoice', true);
    }
    public function inventoryAdjustments()
    {
        return $this->hasMany('App\InventoryAdjustment');
    }
    public function items()
    {
        return $this->hasMany('App\Product')->where('is_item', true);
    }
    public function loans()
    {
        return $this->hasMany('App\Loan');
    }
    public function manufacturers()
    {
        return $this->hasMany('App\Manufacturer');
    }
    public function payments()
    {
        return $this->hasMany('App\Payment');
    }
    public function refunds()
    {
        return $this->hasMany('App\Refund');
    }
    public function roles()
    {
        return $this->hasMany('App\Role');
    }
    public function sales()
    {
        return $this->hasMany('App\Sale')->where('is_sale', true);
    }
    public function subscriptions()
    {
        return $this->hasMany('App\Subscription');
    }
    public function transfers()
    {
        return $this->hasMany('App\Transfer');
    }
    public function units()
    {
        return $this->hasMany('App\Unit');
    }
    public function userAccounts()
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
    public function toDos()
    {
        return $this->hasMany('App\ToDo');
    }
    public function productGroups()
    {
        return $this->hasMany('App\Product')->where('is_product_group', True)->where('is_product_group_child', False);
    }
    public function manualJournals()
    {
        return $this->hasMany('App\ManualJournal');
    }
    public function orders()
    {
        return $this->hasMany('App\Sale')->where('is_order', true);
    }
    public function organizations()
    {
        return $this->hasMany('App\organization');
    }
    public function paymentTerms()
    {
        return $this->hasMany('App\PaymentTerm');
    }
    public function payment_receiveds()
    {
        return $this->hasMany('App\PaymentReceived');
    }
    public function purchaseOrders()
    {
        return $this->hasMany('App\PurchaseOrder');
    }
    public function projects()
    {
        return $this->hasMany('App\Project');
    }
    public function projectRoles()
    {
        return $this->hasMany('App\ProjectRole');
    }
    public function purchaseOrderSettings()
    {
        return $this->hasMany('App\PurchaseOrderSetting');
    }
    public function products()
    {
        return $this->hasMany('App\Product')->where('is_product_group', false)->where('is_item', false)->where('is_product_group_child', false)->where('is_composite_product', false);
    }
    public function reasons()
    {
        return $this->hasMany('App\Reason');
    }
    public function transferOrders()
    {
        return $this->hasMany('App\TransferOrder');
    }
    public function warehouses()
    {
        return $this->hasMany('App\Warehouse');
    }

}
