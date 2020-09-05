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

 Route::get('/dashboard', 'Admin\DashboardController@dashboard')->name('admin.dashboard');

 Route::get('/institutions', 'Admin\InstitutionController@institutions')->name('admin.institutions');
 Route::get('/institution/show/{institution_id}', 'Admin\InstitutionController@institutionShow')->name('admin.institution.show');

 Route::get('/modules', 'Admin\ModuleController@modules')->name('admin.modules');
 Route::get('/module/show/{module_id}', 'Admin\ModuleController@moduleShow')->name('admin.module.show');
 Route::post('/module/update/{module_id}', 'Admin\ModuleController@moduleUpdate')->name('admin.module.update');

 Route::get('/payments', 'Admin\PaymentController@payments')->name('admin.payments');
 Route::get('/payment/show/{payment_id}', 'Admin\PaymentController@paymentShow')->name('admin.payment.show');


 // roles
Route::get('/roles', 'Admin\RoleController@roles')->name('admin.roles');
Route::get('/role/create', 'Admin\RoleController@roleCreate')->name('admin.role.create');
Route::post('/role/store', 'Admin\RoleController@roleStore')->name('admin.role.store');
Route::get('/role/show/{role_id}', 'Admin\RoleController@roleShow')->name('admin.role.show');

Route::get('/role/update/{role_id}/permission/{permission_id}', 'Admin\RoleController@updateRolePermission')->name('admin.role.update.permission');

Route::get('/revoke/user/{user_id}/role/{role_id}', 'Admin\RoleController@userRevokeRole')->name('admin.user.revoke.role');
Route::post('/assign/user/role/{role_id}', 'Admin\RoleController@userAssignRole')->name('admin.user.assign.role');

Route::post('/role/update/{role_id}', 'Admin\RoleController@roleUpdate')->name('admin.role.update');
Route::get('/role/delete/{role_id}', 'Admin\RoleController@roleDelete')->name('admin.role.delete');
Route::get('/role/restore/{role_id}', 'Admin\RoleController@roleRestore')->name('admin.role.restore');


// users
Route::get('/users', 'Admin\RoleController@users')->name('admin.users');
Route::get('/user/create', 'Admin\RoleController@userCreate')->name('admin.user.create');
Route::post('/user/store', 'Admin\RoleController@userStore')->name('admin.user.store');
Route::get('/user/show/{user_id}', 'Admin\RoleController@userShow')->name('admin.user.show');

Route::post('/user/add/role/{user_id}', 'Admin\RoleController@userAddRole')->name('admin.user.add.role');
Route::get('/delist/user/{user_id}/role/{role_id}', 'Admin\RoleController@userDelistRole')->name('admin.user.delist.role');

Route::post('/user/update/{user_id}', 'Admin\RoleController@userUpdate')->name('admin.user.update');
Route::get('/user/delete/{user_id}', 'Admin\RoleController@userDelete')->name('admin.user.delete');
Route::get('/user/restore/{user_id}', 'Admin\RoleController@userRestore')->name('admin.user.restore');
