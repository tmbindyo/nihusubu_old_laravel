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

Route::get('/', 'Landing\LandingController@landing')->name('landing');
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
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::get('/logout', 'Auth\LoginController@login')->name('logout');
Route::get('/register', 'Auth\LoginController@register')->name('register');
Route::get('/forgot/password', 'Auth\LoginController@forgotPassword')->name('forgot.password');

// Handling external service provider authentication
Route::get("/login/{provider}", "Auth\LoginController@redirectToProvider");
Route::get("/callback/{provider}", "Auth\LoginController@handleProviderCallback");