<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::group(['prefix' => 'v1', 'namespace' => 'Api'],function(){

    Route::group(['middleware'=>'auth:api'] , function(){
        Route::get('settings', 'MainController@settings');
        Route::get('notifications', 'MainController@notifications');
        Route::get('categories', 'MainController@categories');
        Route::get('profile', 'MainController@profile');
        Route::get('contacts', 'MainController@contacts');
        Route::post('donation-request-create', 'MainController@donationRequestCreate');
        Route::post('register-token', 'AuthController@registerToken');
        Route::post('remove-token', 'MainController@removeTpken');
        Route::post('notification-settings', 'MainController@notificationSettings');
        Route::get('posts', 'MainController@posts');
        Route::get('post-id', 'MainController@postsId');
        Route::get('donation-requests', 'MainController@donationRequest');
        Route::post('contacts', 'MainController@contacts');
        Route::post('edit-profile', 'MainController@editProfile');
        Route::post('update-notification-settings', 'MainController@updateNotificationSettings');
        Route::post('toggle-favourite', 'MainController@toggleFavourite');
        Route::get('profile', 'MainController@profile');
    });
    
   
    Route::get('cities', 'MainController@cities');
    Route::get('governorates', 'MainController@governorates');
    Route::get('blood-types', 'MainController@bloodTypes');
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('reset-password', 'AuthController@sendPinCode');
    Route::post('new-password', 'AuthController@resetPassword');
    Route::get('settings', 'MainController@settings');
});
