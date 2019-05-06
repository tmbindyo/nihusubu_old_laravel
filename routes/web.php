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

/*
 * Global resources
 */
Route::resource('age_cluster', 'AgeClusterController');
Route::resource('agriculture_type', 'AgricultureTypeController');
Route::resource('constituency', 'ConstituencyController');
Route::resource('country', 'CountryController');
Route::resource('county', 'CountyController');
Route::resource('domain', 'DomainController');
Route::resource('family', 'FamilyController');
Route::resource('family_size', 'FamilySizeController');
Route::resource('farm_size', 'FarmSizeController');
Route::resource('fertility', 'FertilityController');
Route::resource('fertility_type', 'FertilityTypeController');
Route::resource('gender', 'GenderController');
Route::resource('genus', 'GenusController');
Route::resource('kingdom', 'KingdomController');
Route::resource('location', 'LocationController');
Route::resource('order', 'OrderController');
Route::resource('phylum_class', 'PhylumClassController');
Route::resource('phylum', 'PhylumController');
Route::resource('species', 'SpeciesController');
Route::resource('status', 'StatusController');
Route::resource('topography', 'TopographyController');
Route::resource('ward', 'WardController');
Route::resource('disease', 'DiseaseController');
Route::resource('causes', 'CausesController');
Route::resource('symptom', 'SymptomController');
Route::resource('spread', 'SpreadController');
Route::resource('management', 'ManagementController');








// Route::get('/', 'Listing\Home@all');
// Route::get('/about','Home\Home@index');
// Route::get('/terms-and-conditions', 'Home\Home@terms')->name("home.terms");
// Route::get('/faqs', 'Home\Home@faqs')->name("home.faqs");
// Route::get('/privacy-policy', 'Home\Home@privacy')->name("home.privacy");

// /*
//  * registering a business
//  */
// Route::get('business/register', 'Home\Business@getBusinessRegister')->name('register.business');
// Route::get('business/complete/{slug}', 'Home\Business@getCompleteBusiness');
// Route::post('business/complete/{id}', 'Home\Business@postCompleteBusiness')->name('complete_business');
// Route::post('business/register', 'Home\Business@postBusiness')->name('register.business');

// Route::get('salon/{slug}',['as'=>'salon.single' , 'uses'=>'Listing\Home@show']);
// Route::get('stories/{slug}',['as' =>'stories.single','uses' => 'Stories\Home@getSingle'])->where('slug','[\w\d\-\_]+');
// // Route::get('stories/{slug}',['as'=>'stories.single' , 'uses'=>'Stories\Home@getSingle']);
// Route::get('lykaahstories',['as'=>'stories.all' , 'uses'=>'Stories\Home@all']);

// Route::get('stories/category/{id}', 'Stories\Category@getCategory')->name('home.story_category');

// Route::get('lykaahsearch',['as'=>'search.all' , 'uses'=>'Listing\Home@all']);
// Route::post('search/content',['as'=>'search.lykaah' , 'uses'=>'Listing\Home@search']);

// Route::post('newsletter',['as'=>'subscription.store' , 'uses'=>'Newsletter@store']);


// /*
//  * Salon dashboard urls
//  */
// Route::get('lykaah/salon/login','Listing\Registration@login')->name('salon.login');
// Route::get('lykaah/salon/register','Listing\Register@index')->name('salon.index');
// Route::post('lykaah/salon/register','Listing\Register@store')->name('salon.store');
// Route::post('lykaah/salon/register','Listing\UserController@store')->name('user.store');
// Route::post('lykaah/salon/savecategory','Listing\Dashboard@postCategory')->name('category.store');
// Route::post('lykaah/salon/saveservice/{id}','Listing\Dashboard@postService')->name('service.store');
// Route::post('lykaah/salon/savebranch','Listing\Dashboard@postBranch')->name('branch.store');
// Route::post('change/banner', 'Listing\Dashboard@changeBanner')->name('banner_change');
// Route::post('change/logo', 'Listing\Dashboard@changeLogo')->name('logo_change');







Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

	// Routes
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

	// Resources
	Route::resource('blog', 'BlogController');
	Route::resource('blog_image', 'BlogImageController');
	Route::resource('blog_tag', 'BlogTagController');
	Route::resource('category', 'CategoryController');

	Route::resource('communication', 'CommunicationController');
	Route::resource('communication_type', 'CommunicationTypeController');
	Route::resource('institution', 'InstitutionController');
	Route::resource('institution_type', 'InstitutionTypeController');

	Route::resource('farm', 'FarmController');
	Route::resource('farm_crop', 'FarmCropController');

	Route::resource('layout', 'LayoutController');

	Route::resource('role', 'RoleController');
	Route::resource('sand_type', 'SandTypeController');
	Route::resource('style', 'StyleController');
	Route::resource('tag', 'TagController');

	Route::resource('upload', 'UploadController');
	Route::resource('upload_type', 'UploadTypeController');
	Route::resource('user_detail', 'UserDetailController');
	Route::resource('user_type', 'UserTypeController');




	

	// /*
	// * Institution dashboard urls
	// */
	// Route::group(['as'=>'Institution::','prefix' => 'listing'], function () {
		
	// 	Route::get('dashboard', 'Listing\Dashboard@getIndex')->name('dashboard');
	
	// 	Route::get('profile', 'Listing\ProfileController@getProfilePage')->name('profile');
	
	// 	Route::get('salon/profile', 'Listing\Dashboard@getProfile')->name('salon_profile');
	// 	Route::get('salon/address', 'Listing\Dashboard@getAddress')->name('salon_address');
	// 	Route::get('salon/editprofile', 'Listing\Dashboard@getEditProfile')->name('edit_salon_profile');
	// 	Route::get('salon/editprofile', 'Listing\Dashboard@postEditProfile')->name('profile_edit');
	
	// 	Route::get('branches', 'Listing\Dashboard@getBranches')->name('branches');
	// 	Route::get('branch/registration', 'Listing\Dashboard@getBranchRegistration')->name('branch_registration');
	// 	Route::get('branch/profile', 'Listing\Dashboard@getBranchProfiles')->name('branch_profiles');
	// 	Route::get('branch/editprofile', 'Listing\Dashboard@getEditBranchProfile')->name('edit_branch_profiles');
	
	// 	Route::get('users', 'Listing\Dashboard@getUsers')->name('users');
	// 	Route::get('user/registration', 'Listing\Dashboard@getUserRegistration')->name('user_registration');
	// 	Route::post('user/registration', 'Listing\Dashboard@getUserStore')->name('user_store');
	
	// 	Route::get('services/categories', 'Listing\Dashboard@getServiceCategories')->name('service_categories');
	// 	Route::get('category/registration', 'Listing\Dashboard@getCategoryRegistration')->name('category_registration');
	// 	Route::get('services', 'Listing\Dashboard@getServices')->name('services');
	// 	Route::get('category/{id}/services', 'Listing\Dashboard@getCategoryService')->name('service');
	// 	Route::get('category/{id}/add', 'Listing\Dashboard@getAddService')->name('service_add');
	// 	Route::get('service_registration', 'Listing\Dashboard@getServiceRegistration')->name('service_registration');
	
	// 	Route::get('branch/{id}/address', 'Listing\Dashboard@getBranchAddress')->name('branch.address');
	// 	Route::get('branch/{id}/profile', 'Listing\Dashboard@getBranchProfile')->name('branch.profile');
	
	// 	Route::post('update/home', 'Listing\ProfileController@updateHome')->name('home_update');
	// 	Route::post('update/address', 'Listing\ProfileController@updateAddress')->name('address_update');
	// 	Route::post('update/details', 'Listing\ProfileController@updateDetails')->name('details_update');
	// 	Route::post('update/presentation', 'Listing\ProfileController@updatePresentation')->name('update_presentation');
	
	// });





	// /*
	// * Story dashboard urls
	// */

	// Route::group(['prefix' => 'story'], function () {

	// 	Route::get("dashboard", 'Stories\Dashboard@index')->name('story.dashboard');
	// 	Route::get("tag/add", 'Stories\Dashboard@GetTags')->name('story.tag_form');
	// 	Route::post("tags", 'Stories\Dashboard@PostTag')->name('story.tag');
	// 	Route::get("tags/all", 'Stories\Dashboard@GetAllTags')->name('story.tags');
	// 	Route::get("tags/edit/{id}", 'Stories\Dashboard@EditTag')->name('story.tag.edit');
	// 	Route::post("tags/update/{id}", 'Stories\Dashboard@UpdateTag')->name('story.tags.update');

	// 	/*Route::get("compose", 'Stories\Dashboard@getCompose')->name('story.draft');
	// 	Route::post("compose", 'Stories\Dashboard@postStory')->name('story.story_post');
	// 	Route::get("tags/edit", 'Stories\Dashboard@EditTag')->name('story.tags.edit');
	// 	Route::get("stories", 'Stories\Dashboard@GetStories')->name('story.draft');*/

	// 	Route::get("style", 'Stories\Dashboard@SelectStyle')->name('story.select.style');
	// 	Route::get("layout/{style}", 'Stories\Dashboard@SelectLayout')->name('story.select.layout');
	// 	Route::get("compose/{id}", 'Stories\Dashboard@addStory')->name('story.draft');
	// 	Route::post("compose/{type}", 'Stories\Dashboard@postStory')->name('story.story_post');
	// 	Route::get("all", 'Stories\Dashboard@GetAllStories')->name('story.stories');
	// 	Route::get("edit", 'Stories\Dashboard@EditStory')->name('story.stories.edit');
	// 	Route::get("categories", 'Stories\Dashboard@GetCategories')->name('story.categories');
	// 	Route::post("categories", 'Stories\Dashboard@PostCategories')->name('story.save_category');
	// 	Route::get("categories/all", 'Stories\Dashboard@GetAllCategories')->name('story.categories.all');
	// 	Route::get("categories/edit/{id}", 'Stories\Dashboard@EditCategory')->name('story.categories.edit');
	// 	Route::post("categories/update/{id}", 'Stories\Dashboard@UpdateCategory')->name('story.categories.update');
	// 	Route::get("layout/{style}", 'Stories\Dashboard@getLayouts')->name('story.style');
	// 	Route::get("style", 'Stories\Dashboard@GetStyles')->name('story.styles');
	// 	Route::get('author/wall/{id}','Stories\Home@getAuthor')->name('author.name');
	// });




	// /*
	// * Admin dashboard urls
	// */
	// Route::group(['prefix' => 'admin'], function () {

	// 	Route::get('dashboard', 'Admin\Home@dashboard')->name('admin.dashboard');
	// 	Route::get('salon/registration', 'Admin\Home@getSalonRegistration')->name('admin.salons.registration');
	// 	Route::post('salon/registration', 'Admin\Home@postSalonRegistration')->name('admin.salons.registration');
	// 	Route::get('salons', 'Admin\Home@getSalons')->name('admin.salons');
	// 	Route::get('salon/{slug}', 'Admin\Home@getSalon')->name('admin.salon');
	// 	Route::get('branches', 'Admin\Home@getBranches')->name('admin.branches');
	
	// 	Route::get('approve/branch/{branch_id}', 'Admin\BranchesController@approveBranch')->name('branch.approve');
	
	// 	Route::get('user/register', 'Admin\User@getUserRegister')->name('admin.user_register');
	// 	Route::get('users', 'Admin\User@getUsers')->name('admin.users');
	// 	Route::post('user/register', 'Admin\User@postUserRegister')->name('admin.user_register');
	
	// });
	

   




});


