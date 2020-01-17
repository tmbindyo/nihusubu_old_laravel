<?php


Route::group(array('domain' => '{subdomain}.localhost:8000'), function () {


});


//Dashboard
Route::get('/dashboard', 'Business\DashboardController@dashboard')->name('business.dashboard');

//Calendar
Route::get('/calendar', 'Business\CalendarController@calendar')->name('business.calendar');
Route::post('/calendar/store', 'Business\CalendarController@calendarStore')->name('business.calendar.store');

Route::get('/to/dos', 'Business\ToDoController@toDos')->name('business.to.dos');
Route::post('/to/do/store', 'Business\ToDoController@toDoStore')->name('business.to.do.store');
Route::post('/to/do/update/{todo_id}', 'Business\ToDoController@toDoUpdate')->name('business.to.do.update');
Route::get('/to/do/set/in/progress/{todo_id}', 'Business\ToDoController@toDoSetInProgress')->name('business.to.do.set.in.progress');
Route::get('/to/do/set/completed/{todo_id}', 'Business\ToDoController@toDoSetCompleted')->name('business.to.do.set.completed');
Route::get('/to/do/delete/{todo_id}', 'Business\ToDoController@toDoDelete')->name('business.to.do.delete');


/// CRM
// Campaign
Route::get('/campaigns', 'Business\CRMController@campaigns')->name('business.campaigns');
Route::get('/campaign/create', 'Business\CRMController@campaignCreate')->name('business.campaign.create');
Route::post('/campaign/store', 'Business\CRMController@campaignStore')->name('business.campaign.store');
Route::get('/campaign/show/{campaign_id}', 'Business\CRMController@campaignShow')->name('business.campaign.show');

Route::get('/campaign/contact/create/{campaign_id}', 'Business\CRMController@campaignContactCreate')->name('business.campaign.contact.create');
Route::get('/campaign/deal/create/{campaign_id}', 'Business\CRMController@campaignDealCreate')->name('business.campaign.deal.create');
Route::get('/campaign/expense/create/{campaign_id}', 'Business\CRMController@campaignExpenseCreate')->name('business.campaign.expense.create');
Route::get('/campaign/organization/create/{campaign_id}', 'Business\CRMController@campaignOrganizationCreate')->name('business.campaign.organization.create');

Route::post('/campaign/update/{campaign_id}', 'Business\CRMController@campaignUpdate')->name('business.campaign.update');
Route::get('/campaign/delete/{campaign_id}', 'Business\CRMController@campaignDelete')->name('business.campaign.delete');
Route::get('/campaign/restore/{campaign_id}', 'Business\CRMController@campaignRestore')->name('business.campaign.restore');

// Campaign uploads
Route::get('/campaign/uploads/{campaign_id}', 'Business\CRMController@campaignUploads')->name('business.campaign.uploads');
Route::post('/campaign/upload/store/{campaign_id}', 'Business\CRMController@campaignUploadStore')->name('business.campaign.upload.store');
Route::get('/campaign/upload/download/{upload_id}', 'Business\CRMController@campaignUploadDownload')->name('business.campaign.upload.download');



// Contacts
Route::get('/contacts', 'Business\CRMController@contacts')->name('business.contacts');
Route::get('/contact/create', 'Business\CRMController@contactCreate')->name('business.contact.create');
Route::post('/contact/store', 'Business\CRMController@contactStore')->name('business.contact.store');
Route::get('/contact/show/{contact_id}', 'Business\CRMController@contactShow')->name('business.contact.show');

Route::get('/contact/asset/action/create/{asset_id}', 'Business\CRMController@contactAssetActionCreate')->name('business.contact.asset.action.create');
Route::get('/contact/promo/code/assign/{contact_id}', 'Business\CRMController@contactPromoCodeAssign')->name('business.contact.promo.code.assign');
Route::get('/contact/client/proof/create/{contact_id}', 'Business\CRMController@contactClientProofCreate')->name('business.contact.client.proof.create');
Route::get('/contact/deal/create/{contact_id}', 'Business\CRMController@contactDealCreate')->name('business.contact.deal.create');
Route::get('/contact/design/create/{contact_id}', 'Business\CRMController@contactDesignCreate')->name('business.contact.design.create');
Route::get('/contact/liability/create/{contact_id}', 'Business\CRMController@contactLiabilityCreate')->name('business.contact.liability.create');
Route::get('/contact/loan/create/{contact_id}', 'Business\CRMController@contactLoanCreate')->name('business.contact.loan.create');
Route::get('/contact/sale/create/{contact_id}', 'Business\CRMController@contactSaleCreate')->name('business.contact.sale.create');
Route::get('/contact/project/create/{contact_id}', 'Business\CRMController@contactProjectCreate')->name('business.contact.project.create');

Route::post('/contact/update/{contact_id}', 'Business\CRMController@contactUpdate')->name('business.contact.update');
Route::get('/contact/delete/{contact_id}', 'Business\CRMController@contactDelete')->name('business.contact.delete');
Route::get('/contact/restore/{contact_id}', 'Business\CRMController@contactRestore')->name('business.contact.restore');

Route::get('/contact/update/lead/to/contact/{contact_id}', 'Business\CRMController@contactUpdateLeadToContact')->name('business.contact.update.lead.to.contact');
Route::post('/contact/contact/type/store/{contact_id}', 'Business\CRMController@contactContactTypeStore')->name('business.contact.contact.type.store');



// Leads
Route::get('/leads', 'Business\CRMController@leads')->name('business.leads');
Route::get('/lead/create', 'Business\CRMController@leadCreate')->name('business.lead.create');



// organizations
Route::get('/organizations', 'Business\CRMController@organizations')->name('business.organizations');
Route::get('/organization/create', 'Business\CRMController@organizationCreate')->name('business.organization.create');
Route::post('/organization/store', 'Business\CRMController@organizationStore')->name('business.organization.store');
Route::get('/organization/show/{organization_id}', 'Business\CRMController@organizationShow')->name('business.organization.show');

Route::get('/organization/contact/create/{organization_id}', 'Business\CRMController@organizationContactCreate')->name('business.organization.contact.create');
Route::get('/organization/deal/create/{organization_id}', 'Business\CRMController@organizationDealCreate')->name('business.organization.deal.create');

Route::post('/organization/update/{organization_id}', 'Business\CRMController@organizationUpdate')->name('business.organization.update');
Route::get('/organization/delete/{organization_id}', 'Business\CRMController@organizationDelete')->name('business.organization.delete');
Route::get('/organization/restore/{organization_id}', 'Business\CRMController@organizationRestore')->name('business.organization.restore');




//Products
Route::get('/product/groups', 'Business\ProductController@productGroups')->name('business.product.groups');
Route::get('/product/group/create', 'Business\ProductController@productGroupCreate')->name('business.product.group.create');
Route::post('/product/group/store', 'Business\ProductController@productGroupStore')->name('business.product.group.store');
Route::get('/product/group/show/{product_group_id}', 'Business\ProductController@productGroupShow')->name('business.product.group.show');
Route::get('/product/group/edit/{product_group_id}', 'Business\ProductController@productGroupEdit')->name('business.product.group.edit');
Route::post('/product/group/update/{product_group_id}', 'Business\ProductController@productGroupUpdate')->name('business.product.group.update');
Route::get('/product/group/delete/{product_group_id}', 'Business\ProductController@productGroupDelete')->name('business.product.group.delete');

Route::get('/products', 'Business\ProductController@products')->name('business.products');
Route::get('/product/create', 'Business\ProductController@productCreate')->name('business.product.create');
Route::post('/product/store', 'Business\ProductController@productStore')->name('business.product.store');
Route::get('/product/show/{product_id}', 'Business\ProductController@productShow')->name('business.product.show');
Route::get('/product/edit/{product_id}', 'Business\ProductController@productEdit')->name('business.product.edit');
Route::post('/product/update/{product_id}', 'Business\ProductController@productUpdate')->name('business.product.update');
Route::get('/product/delete/{product_id}', 'Business\ProductController@productDelete')->name('business.product.delete');
Route::get('/product/restore/{product_id}', 'Business\ProductController@productRestore')->name('business.product.restore');

Route::post('/product/image/upload/{product_id}', 'Business\ProductController@productImageUpload')->name('business.product.image.upload');
Route::get('/product/image/delete/{product_id}', 'Business\ProductController@productImageDelete')->name('business.product.image.delete');

Route::post('/product/discount/store/{product_id}', 'Business\ProductController@productDiscountStore')->name('business.product.discount.store');
Route::post('/product/discount/update/{product_id}', 'Business\ProductController@productDiscountUpdate')->name('business.product.discount.update');
Route::get('/product/discount/delete/{product_id}', 'Business\ProductController@productDiscountDelete')->name('business.product.discount.delete');

Route::get('/product/tax/delete/{product_id}', 'Business\ProductController@productTaxDelete')->name('business.product.tax.delete');

Route::get('/composite/products', 'Business\ProductController@compositeProducts')->name('business.composite.products');
Route::get('/composite/product/create', 'Business\ProductController@compositeProductCreate')->name('business.composite.product.create');
Route::post('/composite/product/store', 'Business\ProductController@compositeProductStore')->name('business.composite.product.store');
Route::get('/composite/product/show/{composite_product_id}', 'Business\ProductController@compositeProductShow')->name('business.composite.product.show');
Route::get('/composite/product/edit/{composite_product_id}', 'Business\ProductController@compositeProductEdit')->name('business.composite.product.edit');
Route::post('/composite/product/update/{composite_product_id}', 'Business\ProductController@compositeProductUpdate')->name('business.composite.product.update');
Route::get('/composite/product/delete/{composite_product_id}', 'Business\ProductController@compositeProductDelete')->name('business.composite.product.delete');


//Inventory
Route::get('/inventory/adjustments', 'Business\InventoryController@inventoryAdjustments')->name('business.inventory.adjustments');
Route::get('/inventory/adjustment/create', 'Business\InventoryController@inventoryAdjustmentCreate')->name('business.inventory.adjustment.create');
Route::post('/inventory/adjustment/store', 'Business\InventoryController@inventoryAdjustmentStore')->name('business.inventory.adjustment.store');
Route::get('/inventory/adjustment/show/{inventory_adjustment_id}', 'Business\InventoryController@inventoryAdjustmentShow')->name('business.inventory.adjustment.show');
Route::get('/inventory/adjustment/edit/{inventory_adjustment_id}', 'Business\InventoryController@inventoryAdjustmentEdit')->name('business.inventory.adjustment.edit');
Route::post('/inventory/adjustment/update/{inventory_adjustment_id}', 'Business\InventoryController@inventoryAdjustmentUpdate')->name('business.inventory.adjustment.update');
Route::get('/inventory/adjustment/{inventory_adjustment_id}', 'Business\InventoryController@inventoryAdjustmentDelete')->name('business.inventory.adjustment.delete');

Route::get('/transfer/orders', 'Business\InventoryController@transferOrders')->name('business.transfer.orders');
Route::get('/transfer/order/create', 'Business\InventoryController@transferOrderCreate')->name('business.transfer.order.create');
Route::post('/transfer/order/store', 'Business\InventoryController@transferOrderStore')->name('business.transfer.order.store');
Route::get('/transfer/order/show/{transfer_order_id}', 'Business\InventoryController@transferOrderShow')->name('business.transfer.order.show');
Route::get('/transfer/order/edit/{transfer_order_id}', 'Business\InventoryController@transferOrderEdit')->name('business.transfer.order.edit');
Route::post('/transfer/order/update/{transfer_order_id}', 'Business\InventoryController@transferOrderUpdate')->name('business.transfer.order.update');
Route::get('/transfer/order/delete/{transfer_order_id}', 'Business\InventoryController@transferOrderDelete')->name('business.transfer.order.delete');

Route::get('/warehouses', 'Business\InventoryController@warehouses')->name('business.warehouses');
Route::post('/warehouse/store', 'Business\InventoryController@warehouseStore')->name('business.warehouse.store');
Route::get('/warehouse/show/{warehouse_id}', 'Business\InventoryController@warehouseShow')->name('business.warehouse.show');
Route::get('/warehouse/edit/{warehouse_id}', 'Business\InventoryController@warehouseEdit')->name('business.warehouse.edit');
Route::get('/warehouse/update/{warehouse_id}', 'Business\InventoryController@warehouseUpdate')->name('business.warehouse.update');
Route::get('/warehouse/delete/{warehouse_id}', 'Business\InventoryController@warehouseDelete')->name('business.warehouse.delete');


//Sales
Route::get('/clients', 'Business\SaleController@clients')->name('business.clients');
Route::get('/client/create', 'Business\SaleController@clientCreate')->name('business.client.create');
Route::post('/client/store', 'Business\SaleController@clientStore')->name('business.client.store');
Route::get('/client/show/{client_id}', 'Business\SaleController@clientShow')->name('business.client.show');
Route::get('/client/contact/person/show/{client_id}', 'Business\SaleController@clientContactPersonShow')->name('business.client.contact.person.show');
Route::get('/client/contact/person/contact/{client_id}', 'Business\SaleController@clientContactPersonContact')->name('business.client.contact.person.contact');
Route::get('/client/edit/{client_id}', 'Business\SaleController@clientEdit')->name('business.client.edit');
Route::post('/client/update/{client_id}', 'Business\SaleController@clientUpdate')->name('business.client.update');
Route::get('/client/delete/{client_id}', 'Business\SaleController@clientDelete')->name('business.client.delete');


// estimates
Route::get('/estimates', 'Business\SaleController@estimates')->name('business.estimates');
Route::get('/estimate/create', 'Business\SaleController@estimateCreate')->name('business.estimate.create');
Route::post('/estimate/store', 'Business\SaleController@estimateStore')->name('business.estimate.store');
Route::get('/estimate/show/{estimate_id}', 'Business\SaleController@estimateShow')->name('business.estimate.show');
Route::get('/estimate/edit/{estimate_id}', 'Business\SaleController@estimateEdit')->name('business.estimate.edit');
Route::post('/estimate/update/{estimate_id}', 'Business\SaleController@estimateUpdate')->name('business.estimate.update');
Route::get('/estimate/convert/to/invoice/{estimate_id}', 'Business\SaleController@estimateConvertToInvoice')->name('business.estimate.convert.to.invoice');
Route::get('/estimate/delete/{estimate_id}', 'Business\SaleController@estimateDelete')->name('business.estimate.delete');
Route::get('/estimate/restore/{estimate_id}', 'Business\SaleController@estimateRestore')->name('business.estimate.restore');
Route::get('/estimate/print/{estimate_id}', 'Business\SaleController@estimatePrint')->name('business.estimate.print');
// estimate product
Route::get('/estimate/product/delete/{estimate_product_id}', 'Business\SaleController@estimateProductDelete')->name('business.estimate.product.delete');

// invoices
Route::get('/invoices', 'Business\SaleController@invoices')->name('business.invoices');
Route::get('/invoice/create', 'Business\SaleController@invoiceCreate')->name('business.invoice.create');
Route::post('/invoice/store', 'Business\SaleController@invoiceStore')->name('business.invoice.store');
Route::get('/invoice/show/{invoice_id}', 'Business\SaleController@invoiceShow')->name('business.invoice.show');
Route::get('/invoice/edit/{invoice_id}', 'Business\SaleController@invoiceEdit')->name('business.invoice.edit');
Route::post('/invoice/update/{invoice_id}', 'Business\SaleController@invoiceUpdate')->name('business.invoice.update');
Route::get('/invoice/convert/to/sale/{estimate_id}', 'Business\SaleController@invoiceConvertToSale')->name('business.invoice.convert.to.sale');
Route::get('/invoice/delete/{invoice_id}', 'Business\SaleController@invoiceDelete')->name('business.invoice.delete');
Route::get('/invoice/print/{invoice_id}', 'Business\SaleController@invoicePrint')->name('business.invoice.print');

Route::get('/invoice/product/delete/{invoice_product_id}', 'Business\SaleController@invoiceProductDelete')->name('business.invoice.product.delete');


// sales
Route::get('/sales', 'Business\SaleController@sales')->name('business.sales');
Route::get('/sale/create', 'Business\SaleController@saleCreate')->name('business.sale.create');
Route::post('/sale/store', 'Business\SaleController@saleStore')->name('business.sale.store');
Route::get('/sale/show/{sale_id}', 'Business\SaleController@saleShow')->name('business.sale.show');

Route::get('/sale/payment/create/{sale_id}', 'Business\SaleController@salePaymentCreate')->name('business.sale.payment.create');

Route::get('/sale/edit/{sale_id}', 'Business\SaleController@saleEdit')->name('business.sale.edit');
Route::get('/sale/update/{sale_id}', 'Business\SaleController@saleUpdate')->name('business.sale.update');
Route::get('/sale/delete/{sale_id}', 'Business\SaleController@saleDelete')->name('business.sale.delete');
Route::get('/sale/print/{order_id}', 'Business\SaleController@salePrint')->name('business.sale.print');

Route::get('/sale/product/delete/{invoice_product_id}', 'Business\SaleController@saleProductDelete')->name('business.sale.product.delete');

Route::post('/sale/record/payment/{sale_id}', 'Business\SaleController@saleRecordPayment')->name('business.sale.record.payment');
Route::post('/sale/record/payment/refund/{payment_received_id}', 'Business\SaleController@saleRecordPaymentRefund')->name('business.sale.record.payment.refund');
Route::get('/payments/received', 'Business\SaleController@paymentsReceived')->name('business.payments.received');


// Expenses
Route::get('/purchase/orders', 'Business\PurchaseController@purchaseOrders')->name('business.purchase.orders');
Route::get('/purchase/order/create', 'Business\PurchaseController@purchaseOrderCreate')->name('business.purchase.order.create');
Route::get('/purchase/order/store', 'Business\PurchaseController@purchaseOrderStore')->name('business.purchase.order.store');
Route::get('/purchase/order/show/{purchase_order_id}', 'Business\PurchaseController@purchaseOrderShow')->name('business.purchase.order.show');
Route::get('/purchase/order/edit/{purchase_order_id}', 'Business\PurchaseController@purchaseOrderEdit')->name('business.purchase.order.edit');
Route::get('/purchase/order/update/{purchase_order_id}', 'Business\PurchaseController@purchaseOrderUpdate')->name('business.purchase.order.update');
Route::get('/purchase/order/delete/{purchase_order_id}', 'Business\PurchaseController@purchaseOrderDelete')->name('business.purchase.order.delete');

Route::get('/vendors', 'Business\PurchaseController@vendors')->name('business.vendors');
Route::get('/vendor/create', 'Business\PurchaseController@vendorCreate')->name('business.vendor.create');
Route::get('/vendor/store', 'Business\PurchaseController@vendorStore')->name('business.vendor.store');
Route::get('/vendor/show/{vendor_id}', 'Business\PurchaseController@vendorShow')->name('business.vendor.show');
Route::get('/vendor/contact/person/show/{vendor_id}', 'Business\PurchaseController@vendorContactPersonShow')->name('business.vendor.contact.person.show');
Route::get('/vendor/contact/person/contact/{vendor_id}', 'Business\PurchaseController@vendorContactPersonContact')->name('business.vendor.contact.person.contact');
Route::get('/vendor/edit/{vendor_id}', 'Business\PurchaseController@vendorEdit')->name('business.vendor.edit');
Route::get('/vendor/update/{vendor_id}', 'Business\PurchaseController@vendorUpdate')->name('business.vendor.update');
Route::get('/vendor/delete/{vendor_id}', 'Business\PurchaseController@vendorDelete')->name('business.vendor.delete');

Route::get('/expenses', 'Business\PurchaseController@expenses')->name('business.expenses');
Route::get('/expense/create', 'Business\PurchaseController@expenseCreate')->name('business.expense.create');
Route::post('/expense/store', 'Business\PurchaseController@expenseStore')->name('business.expense.store');
Route::get('/expense/show/{expense_id}', 'Business\PurchaseController@expenseShow')->name('business.expense.show');
Route::get('/expense/edit/{expense_id}', 'Business\PurchaseController@expenseEdit')->name('business.expense.edit');
Route::get('/expense/update/{expense_id}', 'Business\PurchaseController@expenseUpdate')->name('business.expense.update');
Route::get('/expense/delete/{expense_id}', 'Business\PurchaseController@expenseDelete')->name('business.expense.delete');
Route::get('/expense/print/{expense_id}', 'Business\PurchaseController@expensePrint')->name('business.expense.print');

Route::get('/bills', 'Business\PurchaseController@bills')->name('business.bills');
Route::get('/bill/create', 'Business\PurchaseController@billCreate')->name('business.bill.create');
Route::get('/bill/store', 'Business\PurchaseController@billStore')->name('business.bill.store');
Route::get('/bill/show/{bill_id}', 'Business\PurchaseController@billShow')->name('business.bill.show');
Route::get('/bill/edit/{bill_id}', 'Business\PurchaseController@billEdit')->name('business.bill.edit');
Route::get('/bill/update/{bill_id}', 'Business\PurchaseController@billUpdate')->name('business.bill.update');
Route::get('/bill/delete/{bill_id}', 'Business\PurchaseController@billDelete')->name('business.bill.delete');
Route::get('/bill/print/{bill_id}', 'Business\PurchaseController@billPrint')->name('business.bill.print');

Route::get('/payments/made', 'Business\PurchaseController@paymentsMade')->name('business.payments.made');

Route::get('/expense/settings', 'Business\PurchaseController@expenseSettings')->name('business.expense.settings');





// Accounting
// accounts
Route::get('/accounts', 'Business\AccountController@accounts')->name('business.accounts');
Route::get('/account/create', 'Business\AccountController@accountCreate')->name('business.account.create');
Route::post('/account/store', 'Business\AccountController@accountStore')->name('business.account.store');
Route::get('/account/show/{account_id}', 'Business\AccountController@accountShow')->name('business.account.show');

Route::get('/account/deposit/create/{account_id}', 'Business\AccountController@accountDepositCreate')->name('business.account.deposit.create');
Route::get('/account/liability/create/{account_id}', 'Business\AccountController@accountLiabilityCreate')->name('business.account.liability.create');
Route::get('/account/loan/create/{account_id}', 'Business\AccountController@accountLoanCreate')->name('business.account.loan.create');
Route::get('/account/withdrawal/create/{account_id}', 'Business\AccountController@accountWithdrawalCreate')->name('business.account.withdrawal.create');

Route::get('/account/edit/{account_id}', 'Business\AccountController@accountEdit')->name('business.account.edit');
Route::post('/account/update/{account_id}', 'Business\AccountController@accountUpdate')->name('business.account.update');
Route::get('/account/delete/{account_id}', 'Business\AccountController@accountDelete')->name('business.account.delete');
Route::get('/account/restore/{account_id}', 'Business\AccountController@accountRestore')->name('business.account.restore');

// deposits

Route::post('/deposit/store', 'Business\AccountController@depositStore')->name('business.deposit.store');
Route::get('/deposit/show/{deposit_id}', 'Business\AccountController@depositShow')->name('business.deposit.show');

Route::get('/deposit/account/adjustment/create/{deposit_id}', 'Business\AccountController@depositAccountAdjustmentCreate')->name('business.deposit.account.adjustment.create');

Route::post('/deposit/update/{deposit_id}', 'Business\AccountController@depositUpdate')->name('business.deposit.update');
Route::get('/deposit/delete/{deposit_id}', 'Business\AccountController@depositDelete')->name('business.deposit.delete');
Route::get('/deposit/restore/{deposit_id}', 'Business\AccountController@depositRestore')->name('business.deposit.restore');

// withdrawals
Route::post('/withdrawal/store', 'Business\AccountController@withdrawalStore')->name('business.withdrawal.store');
Route::get('/withdrawal/show/{withdrawal_id}', 'Business\AccountController@withdrawalShow')->name('business.withdrawal.show');

Route::get('/withdrawal/account/adjustment/create/{withdrawal_id}', 'Business\AccountController@withdrawalAccountAdjustmentCreate')->name('business.withdrawal.account.adjustment.create');

Route::post('/withdrawal/update/{withdrawal_id}', 'Business\AccountController@withdrawalUpdate')->name('business.withdrawal.update');
Route::get('/withdrawal/delete/{withdrawal_id}', 'Business\AccountController@withdrawalDelete')->name('business.withdrawal.delete');
Route::get('/withdrawal/restore/{withdrawal_id}', 'Business\AccountController@withdrawalRestore')->name('business.withdrawal.restore');

// account adjustment
Route::get('/account/adjustment/create/{account_id}', 'Business\AccountController@accountAdjustmentCreate')->name('business.account.adjustment.create');
Route::get('/account/adjustment/create/{account_id}', 'Business\AccountController@accountAdjustmentCreate')->name('business.account.adjustment.create');
Route::post('/account/adjustment/store', 'Business\AccountController@accountAdjustmentStore')->name('business.account.adjustment.store');
Route::get('/account/adjustment/edit/{account_id}', 'Business\AccountController@accountAdjustmentEdit')->name('business.account.adjustment.edit');
Route::post('/account/adjustment/update/{account_id}', 'Business\AccountController@accountAdjustmentUpdate')->name('business.account.adjustment.update');
Route::get('/account/adjustment/delete/{account_id}', 'Business\AccountController@accountAdjustmentDelete')->name('business.account.adjustment.delete');
Route::get('/account/adjustment/restore/{account_id}', 'Business\AccountController@accountAdjustmentRestore')->name('business.account.adjustment.restore');


// expenses
Route::get('/expenses', 'Business\ExpenseController@expenses')->name('business.expenses');
Route::get('/expense/create', 'Business\ExpenseController@expenseCreate')->name('business.expense.create');
Route::post('/expense/store', 'Business\ExpenseController@expenseStore')->name('business.expense.store');
Route::get('/expense/show/{expense_id}', 'Business\ExpenseController@expenseShow')->name('business.expense.show');
Route::get('/expense/edit/{expense_id}', 'Business\ExpenseController@expenseEdit')->name('business.expense.edit');
Route::post('/expense/update/{expense_id}', 'Business\ExpenseController@expenseUpdate')->name('business.expense.update');
Route::get('/expense/delete/{expense_id}', 'Business\ExpenseController@expenseDelete')->name('business.expense.delete');
Route::get('/expense/restore/{expense_id}', 'Business\ExpenseController@expenseRestore')->name('business.expense.restore');
Route::get('/expense/product/delete/{expense_id}', 'Business\ExpenseController@expenseProductDelete')->name('business.expense.product.delete');
Route::get('/expense/product/restore/{expense_id}', 'Business\ExpenseController@expenseProductRestore')->name('business.expense.product.restore');


// liabilities
Route::get('/liabilities', 'Business\AccountController@liabilities')->name('business.liabilities');
Route::get('/liability/create', 'Business\AccountController@liabilityCreate')->name('business.liability.create');
Route::post('/liability/store', 'Business\AccountController@liabilityStore')->name('business.liability.store');
Route::get('/liability/show/{liability_id}', 'Business\AccountController@liabilityShow')->name('business.liability.show');

Route::get('/liability/expense/create/{liability_id}', 'Business\AccountController@liabilityExpenseCreate')->name('business.liability.expense.create');

Route::get('/liability/edit/{liability_id}', 'Business\AccountController@liabilityEdit')->name('business.liability.edit');
Route::post('/liability/update/{liability_id}', 'Business\AccountController@liabilityUpdate')->name('business.liability.update');
Route::get('/liability/delete/{liability_id}', 'Business\AccountController@liabilityDelete')->name('business.liability.delete');
Route::get('/liability/restore/{liability_id}', 'Business\AccountController@liabilityRestore')->name('business.liability.restore');


// loans
Route::get('/loans', 'Business\AccountController@loans')->name('business.loans');
Route::get('/loan/create', 'Business\AccountController@loanCreate')->name('business.loan.create');
Route::post('/loan/store', 'Business\AccountController@loanStore')->name('business.loan.store');
Route::get('/loan/show/{loan_id}', 'Business\AccountController@loanShow')->name('business.loan.show');

Route::get('/loan/payment/create/{loan_id}', 'Business\AccountController@loanPaymentCreate')->name('business.loan.payment.create');

Route::get('/loan/edit/{loan_id}', 'Business\AccountController@loanEdit')->name('business.loan.edit');
Route::post('/loan/update/{loan_id}', 'Business\AccountController@loanUpdate')->name('business.loan.update');
Route::get('/loan/delete/{loan_id}', 'Business\AccountController@loanDelete')->name('business.loan.delete');
Route::get('/loan/restore/{loan_id}', 'Business\AccountController@loanRestore')->name('business.loan.restore');


// payments
Route::get('/payments', 'Business\ExpenseController@payments')->name('business.payments');
Route::get('/payment/create', 'Business\ExpenseController@paymentCreate')->name('business.payment.create');
Route::post('/payment/store', 'Business\ExpenseController@paymentStore')->name('business.payment.store');
Route::get('/payment/show/{payment_id}', 'Business\ExpenseController@paymentShow')->name('business.payment.show');

Route::get('/payment/{payment_id}/refund/create', 'Business\ExpenseController@refundCreate')->name('business.payment.refund.create');

Route::get('/payment/delete/{payment_id}', 'Business\ExpenseController@paymentDelete')->name('business.payment.delete');
Route::get('/payment/restore/{payment_id}', 'Business\ExpenseController@paymentRestore')->name('business.payment.restore');


// refunds
Route::get('/refunds', 'Business\ExpenseController@refunds')->name('business.refunds');
Route::post('/refund/store', 'Business\ExpenseController@refundStore')->name('business.refund.store');
Route::get('/refund/show/{refund_id}', 'Business\ExpenseController@refundShow')->name('business.refund.show');
Route::get('/refund/edit/{refund_id}', 'Business\ExpenseController@refundEdit')->name('business.refund.edit');
Route::post('/refund/update/{refund_id}', 'Business\ExpenseController@refundUpdate')->name('business.refund.update');
Route::get('/refund/delete/{refund_id}', 'Business\ExpenseController@refundDelete')->name('business.refund.delete');
Route::get('/refund/restore/{refund_id}', 'Business\ExpenseController@refundRestore')->name('business.refund.restore');


// transactions
Route::get('/transactions', 'Business\ExpenseController@transactions')->name('business.transactions');
Route::get('/transaction/create/{expense_id}', 'Business\ExpenseController@transactionCreate')->name('business.transaction.create');
Route::post('/transaction/store', 'Business\ExpenseController@transactionStore')->name('business.transaction.store');
Route::get('/transaction/edit/{transaction_id}', 'Business\ExpenseController@transactionEdit')->name('business.transaction.edit');
Route::post('/transaction/update/{transaction_id}', 'Business\ExpenseController@transactionUpdate')->name('business.transaction.update');
Route::get('/transaction/billed/{transaction_id}', 'Business\ExpenseController@transactionBilled')->name('business.transaction.billed');
Route::get('/transaction/pending/payment/{transaction_id}', 'Business\ExpenseController@transactionPendingPayment')->name('business.transaction.pending.payment');
Route::get('/transaction/delete/{transaction_id}', 'Business\ExpenseController@transactionDelete')->name('business.transaction.delete');
Route::get('/transaction/restore/{transaction_id}', 'Business\ExpenseController@transactionRestore')->name('business.transaction.restore');


// transfers
Route::get('/transfers', 'Business\AccountController@transfers')->name('business.transfers');
Route::get('/transfer/create', 'Business\AccountController@transferCreate')->name('business.transfer.create');
Route::post('/transfer/store', 'Business\AccountController@transferStore')->name('business.transfer.store');
Route::get('/transfer/show/{transfer_id}', 'Business\AccountController@transferShow')->name('business.transfer.show');

Route::get('/transfer/expense/create/{transfer_id}', 'Business\AccountController@transferExpenseCreate')->name('business.transfer.expense.create');

Route::get('/transfer/edit/{transfer_id}', 'Business\AccountController@transferEdit')->name('business.transfer.edit');
Route::post('/transfer/update/{transfer_id}', 'Business\AccountController@transferUpdate')->name('business.transfer.update');
Route::get('/transfer/delete/{transfer_id}', 'Business\AccountController@transferDelete')->name('business.transfer.delete');
Route::get('/transfer/restore/{transfer_id}', 'Business\AccountController@transferRestore')->name('business.transfer.restore');




// Assets
Route::get('/assets', 'Business\AssetController@assets')->name('business.assets');
Route::get('/asset/create', 'Business\AssetController@assetCreate')->name('business.asset.create');
Route::get('/asset/store', 'Business\AssetController@assetStore')->name('business.asset.store');
Route::get('/asset/show/{asset_id}', 'Business\AssetController@assetShow')->name('business.asset.show');
Route::get('/asset/edit/{asset_id}', 'Business\AssetController@assetEdit')->name('business.asset.edit');
Route::get('/asset/update/{asset_id}', 'Business\AssetController@assetUpdate')->name('business.asset.update');
Route::get('/asset/delete/{asset_id}', 'Business\AssetController@assetDelete')->name('business.asset.delete');


// Projects
Route::get('/projects/feed', 'Business\ProjectController@projectsFeed')->name('business.projects.feed');
Route::get('/projects', 'Business\ProjectController@projects')->name('business.projects');
Route::get('/project/create', 'Business\ProjectController@projectCreate')->name('business.project.create');
Route::post('/project/store', 'Business\ProjectController@projectStore')->name('business.project.store');
Route::get('/project/show/{project_id}', 'Business\ProjectController@projectShow')->name('business.project.show');
Route::get('/project/update/{project_id}', 'Business\ProjectController@projectUpdate')->name('business.project.edit');
Route::get('/project/edit/{project_id}', 'Business\ProjectController@projectEdit')->name('business.project.edit');
Route::get('/project/delete/{employee_id}', 'Business\ProjectController@employeeDelete')->name('business.project.delete');


// Human Resource
Route::get('/employees', 'Business\EmployeeController@employees')->name('business.employees');
Route::get('/employee/create', 'Business\EmployeeController@employeeCreate')->name('business.employee.create');
Route::post('/employee/store', 'Business\EmployeeController@employeeStore')->name('business.employee.store');
Route::get('/employee/show/{employee_id}', 'Business\EmployeeController@employeeShow')->name('business.employee.show');
Route::get('/employee/update/{employee_id}', 'Business\EmployeeController@employeeUpdate')->name('business.employee.edit');
Route::get('/employee/edit/{employee_id}', 'Business\EmployeeController@employeeEdit')->name('business.employee.edit');
Route::get('/employee/delete/{employee_id}', 'Business\EmployeeController@employeeDelete')->name('business.employee.delete');

Route::get('/leave', 'Business\EmployeeController@leave')->name('business.leave');
Route::get('/leave/create', 'Business\EmployeeController@leaveCreate')->name('business.leave.create');
Route::post('/leave/store', 'Business\EmployeeController@leaveStore')->name('business.leave.store');
Route::get('/leave/show/{leave_id}', 'Business\EmployeeController@leaveShow')->name('business.leave.show');
Route::get('/leave/update/{leave_id}', 'Business\EmployeeController@leaveUpdate')->name('business.leave.edit');
Route::get('/leave/edit/{leave_id}', 'Business\EmployeeController@leaveEdit')->name('business.leave.edit');
Route::get('/leave/delete/{leave_id}', 'Business\EmployeeController@leaveDelete')->name('business.leave.delete');

Route::get('/payroll', 'Business\EmployeeController@payroll')->name('business.payroll');
Route::get('/payroll/history', 'Business\EmployeeController@payrollHistory')->name('business.payroll.history');
Route::get('/payroll/history/{employee_id}', 'Business\EmployeeController@employeePayrollHistory')->name('business.employee.payroll.history');
Route::get('/payroll/annual/salary/statement', 'Business\EmployeeController@payrollAnnualSalaryStatement')->name('business.payroll.annual.salary.statement');
Route::get('/payroll/process', 'Business\EmployeeController@payrollProcess')->name('business.payroll.process');
Route::post('/payroll/process/payment', 'Business\EmployeeController@payrollProcessPayment')->name('business.payroll.process.payment');
Route::get('/payroll/salary/adjustment/{employee_id}', 'Business\EmployeeController@payrollSalaryAdjustment')->name('business.payroll.salary.adjustment');

Route::post('/variable/pay/store', 'Business\EmployeeController@variablePayStore')->name('business.variable.pay.store');
Route::get('/variable/pay/update/{variable_pay_id}', 'Business\EmployeeController@variablePayUpdate')->name('business.variable.pay.update');
Route::get('/variable/pay/delete/{variable_pay_id}', 'Business\EmployeeController@variablePayDelete')->name('business.variable.pay.delete');

Route::post('/variable/deduction/store', 'Business\EmployeeController@variableDeductionStore')->name('business.variable.deduction.store');
Route::get('/variable/deduction/update/{variable_deduction_id}', 'Business\EmployeeController@variableDeductionUpdate')->name('business.variable.deduction.update');
Route::get('/variable/deduction/delete/{variable_deduction_id}', 'Business\EmployeeController@variableDeductionDelete')->name('business.variable.deduction.delete');

Route::post('/bonus/store', 'Business\EmployeeController@bonusStore')->name('business.bonus.store');
Route::get('/bonus/update/{bonus_id}', 'Business\EmployeeController@bonusUpdate')->name('business.bonus.update');
Route::get('/bonus/delete/{bonus_id}', 'Business\EmployeeController@bonusDelete')->name('business.bonus.delete');

Route::post('/statutory/contribution/store', 'Business\EmployeeController@statutoryContributionStore')->name('business.statutory.contribution.store');
Route::get('/statutory/contribution/update/{variable_deduction_id}', 'Business\EmployeeController@statutoryContributionUpdate')->name('business.statutory.contribution.update');
Route::get('/statutory/contribution/delete/{variable_deduction_id}', 'Business\EmployeeController@statutoryContributionDelete')->name('business.statutory.contribution.delete');

Route::get('/employer', 'Business\EmployeeController@employer')->name('business.employer');

Route::get('/human/resource/settings', 'Business\EmployeeController@humanResourceSettings')->name('business.human.resource.settings');

Route::get('/workdays/update', 'Business\EmployeeController@workdaysUpdate')->name('business.workdays.update');

Route::get('/holiday/store', 'Business\EmployeeController@holidayStore')->name('business.holiday.store');
Route::get('/holiday/update/{holiday_id}', 'Business\EmployeeController@holidayUpdate')->name('business.holiday.update');
Route::get('/holiday/delete/{holiday_id}', 'Business\EmployeeController@holidayDelete')->name('business.holiday.delete');

Route::get('/leave/type/store', 'Business\EmployeeController@leaveTypeStore')->name('business.leave.type.store');
Route::get('/leave/type/update/{holiday_id}', 'Business\EmployeeController@leaveTypeUpdate')->name('business.leave.type.update');
Route::get('/leave/type/delete/{holiday_id}', 'Business\EmployeeController@leaveTypeDelete')->name('business.leave.type.delete');

Route::get('/earning/policy/store', 'Business\EmployeeController@earningPolicyStore')->name('business.earning.policy.store');
Route::get('/earning/policy/update/{holiday_id}', 'Business\EmployeeController@earningPolicyUpdate')->name('business.earning.policy.update');
Route::get('/earning/policy/delete/{holiday_id}', 'Business\EmployeeController@earningPolicyDelete')->name('business.earning.policy.delete');

// Settings
Route::get('/organization/profile', 'Business\SettingController@organizationProfile')->name('business.organization.profile');
Route::get('/opening/balances', 'Business\SettingController@openingBalances')->name('business.opening.balances');
Route::get('/users/roles', 'Business\SettingController@usersAndRoles')->name('business.users.roles');
Route::get('/currencies', 'Business\SettingController@currencies')->name('business.currencies');
Route::get('/taxes', 'Business\SettingController@taxes')->name('business.taxes');
Route::get('/emails', 'Business\SettingController@emails')->name('business.emails');
Route::get('/reminders', 'Business\SettingController@reminders')->name('business.reminders');


// Campaign types
Route::get('/campaign/types', 'Business\SettingController@campaignTypes')->name('business.campaign.types');
Route::get('/campaign/type/create', 'Business\SettingController@campaignTypeCreate')->name('business.campaign.type.create');
Route::post('/campaign/type/store', 'Business\SettingController@campaignTypeStore')->name('business.campaign.type.store');
Route::get('/campaign/type/show/{campaign_type_id}', 'Business\SettingController@campaignTypeShow')->name('business.campaign.type.show');
Route::post('/campaign/type/update/{campaign_type_id}', 'Business\SettingController@campaignTypeUpdate')->name('business.campaign.type.update');
Route::get('/campaign/type/delete/{campaign_type_id}', 'Business\SettingController@campaignTypeDelete')->name('business.campaign.type.delete');
Route::get('/campaign/type/restore/{campaign_type_id}', 'Business\SettingController@campaignTypeRestore')->name('business.campaign.type.restore');


// Contact types
Route::get('/contact/types', 'Business\SettingController@contactTypes')->name('business.contact.types');
Route::get('/contact/type/create', 'Business\SettingController@contactTypeCreate')->name('business.contact.type.create');
Route::post('/contact/type/store', 'Business\SettingController@contactTypeStore')->name('business.contact.type.store');
Route::get('/contact/type/show/{contact_type_id}', 'Business\SettingController@contactTypeShow')->name('business.contact.type.show');
Route::post('/contact/type/update/{contact_type_id}', 'Business\SettingController@contactTypeUpdate')->name('business.contact.type.update');
Route::get('/contact/type/delete/{contact_type_id}', 'Business\SettingController@contactTypeDelete')->name('business.contact.type.delete');
Route::get('/contact/type/restore/{contact_type_id}', 'Business\SettingController@contactTypeRestore')->name('business.contact.type.restore');


// Frequencies
Route::get('/frequencies', 'Business\SettingController@frequencies')->name('business.frequencies');
Route::get('/frequency/create', 'Business\SettingController@frequencyCreate')->name('business.frequency.create');
Route::post('/frequency/store', 'Business\SettingController@frequencyStore')->name('business.frequency.store');
Route::get('/frequency/show/{contact_type_id}', 'Business\SettingController@frequencyShow')->name('business.frequency.show');
Route::post('/frequency/update/{contact_type_id}', 'Business\SettingController@frequencyUpdate')->name('business.frequency.update');
Route::get('/frequency/delete/{contact_type_id}', 'Business\SettingController@frequencyDelete')->name('business.frequency.delete');
Route::get('/frequency/restore/{contact_type_id}', 'Business\SettingController@frequencyRestore')->name('business.frequency.restore');


// Lead sources
Route::get('/lead/sources', 'Business\SettingController@leadSources')->name('business.lead.sources');
Route::get('/lead/source/create', 'Business\SettingController@leadSourceCreate')->name('business.lead.source.create');
Route::post('/lead/source/store', 'Business\SettingController@leadSourceStore')->name('business.lead.source.store');
Route::get('/lead/source/show/{lead_source_id}', 'Business\SettingController@leadSourceShow')->name('business.lead.source.show');
Route::post('/lead/source/update/{lead_source_id}', 'Business\SettingController@leadSourceUpdate')->name('business.lead.source.update');
Route::get('/lead/source/delete/{lead_source_id}', 'Business\SettingController@leadSourceDelete')->name('business.lead.source.delete');
Route::get('/lead/source/restore/{lead_source_id}', 'Business\SettingController@leadSourceRestore')->name('business.lead.source.restore');


// Titles
Route::get('/titles', 'Business\SettingController@titles')->name('business.titles');
Route::get('/title/create', 'Business\SettingController@titleCreate')->name('business.title.create');
Route::post('/title/store', 'Business\SettingController@titleStore')->name('business.title.store');
Route::get('/title/show/{title_id}', 'Business\SettingController@titleShow')->name('business.title.show');
Route::post('/title/update/{title_id}', 'Business\SettingController@titleUpdate')->name('business.title.update');
Route::get('/title/delete/{title_id}', 'Business\SettingController@titleDelete')->name('business.title.delete');
Route::get('/title/restore/{title_id}', 'Business\SettingController@titleRestore')->name('business.title.restore');


// units
Route::get('/units', 'Business\SettingController@units')->name('business.units');
Route::get('/unit/create', 'Business\SettingController@unitCreate')->name('business.unit.create');
Route::post('/unit/store', 'Business\SettingController@unitStore')->name('business.unit.store');
Route::get('/unit/show/{unit_id}', 'Business\SettingController@unitShow')->name('business.unit.show');
Route::post('/unit/update/{unit_id}', 'Business\SettingController@unitUpdate')->name('business.unit.update');
Route::get('/unit/delete/{unit_id}', 'Business\SettingController@unitDelete')->name('business.unit.delete');
Route::get('/unit/restore/{unit_id}', 'Business\SettingController@unitRestore')->name('business.unit.restore');
