<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Dashboard
Route::get('/dashboard', 'Business\DashboardController@dashboard')->name('business.dashboard');


//Calendar
Route::get('/calendar', 'Business\CalendarController@calendar')->name('business.calendar');
Route::post('/calendar/store', 'Business\CalendarController@calendarSave')->name('business.calendar.store');


// To Do
Route::get('/to/dos', 'Business\ToDoController@toDos')->name('business.to.dos');
Route::post('/to/do/store', 'Business\ToDoController@toDoSave')->name('business.to.do.store');


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

Route::get('/estimates', 'Business\SaleController@estimates')->name('business.estimates');
Route::get('/estimate/create', 'Business\SaleController@estimateCreate')->name('business.estimate.create');
Route::post('/estimate/store', 'Business\SaleController@estimateStore')->name('business.estimate.store');
Route::get('/estimate/show/{estimate_id}', 'Business\SaleController@estimateShow')->name('business.estimate.show');
Route::get('/estimate/edit/{estimate_id}', 'Business\SaleController@estimateEdit')->name('business.estimate.edit');
Route::post('/estimate/update/{estimate_id}', 'Business\SaleController@estimateUpdate')->name('business.estimate.update');
Route::get('/estimate/delete/{estimate_id}', 'Business\SaleController@estimateDelete')->name('business.estimate.delete');

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


// Assets
Route::get('/assets', 'Business\AssetController@assets')->name('business.assets');


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

Route::get('/leaves', 'Business\EmployeeController@leaves')->name('business.leaves');
Route::get('/leave/create', 'Business\EmployeeController@leaveCreate')->name('business.leave.create');
Route::post('/leave/store', 'Business\EmployeeController@leaveStore')->name('business.leave.store');
Route::get('/leave/show/{leave_id}', 'Business\EmployeeController@leaveShow')->name('business.leave.show');
Route::get('/leave/update/{leave_id}', 'Business\EmployeeController@leaveUpdate')->name('business.leave.edit');
Route::get('/leave/edit/{leave_id}', 'Business\EmployeeController@leaveEdit')->name('business.leave.edit');
Route::get('/leave/delete/{leave_id}', 'Business\EmployeeController@leaveDelete')->name('business.leave.delete');

Route::get('/attendances', 'Business\EmployeeController@attendances')->name('business.attendances');
Route::get('/attendance/create', 'Business\EmployeeController@attendanceCreate')->name('business.attendance.create');
Route::post('/attendance/store', 'Business\EmployeeController@attendanceStore')->name('business.attendance.store');
Route::get('/attendance/show/{attendance_id}', 'Business\EmployeeController@attendanceShow')->name('business.attendance.show');
Route::get('/attendance/update/{attendance_id}', 'Business\EmployeeController@attendanceUpdate')->name('business.attendance.edit');
Route::get('/attendance/edit/{attendance_id}', 'Business\EmployeeController@attendanceEdit')->name('business.attendance.edit');
Route::get('/attendance/delete/{attendance_id}', 'Business\EmployeeController@attendanceDelete')->name('business.attendance.delete');

Route::get('/document/flows', 'Business\EmployeeController@documentFlows')->name('business.document.flows');
Route::get('/document/flow/create', 'Business\EmployeeController@documentFlowCreate')->name('business.document.flow.create');
Route::post('/document/flow/store', 'Business\EmployeeController@documentFlowStore')->name('business.document.flow.store');
Route::get('/document/flow/show/{document_flow_id}', 'Business\EmployeeController@documentFlowShow')->name('business.document.flow.show');
Route::get('/document/flow/update/{document_flow_id}', 'Business\EmployeeController@documentFlowUpdate')->name('business.document.flow.edit');
Route::get('/document/flow/edit/{document_flow_id}', 'Business\EmployeeController@documentFlowEdit')->name('business.document.flow.edit');
Route::get('/document/flow/delete/{document_flow_id}', 'Business\EmployeeController@documentFlowDelete')->name('business.document.flow.delete');

Route::get('/teams', 'Business\EmployeeController@teams')->name('business.teams');
Route::get('/team/create', 'Business\EmployeeController@teamCreate')->name('business.team.create');
Route::post('/team/store', 'Business\EmployeeController@teamStore')->name('business.team.store');
Route::get('/team/show/{team_id}', 'Business\EmployeeController@teamShow')->name('business.team.show');
Route::get('/team/update/{team_id}', 'Business\EmployeeController@teamUpdate')->name('business.team.edit');
Route::get('/team/edit/{team_id}', 'Business\EmployeeController@teamEdit')->name('business.team.edit');
Route::get('/team/delete/{team_id}', 'Business\EmployeeController@teamDelete')->name('business.team.delete');

Route::get('/payrolls', 'Business\EmployeeController@payrolls')->name('business.payrolls');
Route::get('/payroll/create', 'Business\EmployeeController@payrollCreate')->name('business.payroll.create');
Route::post('/payroll/store', 'Business\EmployeeController@payrollStore')->name('business.payroll.store');
Route::get('/payroll/show/{payroll_id}', 'Business\EmployeeController@payrollShow')->name('business.payroll.show');
Route::get('/payroll/update/{payroll_id}', 'Business\EmployeeController@payrollUpdate')->name('business.payroll.edit');
Route::get('/payroll/edit/{payroll_id}', 'Business\EmployeeController@payrollEdit')->name('business.payroll.edit');
Route::get('/payroll/delete/{payroll_id}', 'Business\EmployeeController@payrollDelete')->name('business.payroll.delete');


// Settings
Route::get('/organization/profile', 'Business\SettingController@organizationProfile')->name('business.organization.profile');
Route::get('/accounts', 'Business\SettingController@accounts')->name('business.accounts');
Route::get('/opening/balances', 'Business\SettingController@openingBalances')->name('business.opening.balances');
Route::get('/users/roles', 'Business\SettingController@usersAndRoles')->name('business.users.roles');
Route::get('/currencies', 'Business\SettingController@currencies')->name('business.currencies');
Route::get('/taxes', 'Business\SettingController@taxes')->name('business.taxes');
Route::get('/emails', 'Business\SettingController@emails')->name('business.emails');
Route::get('/reminders', 'Business\SettingController@reminders')->name('business.reminders');
