<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // Parents
    public function statusType()
    {
        return $this->belongsTo('App\StatusType');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // Children
    public function accounts()
    {
        return $this->hasMany('App\Account');
    }
    public function accountTypes()
    {
        return $this->hasMany('App\AccountType');
    }
    public function address()
    {
        return $this->hasMany('App\Address');
    }
    public function branches()
    {
        return $this->hasMany('App\Branch');
    }
    public function compositeProducts()
    {
        return $this->hasMany('App\CompositeProduct');
    }
    public function compositeProductProducts()
    {
        return $this->hasMany('App\CompositeProductProduct');
    }
    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }
    public function contactTypes()
    {
        return $this->hasMany('App\ContactType');
    }
    public function currencies()
    {
        return $this->hasMany('App\Currency');
    }
    public function departments()
    {
        return $this->hasMany('App\Department');
    }
    public function estimates()
    {
        return $this->hasMany('App\Estimate');
    }
    public function estimateProducts()
    {
        return $this->hasMany('App\EstimateProduct');
    }
    public function expenses()
    {
        return $this->hasMany('App\Expense');
    }
    public function expenseItems()
    {
        return $this->hasMany('App\ExpenseItem');
    }
    public function features()
    {
        return $this->hasMany('App\Feature');
    }
    public function fiscalYears()
    {
        return $this->hasMany('App\FiscalYear');
    }
    public function forums()
    {
        return $this->hasMany('App\Forum');
    }
    public function forumPosts()
    {
        return $this->hasMany('App\ForumPost');
    }
    public function forumPostUploads()
    {
        return $this->hasMany('App\ForumPostUpload');
    }
    public function forumUploads()
    {
        return $this->hasMany('App\ForumUpload');
    }
    public function industries()
    {
        return $this->hasMany('App\Industry');
    }
    public function industryGroups()
    {
        return $this->hasMany('App\IndustryGroup');
    }
    public function institutions()
    {
        return $this->hasMany('App\Institution');
    }
    public function institutionRelationships()
    {
        return $this->hasMany('App\InstitutionRelationship');
    }
    public function institutionServices()
    {
        return $this->hasMany('App\InstitutionService');
    }
    public function institutionSubIndustries()
    {
        return $this->hasMany('App\InstitutionSubIndustry');
    }
    public function inventories()
    {
        return $this->hasMany('App\Inventory');
    }
    public function inventoryAdjustments()
    {
        return $this->hasMany('App\InventoryAdjustment');
    }
    public function inventoryAdjustmentProducts()
    {
        return $this->hasMany('App\InventoryAdjustmentProduct');
    }
    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }
    public function invoiceProducts()
    {
        return $this->hasMany('App\InvoiceProduct');
    }
    public function issues()
    {
        return $this->hasMany('App\Issue');
    }
    public function issueUploads()
    {
        return $this->hasMany('App\IssueUpload');
    }
    public function languages()
    {
        return $this->hasMany('App\Language');
    }
    public function manualJournals()
    {
        return $this->hasMany('App\ManualJournal');
    }
    public function manualJournalAccounts()
    {
        return $this->hasMany('App\ManualJournalAccount');
    }
    public function manufacturers()
    {
        return $this->hasMany('App\Manufacturer');
    }
    public function menus()
    {
        return $this->hasMany('App\Menu');
    }
    public function milestones()
    {
        return $this->hasMany('App\Milestone');
    }
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct');
    }
    public function paymentsMade()
    {
        return $this->hasMany('App\PaymentMade');
    }
    public function paymentsReceived()
    {
        return $this->hasMany('App\PaymentReceived');
    }
    public function paymentTerms()
    {
        return $this->hasMany('App\PaymentTerm');
    }
    public function products()
    {
        return $this->hasMany('App\Product');
    }
    public function productGroups()
    {
        return $this->hasMany('App\ProductGroup');
    }
    public function productGroupImages()
    {
        return $this->hasMany('App\ProductGroupImage');
    }
    public function productImages()
    {
        return $this->hasMany('App\ProductImage');
    }
    public function productReturns()
    {
        return $this->hasMany('App\ProductReturn');
    }
    public function projects()
    {
        return $this->hasMany('App\Project');
    }
    public function projectMembers()
    {
        return $this->hasMany('App\ProjectMember');
    }
    public function projectRoles()
    {
        return $this->hasMany('App\ProjectRole');
    }
    public function purchaseOrders()
    {
        return $this->hasMany('App\PurchaseOrder');
    }
    public function purchaseOrderApprovals()
    {
        return $this->hasMany('App\PurchaseOrderApproval');
    }
    public function purchaseOrderItems()
    {
        return $this->hasMany('App\PurchaseOrderItem');
    }
    public function purchaseOrderSettings()
    {
        return $this->hasMany('App\PurchaseOrderSetting');
    }
    public function reasons()
    {
        return $this->hasMany('App\Reason');
    }
    public function restocks()
    {
        return $this->hasMany('App\Restock');
    }
    public function roles()
    {
        return $this->hasMany('App\Role');
    }
    public function roleUserTypeFeatures()
    {
        return $this->hasMany('App\RoleUserTypeFeature');
    }
    public function roleUserTypeMenus()
    {
        return $this->hasMany('App\RoleUserTypeMenu');
    }
    public function roleUserTypeSections()
    {
        return $this->hasMany('App\RoleUserTypeSection');
    }
    public function sales()
    {
        return $this->hasMany('App\Sale');
    }
    public function saleProducts()
    {
        return $this->hasMany('App\SaleProduct');
    }
    public function sections()
    {
        return $this->hasMany('App\Section');
    }
    public function sectors()
    {
        return $this->hasMany('App\Sector');
    }
    public function services()
    {
        return $this->hasMany('App\Service');
    }
    public function servicePricings()
    {
        return $this->hasMany('App\ServicePricing');
    }
    public function serviceTypes()
    {
        return $this->hasMany('App\ServiceType');
    }
    public function serviceTypePricings()
    {
        return $this->hasMany('App\ServiceTypePricing');
    }
    public function subIndustries()
    {
        return $this->hasMany('App\SubIndustry');
    }
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
    public function taskLists()
    {
        return $this->hasMany('App\TaskList');
    }
    public function taskUploads()
    {
        return $this->hasMany('App\TaskUpload');
    }
    public function taxes()
    {
        return $this->hasMany('App\Tax');
    }
    public function timesheets()
    {
        return $this->hasMany('App\Timesheet');
    }
    public function timezones()
    {
        return $this->hasMany('App\Timezone');
    }
    public function toDos()
    {
        return $this->hasMany('App\ToDo');
    }
    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }
    public function transferOrders()
    {
        return $this->hasMany('App\TransferOrder');
    }
    public function transferOrderProducts()
    {
        return $this->hasMany('App\TransferOrderProduct');
    }
    public function units()
    {
        return $this->hasMany('App\Unit');
    }
    public function uploads()
    {
        return $this->hasMany('App\Upload');
    }
    public function uploadTypes()
    {
        return $this->hasMany('App\UploadType');
    }
    public function userDetail()
    {
        return $this->hasOne('App\UserDetail');
    }
    public function userRoles()
    {
        return $this->hasMany('App\UserRole');
    }
    public function userTypes()
    {
        return $this->hasMany('App\UserType');
    }
    public function userTypeFeatures()
    {
        return $this->hasMany('App\UserTypeFeature');
    }
    public function userTypeMenus()
    {
        return $this->hasMany('App\UserTypeMenu');
    }
    public function userTypeSections()
    {
        return $this->hasMany('App\UserTypeSection');
    }
    public function warehouses()
    {
        return $this->hasMany('App\Warehouse');
    }
}
