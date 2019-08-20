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


//Authentication
Route::get('/login', 'Business\LoginController@login')->name('business.login');
Route::get('/logout', 'Business\LoginController@login')->name('business.logout');
Route::get('/register', 'Business\LoginController@register')->name('business.register');
Route::get('/forgot/password', 'Business\LoginController@forgotPassword')->name('business.forgot.password');


//Dashboard
Route::get('/dashboard', 'Business\DashboardController@dashboard')->name('business.dashboard');


//Calendar
Route::get('/calendar', 'Business\CalendarController@calendar')->name('business.calendar');
Route::post('/calendar/store', 'Business\CalendarController@calendarSave')->name('business.calendar.store');


// To Do
Route::get('/to/dos', 'Business\ToDoController@toDos')->name('business.to.dos');
Route::post('/to/do/store', 'Business\ToDoController@toDoSave')->name('business.to.do.store');



//Settings
Route::get('/organization/profile', 'Business\SettingController@organizationProfile')->name('business.organization.profile');
Route::get('/opening/balances', 'Business\SettingController@openingBalances')->name('business.opening.balances');
Route::get('/users/roles', 'Business\SettingController@usersAndRoles')->name('business.users.roles');
Route::get('/currencies', 'Business\SettingController@currencies')->name('business.currencies');
Route::get('/taxes', 'Business\SettingController@taxes')->name('business.taxes');
Route::get('/emails', 'Business\SettingController@emails')->name('business.emails');
Route::get('/reminders', 'Business\SettingController@reminders')->name('business.reminders');




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
Route::get('/transfer/order/show/{transfer_order_id}', 'Business\InventoryController@transferOrder')->name('business.transfer.order.show');
Route::get('/transfer/order/edit/{transfer_order_id}', 'Business\InventoryController@transferOrder')->name('business.transfer.order.edit');
Route::post('/transfer/order/update/{transfer_order_id}', 'Business\InventoryController@transferOrder')->name('business.transfer.order.update');
Route::get('/transfer/order/delete/{transfer_order_id}', 'Business\InventoryController@transferOrder')->name('business.transfer.order.delete');

Route::get('/warehouses', 'Business\InventoryController@warehouses')->name('business.warehouses');
Route::post('/warehouse/store', 'Business\InventoryController@warehouseStore')->name('business.warehouse.store');
Route::get('/warehouse/show/{warehouse_id}', 'Business\InventoryController@warehouseShow')->name('business.warehouse.show');
Route::get('/warehouse/edit/{warehouse_id}', 'Business\InventoryController@warehouseEdit')->name('business.warehouse.edit');
Route::get('/warehouse/update/{warehouse_id}', 'Business\InventoryController@warehouseUpdate')->name('business.warehouse.update');
Route::get('/warehouse/delete/{warehouse_id}', 'Business\InventoryController@warehouseDelete')->name('business.warehouse.delete');


//Sales
Route::get('/contacts', 'Business\SaleController@contacts')->name('business.contacts');
Route::get('/clients', 'Business\SaleController@clients')->name('business.clients');
Route::get('/estimates', 'Business\SaleController@estimates')->name('business.estimates');
Route::get('/estimate/{estimate_id}', 'Business\SaleController@estimate')->name('business.estimate');
Route::get('/sales', 'Business\SaleController@sales')->name('business.sales');
Route::get('/sale/{sale_id}', 'Business\SaleController@sale')->name('business.sale');
Route::get('/orders', 'Business\SaleController@orders')->name('business.orders');
Route::get('/order/{order_id}', 'Business\SaleController@order')->name('business.order');
Route::get('/invoices', 'Business\SaleController@invoices')->name('business.invoices');
Route::get('/invoice/{invoice_id}', 'Business\SaleController@invoice')->name('business.invoice');
Route::get('/invoice/print/{invoice_id}', 'Business\SaleController@invoicePrint')->name('business.invoice.print');
Route::get('/payments/received', 'Business\SaleController@paymentsReceived')->name('business.payments.received');


//Purchase
Route::get('/purchase/orders', 'Business\PurchaseController@purchaseOrders')->name('business.purchase.orders');
Route::get('/purchase/order/{purchase_order_id}', 'Business\PurchaseController@purchaseOrder')->name('business.purchase.order');
Route::get('/vendors', 'Business\PurchaseController@vendors')->name('business.vendors');
Route::get('/expenses', 'Business\PurchaseController@expenses')->name('business.expenses');
Route::get('/expense/{expense_id}', 'Business\PurchaseController@expense')->name('business.expense');
Route::get('/bills', 'Business\PurchaseController@bills')->name('business.bills');
Route::get('/bill/{bill_id}', 'Business\PurchaseController@bill')->name('business.bill');
Route::get('/payments/made', 'Business\PurchaseController@paymentsMade')->name('business.payments.made');




