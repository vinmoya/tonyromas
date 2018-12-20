<?php

use Illuminate\Http\Request;

Route::post('login', 'Api\AuthController@login');
Route::post('register', 'Api\AuthController@register'); 
Route::post('codes/activate', 'Api\CodeController@activateCode');
Route::post('codes/exchange', 'Api\CodeController@codeExchange');
Route::post('codes/state', 'Api\CodeController@stateCode');

