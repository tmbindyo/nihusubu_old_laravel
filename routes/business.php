<?php


//Dashboard
Route::get('/{portal}/dashboard', 'Business\DashboardController@dashboard')->name('business.dashboard');



//Calendar
Route::get('/{portal}/calendar', 'Business\CalendarController@calendar')->name('business.calendar');
Route::post('/{portal}/calendar/store', 'Business\CalendarController@calendarStore')->name('business.calendar.store');

Route::get('/{portal}/to/dos', 'Business\ToDoController@toDos')->name('business.to.dos');
Route::post('/{portal}/to/do/store', 'Business\ToDoController@toDoStore')->name('business.to.do.store');
Route::post('/{portal}/to/do/update/{todo_id}', 'Business\ToDoController@toDoUpdate')->name('business.to.do.update');
Route::get('/{portal}/to/do/set/in/progress/{todo_id}', 'Business\ToDoController@toDoSetInProgress')->name('business.to.do.set.in.progress');
Route::get('/{portal}/to/do/set/completed/{todo_id}', 'Business\ToDoController@toDoSetCompleted')->name('business.to.do.set.completed');
Route::get('/{portal}/to/do/delete/{todo_id}', 'Business\ToDoController@toDoDelete')->name('business.to.do.delete');



/// CRM
// Campaign
Route::get('/{portal}/campaigns', 'Business\CRMController@campaigns')->name('business.campaigns');
Route::get('/{portal}/campaign/create', 'Business\CRMController@campaignCreate')->name('business.campaign.create');
Route::post('/{portal}/campaign/store', 'Business\CRMController@campaignStore')->name('business.campaign.store');
Route::get('/{portal}/campaign/show/{campaign_id}', 'Business\CRMController@campaignShow')->name('business.campaign.show');
Route::post('/{portal}/campaign/update/{campaign_id}', 'Business\CRMController@campaignUpdate')->name('business.campaign.update');
Route::get('/{portal}/campaign/delete/{campaign_id}', 'Business\CRMController@campaignDelete')->name('business.campaign.delete');
Route::get('/{portal}/campaign/restore/{campaign_id}', 'Business\CRMController@campaignRestore')->name('business.campaign.restore');

Route::get('/{portal}/campaign/contact/create/{campaign_id}', 'Business\CRMController@campaignContactCreate')->name('business.campaign.contact.create');
Route::get('/{portal}/campaign/deal/create/{campaign_id}', 'Business\CRMController@campaignDealCreate')->name('business.campaign.deal.create');
Route::get('/{portal}/campaign/expense/create/{campaign_id}', 'Business\CRMController@campaignExpenseCreate')->name('business.campaign.expense.create');
Route::get('/{portal}/campaign/organization/create/{campaign_id}', 'Business\CRMController@campaignOrganizationCreate')->name('business.campaign.organization.create');


// Campaign uploads
Route::get('/{portal}/campaign/uploads/{campaign_id}', 'Business\CRMController@campaignUploads')->name('business.campaign.uploads');
Route::post('/{portal}/campaign/upload/store/{campaign_id}', 'Business\CRMController@campaignUploadStore')->name('business.campaign.upload.store');
Route::get('/{portal}/campaign/upload/download/{upload_id}', 'Business\CRMController@campaignUploadDownload')->name('business.campaign.upload.download');



// Contacts
Route::get('/{portal}/contacts', 'Business\CRMController@contacts')->name('business.contacts');
Route::get('/{portal}/contact/create', 'Business\CRMController@contactCreate')->name('business.contact.create');
Route::post('/{portal}/contact/store', 'Business\CRMController@contactStore')->name('business.contact.store');
Route::get('/{portal}/contact/show/{contact_id}', 'Business\CRMController@contactShow')->name('business.contact.show');
Route::post('/{portal}/contact/update/{contact_id}', 'Business\CRMController@contactUpdate')->name('business.contact.update');
Route::get('/{portal}/contact/delete/{contact_id}', 'Business\CRMController@contactDelete')->name('business.contact.delete');
Route::get('/{portal}/contact/restore/{contact_id}', 'Business\CRMController@contactRestore')->name('business.contact.restore');

Route::get('/{portal}/contact/liability/create/{contact_id}', 'Business\CRMController@contactLiabilityCreate')->name('business.contact.liability.create');
Route::get('/{portal}/contact/loan/create/{contact_id}', 'Business\CRMController@contactLoanCreate')->name('business.contact.loan.create');
Route::get('/{portal}/contact/sale/create/{contact_id}', 'Business\CRMController@contactSaleCreate')->name('business.contact.sale.create');
Route::get('/{portal}/contact/update/lead/to/contact/{contact_id}', 'Business\CRMController@contactUpdateLeadToContact')->name('business.contact.update.lead.to.contact');



// Leads
Route::get('/{portal}/leads', 'Business\CRMController@leads')->name('business.leads');
Route::get('/{portal}/lead/create', 'Business\CRMController@leadCreate')->name('business.lead.create');



// organizations
Route::get('/{portal}/organizations', 'Business\CRMController@organizations')->name('business.organizations');
Route::get('/{portal}/organization/create', 'Business\CRMController@organizationCreate')->name('business.organization.create');
Route::post('/{portal}/organization/store', 'Business\CRMController@organizationStore')->name('business.organization.store');
Route::get('/{portal}/organization/show/{organization_id}', 'Business\CRMController@organizationShow')->name('business.organization.show');
Route::post('/{portal}/organization/update/{organization_id}', 'Business\CRMController@organizationUpdate')->name('business.organization.update');
Route::get('/{portal}/organization/delete/{organization_id}', 'Business\CRMController@organizationDelete')->name('business.organization.delete');
Route::get('/{portal}/organization/restore/{organization_id}', 'Business\CRMController@organizationRestore')->name('business.organization.restore');

Route::get('/{portal}/organization/contact/create/{organization_id}', 'Business\CRMController@organizationContactCreate')->name('business.organization.contact.create');
Route::get('/{portal}/organization/deal/create/{organization_id}', 'Business\CRMController@organizationDealCreate')->name('business.organization.deal.create');





//Products
Route::get('/{portal}/product/groups', 'Business\ProductController@productGroups')->name('business.product.groups');
Route::get('/{portal}/product/group/create', 'Business\ProductController@productGroupCreate')->name('business.product.group.create');
Route::post('/{portal}/product/group/store', 'Business\ProductController@productGroupStore')->name('business.product.group.store');
Route::get('/{portal}/product/group/show/{product_group_id}', 'Business\ProductController@productGroupShow')->name('business.product.group.show');
Route::get('/{portal}/product/group/edit/{product_group_id}', 'Business\ProductController@productGroupEdit')->name('business.product.group.edit');
Route::post('/{portal}/product/group/update/{product_group_id}', 'Business\ProductController@productGroupUpdate')->name('business.product.group.update');
Route::get('/{portal}/product/group/delete/{product_group_id}', 'Business\ProductController@productGroupDelete')->name('business.product.group.delete');
Route::get('/{portal}/product/group/restore/{product_group_id}', 'Business\ProductController@productGroupRestore')->name('business.product.group.deleterestore');

Route::get('/{portal}/products', 'Business\ProductController@products')->name('business.products');
Route::get('/{portal}/product/create', 'Business\ProductController@productCreate')->name('business.product.create');
Route::post('/{portal}/product/store', 'Business\ProductController@productStore')->name('business.product.store');
Route::get('/{portal}/product/show/{product_id}', 'Business\ProductController@productShow')->name('business.product.show');
Route::get('/{portal}/product/edit/{product_id}', 'Business\ProductController@productEdit')->name('business.product.edit');
Route::post('/{portal}/product/update/{product_id}', 'Business\ProductController@productUpdate')->name('business.product.update');
Route::get('/{portal}/product/delete/{product_id}', 'Business\ProductController@productDelete')->name('business.product.delete');
Route::get('/{portal}/product/restore/{product_id}', 'Business\ProductController@productRestore')->name('business.product.restore');

Route::post('/{portal}/product/image/upload/{product_id}', 'Business\ProductController@productImageUpload')->name('business.product.image.upload');
Route::get('/{portal}/product/image/delete/{product_id}', 'Business\ProductController@productImageDelete')->name('business.product.image.delete');

Route::post('/{portal}/product/discount/store/{product_id}', 'Business\ProductController@productDiscountStore')->name('business.product.discount.store');
Route::post('/{portal}/product/discount/update/{product_id}', 'Business\ProductController@productDiscountUpdate')->name('business.product.discount.update');
Route::get('/{portal}/product/discount/delete/{product_id}', 'Business\ProductController@productDiscountDelete')->name('business.product.discount.delete');

Route::get('/{portal}/composite/products', 'Business\ProductController@compositeProducts')->name('business.composite.products');
Route::get('/{portal}/composite/product/create', 'Business\ProductController@compositeProductCreate')->name('business.composite.product.create');
Route::post('/{portal}/composite/product/store', 'Business\ProductController@compositeProductStore')->name('business.composite.product.store');
Route::get('/{portal}/composite/product/show/{composite_product_id}', 'Business\ProductController@compositeProductShow')->name('business.composite.product.show');
Route::get('/{portal}/composite/product/edit/{composite_product_id}', 'Business\ProductController@compositeProductEdit')->name('business.composite.product.edit');
Route::post('/{portal}/composite/product/update/{composite_product_id}', 'Business\ProductController@compositeProductUpdate')->name('business.composite.product.update');
Route::get('/{portal}/composite/product/delete/{composite_product_id}', 'Business\ProductController@compositeProductDelete')->name('business.composite.product.delete');
Route::get('/{portal}/composite/product/restore/{composite_product_id}', 'Business\ProductController@compositeProductDelete')->name('business.composite.product.delete');


//Inventory
Route::get('/{portal}/inventory/adjustments', 'Business\InventoryController@inventoryAdjustments')->name('business.inventory.adjustments');
Route::get('/{portal}/inventory/adjustment/create', 'Business\InventoryController@inventoryAdjustmentCreate')->name('business.inventory.adjustment.create');
Route::post('/{portal}/inventory/adjustment/store', 'Business\InventoryController@inventoryAdjustmentStore')->name('business.inventory.adjustment.store');
Route::get('/{portal}/inventory/adjustment/show/{inventory_adjustment_id}', 'Business\InventoryController@inventoryAdjustmentShow')->name('business.inventory.adjustment.show');
Route::get('/{portal}/inventory/adjustment/edit/{inventory_adjustment_id}', 'Business\InventoryController@inventoryAdjustmentEdit')->name('business.inventory.adjustment.edit');
Route::post('/{portal}/inventory/adjustment/update/{inventory_adjustment_id}', 'Business\InventoryController@inventoryAdjustmentUpdate')->name('business.inventory.adjustment.update');
Route::get('/{portal}/inventory/adjustment/delete/{inventory_adjustment_id}', 'Business\InventoryController@inventoryAdjustmentDelete')->name('business.inventory.adjustment.delete');
Route::get('/{portal}/inventory/adjustment/restore/{inventory_adjustment_id}', 'Business\InventoryController@inventoryAdjustmentRestore')->name('business.inventory.adjustment.restore');

Route::get('/{portal}/transfer/orders', 'Business\InventoryController@transferOrders')->name('business.transfer.orders');
Route::get('/{portal}/transfer/order/create', 'Business\InventoryController@transferOrderCreate')->name('business.transfer.order.create');
Route::post('/{portal}/transfer/order/store', 'Business\InventoryController@transferOrderStore')->name('business.transfer.order.store');
Route::get('/{portal}/transfer/order/show/{transfer_order_id}', 'Business\InventoryController@transferOrderShow')->name('business.transfer.order.show');
Route::get('/{portal}/transfer/order/edit/{transfer_order_id}', 'Business\InventoryController@transferOrderEdit')->name('business.transfer.order.edit');
Route::post('/{portal}/transfer/order/update/{transfer_order_id}', 'Business\InventoryController@transferOrderUpdate')->name('business.transfer.order.update');
Route::get('/{portal}/transfer/order/delete/{transfer_order_id}', 'Business\InventoryController@transferOrderDelete')->name('business.transfer.order.delete');
Route::get('/{portal}/transfer/order/restore/{transfer_order_id}', 'Business\InventoryController@transferOrderRestore')->name('business.transfer.order.restore');

Route::get('/{portal}/warehouses', 'Business\InventoryController@warehouses')->name('business.warehouses');
Route::post('/{portal}/warehouse/store', 'Business\InventoryController@warehouseStore')->name('business.warehouse.store');
Route::get('/{portal}/warehouse/show/{warehouse_id}', 'Business\InventoryController@warehouseShow')->name('business.warehouse.show');
Route::get('/{portal}/warehouse/edit/{warehouse_id}', 'Business\InventoryController@warehouseEdit')->name('business.warehouse.edit');
Route::post('/{portal}/warehouse/update/{warehouse_id}', 'Business\InventoryController@warehouseUpdate')->name('business.warehouse.update');
Route::get('/{portal}/warehouse/delete/{warehouse_id}', 'Business\InventoryController@warehouseDelete')->name('business.warehouse.delete');
Route::get('/{portal}/warehouse/restore/{warehouse_id}', 'Business\InventoryController@warehouseRestore')->name('business.warehouse.restore');


// estimates
Route::get('/{portal}/estimates', 'Business\SaleController@estimates')->name('business.estimates');
Route::get('/{portal}/estimate/create', 'Business\SaleController@estimateCreate')->name('business.estimate.create');
Route::post('/{portal}/estimate/store', 'Business\SaleController@estimateStore')->name('business.estimate.store');
Route::get('/{portal}/estimate/show/{estimate_id}', 'Business\SaleController@estimateShow')->name('business.estimate.show');
Route::get('/{portal}/estimate/edit/{estimate_id}', 'Business\SaleController@estimateEdit')->name('business.estimate.edit');
Route::post('/{portal}/estimate/update/{estimate_id}', 'Business\SaleController@estimateUpdate')->name('business.estimate.update');
Route::get('/{portal}/estimate/delete/{estimate_id}', 'Business\SaleController@estimateDelete')->name('business.estimate.delete');
Route::get('/{portal}/estimate/restore/{estimate_id}', 'Business\SaleController@estimateRestore')->name('business.estimate.restore');
Route::get('/{portal}/estimate/print/{estimate_id}', 'Business\SaleController@estimatePrint')->name('business.estimate.print');
Route::get('/{portal}/estimate/compose/{estimate_id}', 'Business\SaleController@estimateCompose')->name('business.estimate.compose');
Route::post('/{portal}/estimate/send/{estimate_id}', 'Business\SaleController@estimateSend')->name('business.estimate.send');
// estimate product
Route::get('/{portal}/estimate/convert/to/invoice/{estimate_id}', 'Business\SaleController@estimateConvertToInvoice')->name('business.estimate.convert.to.invoice');
Route::get('/{portal}/estimate/product/delete/{estimate_product_id}', 'Business\SaleController@estimateProductDelete')->name('business.estimate.product.delete');

// invoices
Route::get('/{portal}/invoices', 'Business\SaleController@invoices')->name('business.invoices');
Route::get('/{portal}/invoice/create', 'Business\SaleController@invoiceCreate')->name('business.invoice.create');
Route::post('/{portal}/invoice/store', 'Business\SaleController@invoiceStore')->name('business.invoice.store');
Route::get('/{portal}/invoice/show/{invoice_id}', 'Business\SaleController@invoiceShow')->name('business.invoice.show');
Route::get('/{portal}/invoice/edit/{invoice_id}', 'Business\SaleController@invoiceEdit')->name('business.invoice.edit');
Route::post('/{portal}/invoice/update/{invoice_id}', 'Business\SaleController@invoiceUpdate')->name('business.invoice.update');
Route::get('/{portal}/invoice/delete/{invoice_id}', 'Business\SaleController@invoiceDelete')->name('business.invoice.delete');
Route::get('/{portal}/invoice/restore/{invoice_id}', 'Business\SaleController@invoiceRestore')->name('business.invoice.restore');
Route::get('/{portal}/invoice/print/{invoice_id}', 'Business\SaleController@invoicePrint')->name('business.invoice.print');
Route::get('/{portal}/invoice/compose/{invoice_id}', 'Business\SaleController@invoiceCompose')->name('business.invoice.compose');
Route::post('/{portal}/invoice/send/{invoice_id}', 'Business\SaleController@invoiceSend')->name('business.invoice.send');

Route::get('/{portal}/invoice/convert/to/sale/{estimate_id}', 'Business\SaleController@invoiceConvertToSale')->name('business.invoice.convert.to.sale');
Route::get('/{portal}/invoice/product/delete/{invoice_product_id}', 'Business\SaleController@invoiceProductDelete')->name('business.invoice.product.delete');


// sales
Route::get('/{portal}/sales', 'Business\SaleController@sales')->name('business.sales');
Route::get('/{portal}/sale/create', 'Business\SaleController@saleCreate')->name('business.sale.create');
Route::post('/{portal}/sale/store', 'Business\SaleController@saleStore')->name('business.sale.store');
Route::get('/{portal}/sale/show/{sale_id}', 'Business\SaleController@saleShow')->name('business.sale.show');
Route::get('/{portal}/sale/edit/{sale_id}', 'Business\SaleController@saleEdit')->name('business.sale.edit');
Route::get('/{portal}/sale/update/{sale_id}', 'Business\SaleController@saleUpdate')->name('business.sale.update');
Route::get('/{portal}/sale/delete/{sale_id}', 'Business\SaleController@saleDelete')->name('business.sale.delete');
Route::get('/{portal}/sale/restore/{sale_id}', 'Business\SaleController@saleRestore')->name('business.sale.restore');
Route::get('/{portal}/sale/print/{sale_id}', 'Business\SaleController@salePrint')->name('business.sale.print');
Route::get('/{portal}/sale/compose/{sale_id}', 'Business\SaleController@saleCompose')->name('business.sale.compose');
Route::post('/{portal}/sale/send/{sale_id}', 'Business\SaleController@saleSend')->name('business.sale.send');

Route::get('/{portal}/sale/payment/create/{sale_id}', 'Business\SaleController@salePaymentCreate')->name('business.sale.payment.create');
Route::get('/{portal}/sale/product/delete/{invoice_product_id}', 'Business\SaleController@saleProductDelete')->name('business.sale.product.delete');
Route::post('/{portal}/sale/record/payment/{sale_id}', 'Business\SaleController@saleRecordPayment')->name('business.sale.record.payment');
Route::post('/{portal}/sale/record/payment/refund/{payment_received_id}', 'Business\SaleController@saleRecordPaymentRefund')->name('business.sale.record.payment.refund');
Route::get('/{portal}/payments/received', 'Business\SaleController@paymentsReceived')->name('business.payments.received');


// invoices
Route::get('/{portal}/orders', 'Business\SaleController@orders')->name('business.orders');
Route::get('/{portal}/order/show/{order_id}', 'Business\SaleController@orderShow')->name('business.order.show');
Route::get('/{portal}/order/edit/{order_id}', 'Business\SaleController@orderEdit')->name('business.order.edit');
Route::post('/{portal}/order/update/{order_id}', 'Business\SaleController@orderUpdate')->name('business.order.update');
Route::get('/{portal}/order/delete/{order_id}', 'Business\SaleController@orderDelete')->name('business.order.delete');
Route::get('/{portal}/order/restore/{order_id}', 'Business\SaleController@orderRestore')->name('business.order.restore');
Route::get('/{portal}/order/print/{order_id}', 'Business\SaleController@orderPrint')->name('business.order.print');
Route::get('/{portal}/order/compose/{order_id}', 'Business\SaleController@orderCompose')->name('business.order.compose');
Route::post('/{portal}/order/send/{order_id}', 'Business\SaleController@orderSend')->name('business.order.send');


// Accounting
// accounts
Route::get('/{portal}/accounts', 'Business\AccountController@accounts')->name('business.accounts');
Route::get('/{portal}/account/create', 'Business\AccountController@accountCreate')->name('business.account.create');
Route::post('/{portal}/account/store', 'Business\AccountController@accountStore')->name('business.account.store');
Route::get('/{portal}/account/show/{account_id}', 'Business\AccountController@accountShow')->name('business.account.show');
Route::get('/{portal}/account/edit/{account_id}', 'Business\AccountController@accountEdit')->name('business.account.edit');
Route::post('/{portal}/account/update/{account_id}', 'Business\AccountController@accountUpdate')->name('business.account.update');
Route::get('/{portal}/account/delete/{account_id}', 'Business\AccountController@accountDelete')->name('business.account.delete');
Route::get('/{portal}/account/restore/{account_id}', 'Business\AccountController@accountRestore')->name('business.account.restore');

Route::get('/{portal}/account/deposit/create/{account_id}', 'Business\AccountController@accountDepositCreate')->name('business.account.deposit.create');
Route::get('/{portal}/account/liability/create/{account_id}', 'Business\AccountController@accountLiabilityCreate')->name('business.account.liability.create');
Route::get('/{portal}/account/loan/create/{account_id}', 'Business\AccountController@accountLoanCreate')->name('business.account.loan.create');
Route::get('/{portal}/account/withdrawal/create/{account_id}', 'Business\AccountController@accountWithdrawalCreate')->name('business.account.withdrawal.create');


// deposits
Route::post('/{portal}/deposit/store', 'Business\AccountController@depositStore')->name('business.deposit.store');
Route::get('/{portal}/deposit/show/{deposit_id}', 'Business\AccountController@depositShow')->name('business.deposit.show');
Route::post('/{portal}/deposit/update/{deposit_id}', 'Business\AccountController@depositUpdate')->name('business.deposit.update');
Route::get('/{portal}/deposit/delete/{deposit_id}', 'Business\AccountController@depositDelete')->name('business.deposit.delete');
Route::get('/{portal}/deposit/restore/{deposit_id}', 'Business\AccountController@depositRestore')->name('business.deposit.restore');

Route::get('/{portal}/deposit/account/adjustment/create/{deposit_id}', 'Business\AccountController@depositAccountAdjustmentCreate')->name('business.deposit.account.adjustment.create');


// withdrawals
Route::post('/{portal}/withdrawal/store', 'Business\AccountController@withdrawalStore')->name('business.withdrawal.store');
Route::get('/{portal}/withdrawal/show/{withdrawal_id}', 'Business\AccountController@withdrawalShow')->name('business.withdrawal.show');
Route::post('/{portal}/withdrawal/update/{withdrawal_id}', 'Business\AccountController@withdrawalUpdate')->name('business.withdrawal.update');
Route::get('/{portal}/withdrawal/delete/{withdrawal_id}', 'Business\AccountController@withdrawalDelete')->name('business.withdrawal.delete');
Route::get('/{portal}/withdrawal/restore/{withdrawal_id}', 'Business\AccountController@withdrawalRestore')->name('business.withdrawal.restore');

Route::get('/{portal}/withdrawal/account/adjustment/create/{withdrawal_id}', 'Business\AccountController@withdrawalAccountAdjustmentCreate')->name('business.withdrawal.account.adjustment.create');


// account adjustment
Route::get('/{portal}/account/adjustment/create/{account_id}', 'Business\AccountController@accountAdjustmentCreate')->name('business.account.adjustment.create');
Route::post('/{portal}/account/adjustment/store', 'Business\AccountController@accountAdjustmentStore')->name('business.account.adjustment.store');
Route::get('/{portal}/account/adjustment/edit/{account_id}', 'Business\AccountController@accountAdjustmentEdit')->name('business.account.adjustment.edit');
Route::post('/{portal}/account/adjustment/update/{account_id}', 'Business\AccountController@accountAdjustmentUpdate')->name('business.account.adjustment.update');
Route::get('/{portal}/account/adjustment/delete/{account_id}', 'Business\AccountController@accountAdjustmentDelete')->name('business.account.adjustment.delete');
Route::get('/{portal}/account/adjustment/restore/{account_id}', 'Business\AccountController@accountAdjustmentRestore')->name('business.account.adjustment.restore');


// expenses
Route::get('/{portal}/expenses', 'Business\ExpenseController@expenses')->name('business.expenses');
Route::get('/{portal}/expense/create', 'Business\ExpenseController@expenseCreate')->name('business.expense.create');
Route::post('/{portal}/expense/store', 'Business\ExpenseController@expenseStore')->name('business.expense.store');
Route::get('/{portal}/expense/show/{expense_id}', 'Business\ExpenseController@expenseShow')->name('business.expense.show');
Route::get('/{portal}/expense/edit/{expense_id}', 'Business\ExpenseController@expenseEdit')->name('business.expense.edit');
Route::post('/{portal}/expense/update/{expense_id}', 'Business\ExpenseController@expenseUpdate')->name('business.expense.update');
Route::get('/{portal}/expense/delete/{expense_id}', 'Business\ExpenseController@expenseDelete')->name('business.expense.delete');
Route::get('/{portal}/expense/restore/{expense_id}', 'Business\ExpenseController@expenseRestore')->name('business.expense.restore');

Route::get('/{portal}/expense/product/delete/{expense_id}', 'Business\ExpenseController@expenseProductDelete')->name('business.expense.product.delete');
Route::get('/{portal}/expense/product/restore/{expense_id}', 'Business\ExpenseController@expenseProductRestore')->name('business.expense.product.restore');


// liabilities
Route::get('/{portal}/liabilities', 'Business\AccountController@liabilities')->name('business.liabilities');
Route::get('/{portal}/liability/create', 'Business\AccountController@liabilityCreate')->name('business.liability.create');
Route::post('/{portal}/liability/store', 'Business\AccountController@liabilityStore')->name('business.liability.store');
Route::get('/{portal}/liability/show/{liability_id}', 'Business\AccountController@liabilityShow')->name('business.liability.show');
Route::get('/{portal}/liability/edit/{liability_id}', 'Business\AccountController@liabilityEdit')->name('business.liability.edit');
Route::post('/{portal}/liability/update/{liability_id}', 'Business\AccountController@liabilityUpdate')->name('business.liability.update');
Route::get('/{portal}/liability/delete/{liability_id}', 'Business\AccountController@liabilityDelete')->name('business.liability.delete');
Route::get('/{portal}/liability/restore/{liability_id}', 'Business\AccountController@liabilityRestore')->name('business.liability.restore');

Route::get('/{portal}/liability/expense/create/{liability_id}', 'Business\AccountController@liabilityExpenseCreate')->name('business.liability.expense.create');



// loans
Route::get('/{portal}/loans', 'Business\AccountController@loans')->name('business.loans');
Route::get('/{portal}/loan/create', 'Business\AccountController@loanCreate')->name('business.loan.create');
Route::post('/{portal}/loan/store', 'Business\AccountController@loanStore')->name('business.loan.store');
Route::get('/{portal}/loan/show/{loan_id}', 'Business\AccountController@loanShow')->name('business.loan.show');
Route::get('/{portal}/loan/edit/{loan_id}', 'Business\AccountController@loanEdit')->name('business.loan.edit');
Route::post('/{portal}/loan/update/{loan_id}', 'Business\AccountController@loanUpdate')->name('business.loan.update');
Route::get('/{portal}/loan/delete/{loan_id}', 'Business\AccountController@loanDelete')->name('business.loan.delete');
Route::get('/{portal}/loan/restore/{loan_id}', 'Business\AccountController@loanRestore')->name('business.loan.restore');

Route::get('/{portal}/loan/payment/create/{loan_id}', 'Business\AccountController@loanPaymentCreate')->name('business.loan.payment.create');



// payments
Route::get('/{portal}/payments', 'Business\ExpenseController@payments')->name('business.payments');
Route::get('/{portal}/payment/create', 'Business\ExpenseController@paymentCreate')->name('business.payment.create');
Route::post('/{portal}/payment/store', 'Business\ExpenseController@paymentStore')->name('business.payment.store');
Route::get('/{portal}/payment/show/{payment_id}', 'Business\ExpenseController@paymentShow')->name('business.payment.show');
Route::get('/{portal}/payment/delete/{payment_id}', 'Business\ExpenseController@paymentDelete')->name('business.payment.delete');
Route::get('/{portal}/payment/restore/{payment_id}', 'Business\ExpenseController@paymentRestore')->name('business.payment.restore');

Route::get('/{portal}/payment/{payment_id}/refund/create', 'Business\ExpenseController@refundCreate')->name('business.payment.refund.create');



// refunds
Route::get('/{portal}/refunds', 'Business\ExpenseController@refunds')->name('business.refunds');
Route::post('/{portal}/refund/store', 'Business\ExpenseController@refundStore')->name('business.refund.store');
Route::get('/{portal}/refund/show/{refund_id}', 'Business\ExpenseController@refundShow')->name('business.refund.show');
Route::get('/{portal}/refund/edit/{refund_id}', 'Business\ExpenseController@refundEdit')->name('business.refund.edit');
Route::post('/{portal}/refund/update/{refund_id}', 'Business\ExpenseController@refundUpdate')->name('business.refund.update');
Route::get('/{portal}/refund/delete/{refund_id}', 'Business\ExpenseController@refundDelete')->name('business.refund.delete');
Route::get('/{portal}/refund/restore/{refund_id}', 'Business\ExpenseController@refundRestore')->name('business.refund.restore');


// transactions
Route::get('/{portal}/transactions', 'Business\ExpenseController@transactions')->name('business.transactions');
Route::get('/{portal}/transaction/create/{expense_id}', 'Business\ExpenseController@transactionCreate')->name('business.transaction.create');
Route::post('/{portal}/transaction/store', 'Business\ExpenseController@transactionStore')->name('business.transaction.store');
Route::get('/{portal}/transaction/show/{transaction_id}', 'Business\ExpenseController@transactionShow')->name('business.transaction.show');
Route::get('/{portal}/transaction/edit/{transaction_id}', 'Business\ExpenseController@transactionEdit')->name('business.transaction.edit');
Route::post('/{portal}/transaction/update/{transaction_id}', 'Business\ExpenseController@transactionUpdate')->name('business.transaction.update');
Route::get('/{portal}/transaction/delete/{transaction_id}', 'Business\ExpenseController@transactionDelete')->name('business.transaction.delete');
Route::get('/{portal}/transaction/restore/{transaction_id}', 'Business\ExpenseController@transactionRestore')->name('business.transaction.restore');

Route::get('/{portal}/transaction/billed/{transaction_id}', 'Business\ExpenseController@transactionBilled')->name('business.transaction.billed');
Route::get('/{portal}/transaction/pending/payment/{transaction_id}', 'Business\ExpenseController@transactionPendingPayment')->name('business.transaction.pending.payment');


// transfers
Route::get('/{portal}/transfers', 'Business\AccountController@transfers')->name('business.transfers');
Route::get('/{portal}/transfer/create', 'Business\AccountController@transferCreate')->name('business.transfer.create');
Route::post('/{portal}/transfer/store', 'Business\AccountController@transferStore')->name('business.transfer.store');
Route::get('/{portal}/transfer/show/{transfer_id}', 'Business\AccountController@transferShow')->name('business.transfer.show');
Route::get('/{portal}/transfer/edit/{transfer_id}', 'Business\AccountController@transferEdit')->name('business.transfer.edit');
Route::post('/{portal}/transfer/update/{transfer_id}', 'Business\AccountController@transferUpdate')->name('business.transfer.update');
Route::get('/{portal}/transfer/delete/{transfer_id}', 'Business\AccountController@transferDelete')->name('business.transfer.delete');
Route::get('/{portal}/transfer/restore/{transfer_id}', 'Business\AccountController@transferRestore')->name('business.transfer.restore');

Route::get('/{portal}/transfer/expense/create/{transfer_id}', 'Business\AccountController@transferExpenseCreate')->name('business.transfer.expense.create');





// Assets
Route::get('/{portal}/assets', 'Business\AssetController@assets')->name('business.assets');
Route::get('/{portal}/asset/create', 'Business\AssetController@assetCreate')->name('business.asset.create');
Route::get('/{portal}/asset/store', 'Business\AssetController@assetStore')->name('business.asset.store');
Route::get('/{portal}/asset/show/{asset_id}', 'Business\AssetController@assetShow')->name('business.asset.show');
Route::get('/{portal}/asset/edit/{asset_id}', 'Business\AssetController@assetEdit')->name('business.asset.edit');
Route::get('/{portal}/asset/update/{asset_id}', 'Business\AssetController@assetUpdate')->name('business.asset.update');
Route::get('/{portal}/asset/delete/{asset_id}', 'Business\AssetController@assetDelete')->name('business.asset.delete');


// Projects
Route::get('/{portal}/projects/feed', 'Business\ProjectController@projectsFeed')->name('business.projects.feed');
Route::get('/{portal}/projects', 'Business\ProjectController@projects')->name('business.projects');
Route::get('/{portal}/project/create', 'Business\ProjectController@projectCreate')->name('business.project.create');
Route::post('/{portal}/project/store', 'Business\ProjectController@projectStore')->name('business.project.store');
Route::get('/{portal}/project/show/{project_id}', 'Business\ProjectController@projectShow')->name('business.project.show');
Route::get('/{portal}/project/update/{project_id}', 'Business\ProjectController@projectUpdate')->name('business.project.edit');
Route::get('/{portal}/project/edit/{project_id}', 'Business\ProjectController@projectEdit')->name('business.project.edit');
Route::get('/{portal}/project/delete/{employee_id}', 'Business\ProjectController@employeeDelete')->name('business.project.delete');


// Human Resource
Route::get('/{portal}/employees', 'Business\EmployeeController@employees')->name('business.employees');
Route::get('/{portal}/employee/create', 'Business\EmployeeController@employeeCreate')->name('business.employee.create');
Route::post('/{portal}/employee/store', 'Business\EmployeeController@employeeStore')->name('business.employee.store');
Route::get('/{portal}/employee/show/{employee_id}', 'Business\EmployeeController@employeeShow')->name('business.employee.show');
Route::get('/{portal}/employee/update/{employee_id}', 'Business\EmployeeController@employeeUpdate')->name('business.employee.edit');
Route::get('/{portal}/employee/edit/{employee_id}', 'Business\EmployeeController@employeeEdit')->name('business.employee.edit');
Route::get('/{portal}/employee/delete/{employee_id}', 'Business\EmployeeController@employeeDelete')->name('business.employee.delete');

Route::get('/{portal}/leave', 'Business\EmployeeController@leave')->name('business.leave');
Route::get('/{portal}/leave/create', 'Business\EmployeeController@leaveCreate')->name('business.leave.create');
Route::post('/{portal}/leave/store', 'Business\EmployeeController@leaveStore')->name('business.leave.store');
Route::get('/{portal}/leave/show/{leave_id}', 'Business\EmployeeController@leaveShow')->name('business.leave.show');
Route::get('/{portal}/leave/update/{leave_id}', 'Business\EmployeeController@leaveUpdate')->name('business.leave.edit');
Route::get('/{portal}/leave/edit/{leave_id}', 'Business\EmployeeController@leaveEdit')->name('business.leave.edit');
Route::get('/{portal}/leave/delete/{leave_id}', 'Business\EmployeeController@leaveDelete')->name('business.leave.delete');

Route::get('/{portal}/payroll', 'Business\EmployeeController@payroll')->name('business.payroll');
Route::get('/{portal}/payroll/history', 'Business\EmployeeController@payrollHistory')->name('business.payroll.history');
Route::get('/{portal}/payroll/history/{employee_id}', 'Business\EmployeeController@employeePayrollHistory')->name('business.employee.payroll.history');
Route::get('/{portal}/payroll/annual/salary/statement', 'Business\EmployeeController@payrollAnnualSalaryStatement')->name('business.payroll.annual.salary.statement');
Route::get('/{portal}/payroll/process', 'Business\EmployeeController@payrollProcess')->name('business.payroll.process');
Route::post('/{portal}/payroll/process/payment', 'Business\EmployeeController@payrollProcessPayment')->name('business.payroll.process.payment');
Route::get('/{portal}/payroll/salary/adjustment/{employee_id}', 'Business\EmployeeController@payrollSalaryAdjustment')->name('business.payroll.salary.adjustment');

Route::post('/{portal}/variable/pay/store', 'Business\EmployeeController@variablePayStore')->name('business.variable.pay.store');
Route::get('/{portal}/variable/pay/update/{variable_pay_id}', 'Business\EmployeeController@variablePayUpdate')->name('business.variable.pay.update');
Route::get('/{portal}/variable/pay/delete/{variable_pay_id}', 'Business\EmployeeController@variablePayDelete')->name('business.variable.pay.delete');

Route::post('/{portal}/variable/deduction/store', 'Business\EmployeeController@variableDeductionStore')->name('business.variable.deduction.store');
Route::get('/{portal}/variable/deduction/update/{variable_deduction_id}', 'Business\EmployeeController@variableDeductionUpdate')->name('business.variable.deduction.update');
Route::get('/{portal}/variable/deduction/delete/{variable_deduction_id}', 'Business\EmployeeController@variableDeductionDelete')->name('business.variable.deduction.delete');

Route::post('/{portal}/bonus/store', 'Business\EmployeeController@bonusStore')->name('business.bonus.store');
Route::get('/{portal}/bonus/update/{bonus_id}', 'Business\EmployeeController@bonusUpdate')->name('business.bonus.update');
Route::get('/{portal}/bonus/delete/{bonus_id}', 'Business\EmployeeController@bonusDelete')->name('business.bonus.delete');

Route::post('/{portal}/statutory/contribution/store', 'Business\EmployeeController@statutoryContributionStore')->name('business.statutory.contribution.store');
Route::get('/{portal}/statutory/contribution/update/{variable_deduction_id}', 'Business\EmployeeController@statutoryContributionUpdate')->name('business.statutory.contribution.update');
Route::get('/{portal}/statutory/contribution/delete/{variable_deduction_id}', 'Business\EmployeeController@statutoryContributionDelete')->name('business.statutory.contribution.delete');

Route::get('/{portal}/employer', 'Business\EmployeeController@employer')->name('business.employer');

Route::get('/{portal}/human/resource/settings', 'Business\EmployeeController@humanResourceSettings')->name('business.human.resource.settings');

Route::get('/{portal}/workdays/update', 'Business\EmployeeController@workdaysUpdate')->name('business.workdays.update');

Route::get('/{portal}/holiday/store', 'Business\EmployeeController@holidayStore')->name('business.holiday.store');
Route::get('/{portal}/holiday/update/{holiday_id}', 'Business\EmployeeController@holidayUpdate')->name('business.holiday.update');
Route::get('/{portal}/holiday/delete/{holiday_id}', 'Business\EmployeeController@holidayDelete')->name('business.holiday.delete');

Route::get('/{portal}/leave/type/store', 'Business\EmployeeController@leaveTypeStore')->name('business.leave.type.store');
Route::get('/{portal}/leave/type/update/{holiday_id}', 'Business\EmployeeController@leaveTypeUpdate')->name('business.leave.type.update');
Route::get('/{portal}/leave/type/delete/{holiday_id}', 'Business\EmployeeController@leaveTypeDelete')->name('business.leave.type.delete');

Route::get('/{portal}/earning/policy/store', 'Business\EmployeeController@earningPolicyStore')->name('business.earning.policy.store');
Route::get('/{portal}/earning/policy/update/{holiday_id}', 'Business\EmployeeController@earningPolicyUpdate')->name('business.earning.policy.update');
Route::get('/{portal}/earning/policy/delete/{holiday_id}', 'Business\EmployeeController@earningPolicyDelete')->name('business.earning.policy.delete');

// Settings
Route::get('/{portal}/organization/profile', 'Business\SettingController@organizationProfile')->name('business.organization.profile');
Route::get('/{portal}/opening/balances', 'Business\SettingController@openingBalances')->name('business.opening.balances');
Route::get('/{portal}/users/roles', 'Business\SettingController@usersAndRoles')->name('business.users.roles');
Route::get('/{portal}/currencies', 'Business\SettingController@currencies')->name('business.currencies');
Route::get('/{portal}/emails', 'Business\SettingController@emails')->name('business.emails');
Route::get('/{portal}/reminders', 'Business\SettingController@reminders')->name('business.reminders');

// settings
Route::get('/{portal}/settings', 'Business\SettingController@settings')->name('business.settings');

// Brands
Route::get('/{portal}/brands', 'Business\SettingController@brands')->name('business.brands');
Route::get('/{portal}/brand/create', 'Business\SettingController@brandCreate')->name('business.brand.create');
Route::post('/{portal}/brand/store', 'Business\SettingController@brandStore')->name('business.brand.store');
Route::get('/{portal}/brand/show/{brand_id}', 'Business\SettingController@brandShow')->name('business.brand.show');
Route::post('/{portal}/brand/update/{brand_id}', 'Business\SettingController@brandUpdate')->name('business.brand.update');
Route::get('/{portal}/brand/delete/{brand_id}', 'Business\SettingController@brandDelete')->name('business.brand.delete');
Route::get('/{portal}/brand/restore/{brand_id}', 'Business\SettingController@brandRestore')->name('business.brand.restore');

// Campaign types
Route::get('/{portal}/campaign/types', 'Business\SettingController@campaignTypes')->name('business.campaign.types');
Route::get('/{portal}/campaign/type/create', 'Business\SettingController@campaignTypeCreate')->name('business.campaign.type.create');
Route::post('/{portal}/campaign/type/store', 'Business\SettingController@campaignTypeStore')->name('business.campaign.type.store');
Route::get('/{portal}/campaign/type/show/{campaign_type_id}', 'Business\SettingController@campaignTypeShow')->name('business.campaign.type.show');
Route::post('/{portal}/campaign/type/update/{campaign_type_id}', 'Business\SettingController@campaignTypeUpdate')->name('business.campaign.type.update');
Route::get('/{portal}/campaign/type/delete/{campaign_type_id}', 'Business\SettingController@campaignTypeDelete')->name('business.campaign.type.delete');
Route::get('/{portal}/campaign/type/restore/{campaign_type_id}', 'Business\SettingController@campaignTypeRestore')->name('business.campaign.type.restore');

Route::get('/{portal}/campaign/type/{campaign_type_id}/campaign/create', 'Business\SettingController@campaignTypeCampaignCreate')->name('business.campaign.type.campaign.create');

// Contact types
Route::get('/{portal}/contact/types', 'Business\SettingController@contactTypes')->name('business.contact.types');
Route::get('/{portal}/contact/type/create', 'Business\SettingController@contactTypeCreate')->name('business.contact.type.create');
Route::post('/{portal}/contact/type/store', 'Business\SettingController@contactTypeStore')->name('business.contact.type.store');
Route::get('/{portal}/contact/type/show/{contact_type_id}', 'Business\SettingController@contactTypeShow')->name('business.contact.type.show');
Route::get('/{portal}/contact/type/contact/create/{contact_type_id}', 'Business\SettingController@contactTypeContactCreate')->name('business.contact.type.contact.create');
Route::post('/{portal}/contact/type/update/{contact_type_id}', 'Business\SettingController@contactTypeUpdate')->name('business.contact.type.update');
Route::get('/{portal}/contact/type/delete/{contact_type_id}', 'Business\SettingController@contactTypeDelete')->name('business.contact.type.delete');
Route::get('/{portal}/contact/type/restore/{contact_type_id}', 'Business\SettingController@contactTypeRestore')->name('business.contact.type.restore');


// Frequencies
Route::get('/{portal}/frequencies', 'Business\SettingController@frequencies')->name('business.frequencies');
Route::get('/{portal}/frequency/create', 'Business\SettingController@frequencyCreate')->name('business.frequency.create');
Route::post('/{portal}/frequency/store', 'Business\SettingController@frequencyStore')->name('business.frequency.store');
Route::get('/{portal}/frequency/show/{contact_type_id}', 'Business\SettingController@frequencyShow')->name('business.frequency.show');
Route::post('/{portal}/frequency/update/{contact_type_id}', 'Business\SettingController@frequencyUpdate')->name('business.frequency.update');
Route::get('/{portal}/frequency/delete/{contact_type_id}', 'Business\SettingController@frequencyDelete')->name('business.frequency.delete');
Route::get('/{portal}/frequency/restore/{contact_type_id}', 'Business\SettingController@frequencyRestore')->name('business.frequency.restore');


// Lead sources
Route::get('/{portal}/lead/sources', 'Business\SettingController@leadSources')->name('business.lead.sources');
Route::get('/{portal}/lead/source/create', 'Business\SettingController@leadSourceCreate')->name('business.lead.source.create');
Route::post('/{portal}/lead/source/store', 'Business\SettingController@leadSourceStore')->name('business.lead.source.store');
Route::get('/{portal}/lead/source/show/{lead_source_id}', 'Business\SettingController@leadSourceShow')->name('business.lead.source.show');
Route::get('/{portal}/lead/source/contact/create/{campaign_id}', 'Business\SettingController@leadSourceContactCreate')->name('business.lead.source.contact.create');
Route::post('/{portal}/lead/source/update/{lead_source_id}', 'Business\SettingController@leadSourceUpdate')->name('business.lead.source.update');
Route::get('/{portal}/lead/source/delete/{lead_source_id}', 'Business\SettingController@leadSourceDelete')->name('business.lead.source.delete');
Route::get('/{portal}/lead/source/restore/{lead_source_id}', 'Business\SettingController@leadSourceRestore')->name('business.lead.source.restore');


// product categories
Route::get('/{portal}/product/categories', 'Business\SettingController@productCategories')->name('business.product.categories');
Route::get('/{portal}/product/category/create', 'Business\SettingController@productCategoryCreate')->name('business.product.category.create');
Route::post('/{portal}/product/category/store', 'Business\SettingController@productCategoryStore')->name('business.product.category.store');
Route::get('/{portal}/product/category/show/{tax_id}', 'Business\SettingController@productCategoryShow')->name('business.product.category.show');
Route::post('/{portal}/product/category/update/{tax_id}', 'Business\SettingController@productCategoryUpdate')->name('business.product.category.update');
Route::get('/{portal}/product/category/delete/{tax_id}', 'Business\SettingController@productCategoryDelete')->name('business.product.category.delete');
Route::get('/{portal}/product/category/restore/{tax_id}', 'Business\SettingController@productCategoryRestore')->name('business.product.category.restore');


// product sub categories
Route::get('/{portal}/product/sub/categories', 'Business\SettingController@productSubCategories')->name('business.product.sub.categories');
Route::get('/{portal}/product/sub/category/create', 'Business\SettingController@productSubCategoryCreate')->name('business.product.sub.category.create');
Route::post('/{portal}/product/sub/category/store', 'Business\SettingController@productSubCategoryStore')->name('business.product.sub.category.store');
Route::get('/{portal}/product/sub/category/show/{tax_id}', 'Business\SettingController@productSubCategoryShow')->name('business.product.sub.category.show');
Route::post('/{portal}/product/sub/category/update/{tax_id}', 'Business\SettingController@productSubCategoryUpdate')->name('business.product.sub.category.update');
Route::get('/{portal}/product/sub/category/delete/{tax_id}', 'Business\SettingController@productSubCategoryDelete')->name('business.product.sub.category.delete');
Route::get('/{portal}/product/sub/category/restore/{tax_id}', 'Business\SettingController@productSubCategoryRestore')->name('business.product.sub.category.restore');


// taxes
Route::get('/{portal}/taxes', 'Business\SettingController@taxes')->name('business.taxes');
Route::get('/{portal}/tax/create', 'Business\SettingController@taxCreate')->name('business.tax.create');
Route::post('/{portal}/tax/store', 'Business\SettingController@taxStore')->name('business.tax.store');
Route::get('/{portal}/tax/show/{tax_id}', 'Business\SettingController@taxShow')->name('business.tax.show');
Route::post('/{portal}/tax/update/{tax_id}', 'Business\SettingController@taxUpdate')->name('business.tax.update');
Route::get('/{portal}/tax/delete/{tax_id}', 'Business\SettingController@taxDelete')->name('business.tax.delete');
Route::get('/{portal}/tax/restore/{tax_id}', 'Business\SettingController@taxRestore')->name('business.tax.restore');


// Titles
Route::get('/{portal}/titles', 'Business\SettingController@titles')->name('business.titles');
Route::get('/{portal}/title/create', 'Business\SettingController@titleCreate')->name('business.title.create');
Route::post('/{portal}/title/store', 'Business\SettingController@titleStore')->name('business.title.store');
Route::get('/{portal}/title/show/{title_id}', 'Business\SettingController@titleShow')->name('business.title.show');
Route::post('/{portal}/title/update/{title_id}', 'Business\SettingController@titleUpdate')->name('business.title.update');
Route::get('/{portal}/title/delete/{title_id}', 'Business\SettingController@titleDelete')->name('business.title.delete');
Route::get('/{portal}/title/restore/{title_id}', 'Business\SettingController@titleRestore')->name('business.title.restore');


// units
Route::get('/{portal}/units', 'Business\SettingController@units')->name('business.units');
Route::get('/{portal}/unit/create', 'Business\SettingController@unitCreate')->name('business.unit.create');
Route::post('/{portal}/unit/store', 'Business\SettingController@unitStore')->name('business.unit.store');
Route::get('/{portal}/unit/show/{unit_id}', 'Business\SettingController@unitShow')->name('business.unit.show');
Route::post('/{portal}/unit/update/{unit_id}', 'Business\SettingController@unitUpdate')->name('business.unit.update');
Route::get('/{portal}/unit/delete/{unit_id}', 'Business\SettingController@unitDelete')->name('business.unit.delete');
Route::get('/{portal}/unit/restore/{unit_id}', 'Business\SettingController@unitRestore')->name('business.unit.restore');


// roles
Route::get('/{portal}/roles', 'Business\RoleController@roles')->name('business.roles');
Route::get('/{portal}/role/create', 'Business\RoleController@roleCreate')->name('business.role.create');
Route::post('/{portal}/role/store', 'Business\RoleController@roleStore')->name('business.role.store');
Route::get('/{portal}/role/show/{role_id}', 'Business\RoleController@roleShow')->name('business.role.show');

Route::get('/{portal}/role/update/{role_id}/permission/{permission_id}', 'Business\RoleController@updateRolePermission')->name('business.role.update.permission');

Route::get('/{portal}/revoke/user/{user_id}/role/{role_id}', 'Business\RoleController@userRevokeRole')->name('business.user.revoke.role');
Route::post('/{portal}/assign/user/role/{role_id}', 'Business\RoleController@userAssignRole')->name('business.user.assign.role');

Route::post('/{portal}/role/update/{role_id}', 'Business\RoleController@roleUpdate')->name('business.role.update');
Route::get('/{portal}/role/delete/{role_id}', 'Business\RoleController@roleDelete')->name('business.role.delete');
Route::get('/{portal}/role/restore/{role_id}', 'Business\RoleController@roleRestore')->name('business.role.restore');


// roles
Route::get('/{portal}/institution', 'Business\RoleController@institutionShow')->name('business.institution');
Route::post('/{portal}/institution/update/{institution_id}', 'Business\RoleController@institutionUpdate')->name('business.institution.update');

// modules
Route::get('/{portal}/module/subscribe/{module_id}', 'Business\RoleController@moduleSubscribe')->name('business.module.subscribe');
Route::get('/{portal}/module/unsubscribe/{module_id}', 'Business\RoleController@moduleUnsubscribe')->name('business.module.unsubscribe');

// users
Route::get('/{portal}/users', 'Business\RoleController@users')->name('business.users');
Route::get('/{portal}/user/create', 'Business\RoleController@userCreate')->name('business.user.create');
Route::post('/{portal}/user/store', 'Business\RoleController@userStore')->name('business.user.store');
Route::get('/{portal}/user/show/{user_id}', 'Business\RoleController@userShow')->name('business.user.show');
Route::post('/{portal}/user/update/{user_id}', 'Business\RoleController@userUpdate')->name('business.user.update');
Route::get('/{portal}/user/delete/{user_id}', 'Business\RoleController@userDelete')->name('business.user.delete');
Route::get('/{portal}/user/restore/{user_id}', 'Business\RoleController@userRestore')->name('business.user.restore');

//Dashboard
Route::get('/{portal}/feedbacks', 'Business\FeedbackController@feedbacks')->name('business.feedback');
Route::get('/{portal}/feedback/create', 'Business\FeedbackController@feedbackCreate')->name('business.feedback.create');
Route::post('/{portal}/feedback/store', 'Business\FeedbackController@feedbackStore')->name('business.feedback.store');
Route::get('/{portal}/feedback/show/{unit_id}', 'Business\FeedbackController@feedbackShow')->name('business.feedback.show');
Route::post('/{portal}/feedback/update/{unit_id}', 'Business\FeedbackController@feedbackUpdate')->name('business.feedback.update');
Route::get('/{portal}/feedback/delete/{unit_id}', 'Business\FeedbackController@feedbackDelete')->name('business.feedback.delete');
Route::get('/{portal}/feedback/restore/{unit_id}', 'Business\FeedbackController@feedbackRestore')->name('business.feedback.restore');

// Feedback uploads
Route::get('/{portal}/feedback/uploads/{feedback_id}', 'Business\FeedbackController@feedbackUploads')->name('business.feedback.uploads');
Route::post('/{portal}/feedback/upload/store/{feedback_id}', 'Business\FeedbackController@feedbackUploadStore')->name('business.feedback.upload.store');
Route::get('/{portal}/feedback/upload/download/{upload_id}', 'Business\FeedbackController@feedbackUploadDownload')->name('business.feedback.upload.download');
