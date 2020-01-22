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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

    // Routes
//    Route::resource('user', 'UserController', ['except' => ['show']]);
//    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
//    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
//    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);


    Route::resource('user_detail', 'UserDetailController');


//    Route::resource('service', 'ServiceController');


});


Route::get('/', 'Landing\LandingController@landing')->name('landing');

Route::post('/email/subscribe', 'Landing\LandingController@emailSubscribe')->name('email.subscribe');
Route::post('/contact/us', 'Landing\LandingController@contactUs')->name('contact.us');

Route::get('/about', 'Landing\LandingController@about')->name('about');
Route::get('/services', 'Landing\LandingController@services')->name('services');
Route::get('/contacts', 'Landing\LandingController@contacts')->name('contacts');
Route::get('/events', 'Landing\LandingController@events')->name('events');
Route::get('/lawyer', 'Landing\LandingController@lawyer')->name('lawyer');
Route::get('/event/{event_id}', 'Landing\LandingController@event')->name('event');
Route::get('/faq', 'Landing\LandingController@faq')->name('faq');
Route::get('/corporate', 'Landing\LandingController@corporate')->name('corporate');
Route::get('/team', 'Landing\LandingController@team')->name('team');
Route::get('/portfolio', 'Landing\LandingController@portfolio')->name('portfolio');
Route::get('/coming/soon', 'Landing\LandingController@comingSoon')->name('coming.soon');

//TODO create pages for privacy policy and terms and condition
Route::get('/privacy/policy', 'Landing\LandingController@comingSoon')->name('privacy.policy');
Route::get('/terms/and/conditions', 'Landing\LandingController@comingSoon')->name('terms.and.condition');


// Authentication
// Route::get('/login', 'Auth\LoginController@login')->name('login');
// Route::get('/logout', 'Auth\LoginController@login')->name('logout');
// Route::get('/register', 'Auth\LoginController@register')->name('register');
// Route::get('/forgot/password', 'Auth\LoginController@forgotPassword')->name('forgot.password');


// Handling external service provider login
Route::get("/login/{provider}", "Auth\LoginController@redirectToProvider");
Route::get("/callback/{provider}", "Auth\LoginController@handleProviderCallback");


// Handling external service provider registration
Route::get("/register/{provider}", "Auth\LoginController@redirectToProvider");
Route::get("/callback/{provider}", "Auth\LoginController@handleProviderCallback");




// Business auth
Route::get('/business/login', 'Business\AuthController@businessLogin')->name('business.login');
Route::get('/business/login/two/columns', 'Business\AuthController@businessLoginTwoColumns')->name('business.login.two.columns');
Route::get('/business/forgot/password', 'Business\AuthController@businessForgotPassword')->name('business.forgot.password');
Route::get('/business/register', 'Business\AuthController@businessRegisterPage')->name('business.register');
Route::post('/business/register', 'Auth\RegisterController@createInstitution')->name('business.register.account');


// Personal auth
Route::get('/personal/login', 'Personal\AuthController@personalLogin')->name('personal.login');
Route::get('/personal/login/two/columns', 'Personal\AuthController@personalLoginTwoColumns')->name('personal.login.two.columns');
Route::get('/personal/forgot/password', 'Personal\AuthController@personalForgotPassword')->name('personal.forgot.password');
Route::get('/personal/register', 'Personal\AuthController@personalRegisterPage')->name('personal.register');
