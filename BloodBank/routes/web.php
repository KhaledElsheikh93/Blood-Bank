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

Route::group(['middleware' => ['auth','auto-check-permission']] , function(){
    
Route::get('/', 'HomeController@index')->name('home');


Route::get('/hash', function () {
    return Illuminate\Support\Facades\Hash::make(11111111) ;
});

Auth::routes();

Route::resource('governorates', 'GovernorateController');
Route::resource('cities', 'CityController');
Route::resource('blood_types', 'BloodTypeController');
Route::resource('donation_requests', 'DonationRequestController');
Route::resource('categories','CategoryController');
Route::resource('posts','PostController');
Route::resource('clients', 'ClientController');
Route::resource('roles','RoleController');
Route::resource('users','UserController');
Route::resource('settings', 'SettingController');
Route::resource('contacts', 'ContactController');

// user reset password

Route::get('user/change-password', 'UserController@changePassword');
Route::post('user/change-password', 'UserController@changePasswordSave');


});
