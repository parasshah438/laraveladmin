<?php



Route::get('/', function () {
   return view('welcome');
});

Auth::routes();

Route::post('/getdata', 'HomeController@getdata');
Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function(){


	Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/login', 'Auth\AdminController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminController@login')->name('admin.login.submit');
    Route::get('/logout','Auth\AdminController@logout')->name('admin.logout');
    Route::get('/profile','AdminController@profile')->name('admin-profile');
    Route::post('/profile','AdminController@update_profile');

 	//admin password reset routes
    Route::post('/password/email','Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset','Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset','Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}','Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
   	
   
});