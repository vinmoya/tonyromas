<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('dashboard')->middleware('auth')->group(function () {

    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::resource('restaurants', 'RestaurantController')->middleware('permission:restaurants');
    Route::get('users/profile', 'UserController@profile')->name('users.profile')->middleware('permission:users-edit-profile');

    Route::put('users/profile/update/{id}', 'UserController@profileUpdate')->name('users.profile.update')->middleware('permission:users-edit-profile');
    
    Route::resource('users', 'UserController')->middleware('permission:users');
    Route::get('codes', 'CodeController@index')->name('codes.index')->middleware('permission:codes');
    Route::get('codes/create', 'CodeController@create')->name('codes.create')->middleware('permission:codes');
	Route::get('codes/download', 'CodeController@downloadCodes')->name('codes.download')->middleware('permission:codes');
	Route::post('codes/store', 'CodeController@store')->name('codes.store')->middleware('permission:codes');
	Route::get('codes/export-csv/{type}', 'CodeController@exportCSV')->name('codes.export-csv')->middleware('permission:codes');
	Route::post('codes/import-csv', 'CodeController@importCSV')->name('codes.import-csv')->middleware('permission:codes');
    Route::get('codes/download-coupon', 'CodeController@downloadCoupon')->name('codes.download-coupon')->middleware('permission:codes');
});

//////Routes Api
Route::get('getCodes', 'CodeController@getCodes');