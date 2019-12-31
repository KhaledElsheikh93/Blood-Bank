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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/hash', function () {
    return Illuminate\Support\Facades\Hash::make(123) ;
});

// admin 
Route::get('/home', function(){
    return view('admin.home');
});


Route::group(['prefix' => 'admin' , 'middleware' => ['auth:web','auto-check-permission']] , function(){
Route::get('home', 'HomeController@index')->name('home');
Route::resource('governorates', 'GovernorateController');
Route::resource('cities', 'CityController');
Route::resource('blood_types', 'BloodTypeController');
Route::resource('donation_requests', 'DonationRequestController');
Route::resource('categories','CategoryController');
Route::resource('posts','PostController');
Route::resource('clients', 'ClientController');
Route::resource('roles','RoleController');

Route::resource('settings', 'SettingController');
Route::resource('contacts', 'ContactController');
//  user reset password
Route::get('users/change-password', 'UserController@changePassword');
Route::post('users/change-password', 'UserController@changePasswordSave');
Route::resource('users','UserController');
});

   //  Website front end routes

Route::group(['namespace' => 'front'] ,function(){
    Route::get('/client-login', 'AuthController@viewLogin')->name('client-login');
    Route::post('/client-login', 'AuthController@doLogin');
    Route::get('/client-register', 'AuthController@viewRegister');
    Route::post('/client-register', 'AuthController@register');

    Route::get('get-cities/{id}', 'MainController@getCities');
    Route::get('/', 'MainController@home');
    Route::get('/about-us', 'MainController@aboutUs');
    Route::get('/posts', 'MainController@posts');
    Route::get('/posts/{id}', 'MainController@post');
    Route::get('who-we-are', 'MainController@whoWeAre');


    Route::get('/contact-us', 'MainController@contactUs');
    Route::post('/contact-us', 'MainController@contactUsCreate');
    Route::get('/donation-request', 'MainController@donationRequest');
    Route::get('/donation-details/{id}', 'MainController@donationDetails');  
    Route::get('/toggle-favourite', 'FrontController@toggleFavourite')->name('toggle-favourite');

});
