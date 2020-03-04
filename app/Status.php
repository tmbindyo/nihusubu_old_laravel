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
    public function status_type()
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
    public function account_types()
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
    public function composite_products()
    {
        return $this->hasMany('App\CompositeProduct');
    }
    public function composite_product_products()
    {
        return $this->hasMany('App\CompositeProductProduct');
    }
    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }
    public function contact_types()
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
    public function estimate_products()
    {
        return $this->hasMany('App\EstimateProduct');
    }
    public function expenses()
    {
        return $this->hasMany('App\Expense');
    }
    public function expense_items()
    {
        return $this->hasMany('App\ExpenseItem');
    }
    public function features()
    {
        return $this->hasMany('App\Feature');
    }
    public function fiscal_years()
    {
        return $this->hasMany('App\FiscalYear');
    }
    public function forums()
    {
        return $this->hasMany('App\Forum');
    }
    public function forum_posts()
    {
        return $this->hasMany('App\ForumPost');
    }
    public function forum_post_uploads()
    {
        return $this->hasMany('App\ForumPostUpload');
    }
    public function forum_uploads()
    {
        return $this->hasMany('App\ForumUpload');
    }
    public function industries()
    {
        return $this->hasMany('App\Industry');
    }
    public function industry_groups()
    {
        return $this->hasMany('App\IndustryGroup');
    }
    public function institutions()
    {
        return $this->hasMany('App\Institution');
    }
    public function institution_relationships()
    {
        return $this->hasMany('App\InstitutionRelationship');
    }
    public function institution_services()
    {
        return $this->hasMany('App\InstitutionService');
    }
    public function institution_sub_industries()
    {
        return $this->hasMany('App\InstitutionSubIndustry');
    }
    public function inventories()
    {
        return $this->hasMany('App\Inventory');
    }
    public function inventory_adjustments()
    {
        return $this->hasMany('App\InventoryAdjustment');
    }
    public function inventory_adjustment_products()
    {
        return $this->hasMany('App\InventoryAdjustmentProduct');
    }
    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }
    public function invoice_products()
    {
        return $this->hasMany('App\InvoiceProduct');
    }
    public function issues()
    {
        return $this->hasMany('App\Issue');
    }
    public function issue_uploads()
    {
        return $this->hasMany('App\IssueUpload');
    }
    public function languages()
    {
        return $this->hasMany('App\Language');
    }
    public function manual_journals()
    {
        return $this->hasMany('App\ManualJournal');
    }
    public function manual_journal_accounts()
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
    public function order_products()
    {
        return $this->hasMany('App\OrderProduct');
    }
    public function payments_made()
    {
        return $this->hasMany('App\PaymentMade');
    }
    public function payments_received()
    {
        return $this->hasMany('App\PaymentReceived');
    }
    public function payment_terms()
    {
        return $this->hasMany('App\PaymentTerm');
    }
    public function products()
    {
        return $this->hasMany('App\Product');
    }
    public function product_groups()
    {
        return $this->hasMany('App\ProductGroup');
    }
    public function product_group_images()
    {
        return $this->hasMany('App\ProductGroupImage');
    }
    public function product_images()
    {
        return $this->hasMany('App\ProductImage');
    }
    public function product_returns()
    {
        return $this->hasMany('App\ProductReturn');
    }
    public function projects()
    {
        return $this->hasMany('App\Project');
    }
    public function project_members()
    {
        return $this->hasMany('App\ProjectMember');
    }
    public function project_roles()
    {
        return $this->hasMany('App\ProjectRole');
    }
    public function purchase_orders()
    {
        return $this->hasMany('App\PurchaseOrder');
    }
    public function purchase_order_approvals()
    {
        return $this->hasMany('App\PurchaseOrderApproval');
    }
    public function purchase_order_items()
    {
        return $this->hasMany('App\PurchaseOrderItem');
    }
    public function purchase_order_settings()
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
    public function role_user_type_features()
    {
        return $this->hasMany('App\RoleUserTypeFeature');
    }
    public function role_user_type_menus()
    {
        return $this->hasMany('App\RoleUserTypeMenu');
    }
    public function role_user_type_sections()
    {
        return $this->hasMany('App\RoleUserTypeSection');
    }
    public function sales()
    {
        return $this->hasMany('App\Sale');
    }
    public function sale_products()
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
    public function service_pricings()
    {
        return $this->hasMany('App\ServicePricing');
    }
    public function service_types()
    {
        return $this->hasMany('App\ServiceType');
    }
    public function service_type_pricings()
    {
        return $this->hasMany('App\ServiceTypePricing');
    }
    public function sub_industries()
    {
        return $this->hasMany('App\SubIndustry');
    }
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
    public function task_lists()
    {
        return $this->hasMany('App\TaskList');
    }
    public function task_uploads()
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
    public function to_dos()
    {
        return $this->hasMany('App\ToDo');
    }
    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }
    public function transfer_orders()
    {
        return $this->hasMany('App\TransferOrder');
    }
    public function transfer_order_products()
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
    public function upload_types()
    {
        return $this->hasMany('App\UploadType');
    }
    public function user_detail()
    {
        return $this->hasOne('App\UserDetail');
    }
    public function user_roles()
    {
        return $this->hasMany('App\UserRole');
    }
    public function user_types()
    {
        return $this->hasMany('App\UserType');
    }
    public function user_type_features()
    {
        return $this->hasMany('App\UserTypeFeature');
    }
    public function user_type_menus()
    {
        return $this->hasMany('App\UserTypeMenu');
    }
    public function user_type_sections()
    {
        return $this->hasMany('App\UserTypeSection');
    }
    public function warehouses()
    {
        return $this->hasMany('App\Warehouse');
    }
}
