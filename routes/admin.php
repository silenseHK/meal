<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'admin'], function(){
    Route::get('/','AdminController@lists');
    Route::get('/{id}','AdminController@first');
    Route::post('/', 'AdminController@add');
    Route::post('/{id}','AdminController@edit');
    Route::put('/{id}','AdminController@update');
    Route::delete('/{id}','AdminController@delete');
});
