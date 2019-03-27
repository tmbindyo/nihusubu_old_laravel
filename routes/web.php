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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

	// Resources
	Route::resource('communication', 'CommunicationController');
	Route::resource('communication_type', 'CommunicationTypeController');
	Route::resource('industry', 'IndustryController');
	Route::resource('institution', 'InstitutionController');
	Route::resource('investor', 'InvestorController');
	Route::resource('project', 'ProjectController');
	Route::resource('project.project_bid', 'ProjectBidController');
	Route::resource('project.project_investment', 'ProjectInvestmentController');
	Route::resource('project.project_task', 'ProjectTaskController');
	Route::resource('project_type', 'ProjectTypeController');
	Route::resource('project_task.requisition', 'RequisitionController');
	Route::resource('review', 'ReviewController');
	Route::resource('review_type', 'ReviewTypeController');
	Route::resource('status', 'StatusController');
	Route::resource('upload', 'UploadController');
	Route::resource('upload_type', 'UploadTypeController');

	// User resource
	Route::resource('user_detail', 'UserDetailController');
	Route::resource('user_type', 'UserTypeController');

	// Investor controllers
	Route::get('/opportunities', 'InvestorProjectsController@opportunity')->name('opportunities');
	Route::get('/bids', 'InvestorProjectsController@bid')->name('bids');
	Route::get('/ongoing', 'InvestorProjectsController@ongoing')->name('ongoing');
	Route::get('/portfolio', 'InvestorProjectsController@portfolio')->name('portfolio');

	// Bid management controllers
	Route::get('project/{project_id}/bid/{project_bid_id}', 'BidManagementController@approve')->name('project.bid');
		// $project->id,$projectBid->id
});


