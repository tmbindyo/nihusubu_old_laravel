<?php


//Dashboard
Route::get('/dashboard', 'Business\DashboardController@dashboard')->name('business.dashboard');


//Calendar
Route::get('/calendar', 'Business\CalendarController@calendar')->name('business.calendar');
Route::post('/calendar/store', 'Business\CalendarController@calendarStore')->name('business.calendar.store');


// To Do
Route::get('/to/dos', 'Business\ToDoController@toDos')->name('business.to.dos');
Route::post('/to/do/store', 'Business\ToDoController@toDoStore')->name('business.to.do.store');
Route::post('/to/do/update/{todo_id}', 'Business\ToDoController@toDoUpdate')->name('business.to.do.update');
Route::get('/to/do/set/in/progress/{todo_id}', 'Business\ToDoController@toDoSetInProgress')->name('business.to.do.set.in.progress');
Route::get('/to/do/set/completed/{todo_id}', 'Business\ToDoController@toDoSetCompleted')->name('business.to.do.set.completed');
Route::get('/to/do/delete/{todo_id}', 'Business\ToDoController@toDoDelete')->name('business.to.do.delete');


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
Route::get('/estimate/delete/{estimate_id}', 'Business\SaleController@estimateDelete')->name('business.estimate.delete');
Route::get('/estimate/restore/{estimate_id}', 'Business\SaleController@estimateRestore')->name('business.estimate.restore');
// estimate product
Route::get('/estimate/product/delete/{estimate_product_id}', 'Business\SaleController@estimateProductDelete')->name('business.estimate.product.delete');
Route::get('/estimate/print/{estimate_id}', 'Business\SaleController@estimatePrint')->name('business.estimate.print');

Route::get('/sales', 'Business\SaleController@sales')->name('business.sales');
Route::get('/sale/create', 'Business\SaleController@saleCreate')->name('business.sale.create');
Route::post('/sale/store', 'Business\SaleController@saleStore')->name('business.sale.store');
Route::get('/sale/show/{sale_id}', 'Business\SaleController@saleShow')->name('business.sale.show');
Route::get('/sale/edit/{sale_id}', 'Business\SaleController@saleEdit')->name('business.sale.edit');
Route::get('/sale/update/{sale_id}', 'Business\SaleController@saleUpdate')->name('business.sale.update');
Route::get('/sale/delete/{sale_id}', 'Business\SaleController@saleDelete')->name('business.sale.delete');

Route::get('/orders', 'Business\SaleController@orders')->name('business.orders');
Route::get('/order/create', 'Business\SaleController@orderCreate')->name('business.order.create');
Route::post('/order/store', 'Business\SaleController@orderStore')->name('business.order.store');
Route::get('/order/show/{order_id}', 'Business\SaleController@orderShow')->name('business.order.show');
Route::get('/order/edit/{order_id}', 'Business\SaleController@orderEdit')->name('business.order.edit');
Route::post('/order/update/{order_id}', 'Business\SaleController@orderUpdate')->name('business.order.update');
Route::post('/order/delete/{order_id}', 'Business\SaleController@orderDelete')->name('business.order.delete');
Route::get('/order/print/{order_id}', 'Business\SaleController@orderPrint')->name('business.order.print');
Route::get('/order/record/payment/{order_id}', 'Business\SaleController@orderPrint')->name('business.order.record.payment');

Route::get('/invoices', 'Business\SaleController@invoices')->name('business.invoices');
Route::get('/invoice/create', 'Business\SaleController@invoiceCreate')->name('business.invoice.create');
Route::post('/invoice/store', 'Business\SaleController@invoiceStore')->name('business.invoice.store');
Route::get('/invoice/show/{invoice_id}', 'Business\SaleController@invoiceShow')->name('business.invoice.show');
Route::get('/invoice/edit/{invoice_id}', 'Business\SaleController@invoiceEdit')->name('business.invoice.edit');
Route::get('/invoice/update/{invoice_id}', 'Business\SaleController@invoiceUpdate')->name('business.invoice.update');
Route::get('/invoice/delete/{invoice_id}', 'Business\SaleController@invoiceDelete')->name('business.invoice.delete');
Route::get('/invoice/print/{invoice_id}', 'Business\SaleController@invoicePrint')->name('business.invoice.print');

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
Route::get('/chart/of/accounts', 'Business\AccountingController@chartOfAccounts')->name('business.chart.of.accounts');
Route::get('/chart/of/account/store', 'Business\AccountingController@chartOfAccountStore')->name('business.chart.of.account.store');
Route::get('/chart/of/account/update/{chart_of_account_id}', 'Business\AccountingController@chartOfAccountUpdate')->name('business.chart.of.account.update');
Route::get('/chart/of/account/delete/{chart_of_account_id}', 'Business\AccountingController@chartOfAccountDelete')->name('business.chart.of.account.delete');

Route::get('/transactions', 'Business\AccountingController@transactions')->name('business.transactions');

Route::get('/manual/journals', 'Business\AccountingController@manualJournals')->name('business.manual.journals');
Route::get('/manual/journal/store', 'Business\AccountingController@manualJournalStore')->name('business.manual.journal.store');
Route::get('/manual/journal/update/{manual_journal_id}', 'Business\AccountingController@manualJournalUpdate')->name('business.manual.journal.update');
Route::get('/manual/journal/delete/{manual_journal_id}', 'Business\AccountingController@manualJournalDelete')->name('business.manual.journal.delete');


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
Route::get('/accounts', 'Business\SettingController@accounts')->name('business.accounts');
Route::get('/opening/balances', 'Business\SettingController@openingBalances')->name('business.opening.balances');
Route::get('/users/roles', 'Business\SettingController@usersAndRoles')->name('business.users.roles');
Route::get('/currencies', 'Business\SettingController@currencies')->name('business.currencies');
Route::get('/taxes', 'Business\SettingController@taxes')->name('business.taxes');
Route::get('/emails', 'Business\SettingController@emails')->name('business.emails');
Route::get('/reminders', 'Business\SettingController@reminders')->name('business.reminders');
