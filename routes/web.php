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


Route::get('/loan/type/seeder', 'Landing\LandingController@loanTypeSeeder');

//Route::get('/test/roles', 'Landing\LandingController@roleSeed');
Route::get('/test/roles', 'Landing\LandingController@testRoles');

Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
});

Auth::routes(['verify' => true]);


Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/user/account/select/{account_id}', 'HomeController@selectUserAccount')->name('select.user.account');
Route::get('/view/user/accounts', 'HomeController@viewUserAccounts')->name('view.user.accounts');
Route::get('/activate/user/account/{account_id}', 'HomeController@activateUserAccount')->name('activate.user.account');
Route::get('/deactivate/user/accounts', 'HomeController@deactivateUserAccounts')->name('deactivate.user.accounts');
Route::get('/create/user/account', 'HomeController@createUserAccount')->name('create.user.account');

Route::get('/user/{user_id}/institution/{institution_id}/invitation', 'Landing\LandingController@businessUserInvitation')->name('user.invitation');
Route::post('/business/add/user/account', 'Business\AuthController@businessAddUserAccount')->name('business.add.user.account');
Route::post('/business/store/user/{user_id}/institution/{institution_id}/account', 'Landing\LandingController@businessStoreUserAccount')->name('business.store.user.account');


Route::get('/address/population', 'Landing\LandingController@addressPopulation')->name('address.population');

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
Route::get('/privacy-policy', 'Landing\LandingController@comingSoon')->name('privacy.policy');
Route::get('/terms-and-conditions', 'Landing\LandingController@termsAndConditions')->name('terms.and.conditions');


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


// signup
Route::get('/business/signup', 'Business\AuthController@businessSignup')->name('business.signup');

// business account signup
Route::get('/standard/signup', 'Business\AuthController@standardSignup')->name('standard.signup');
Route::get('/professional/signup', 'Business\AuthController@professionalSignup')->name('professional.signup');
Route::post('/business/register', 'Auth\RegisterController@createInstitution')->name('business.register.account');
Route::post('/business/store', 'Business\AuthController@createInstitution')->name('business.store.account');
Route::get('/business/add', 'Business\AuthController@businessAdd')->name('business.add');
Route::post('/business/add/store', 'HomeController@addInstitution')->name('business.add.account');


// personal account sugnup
Route::get('/personal/signup', 'Business\AuthController@personalSignup')->name('personal.signup');
Route::get('/add/personal/account', 'HomeController@addPersonal')->name('add.personal.account');


Route::get('/view/order/{order_id}', 'Landing\LandingController@viewOrder')->name('view.order');
Route::get('/print/order/{order_id}', 'Landing\LandingController@printOrder')->name('print.order');
