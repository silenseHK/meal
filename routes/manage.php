<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'access'], function(){
    Route::get('/','AccessController@lists');
    Route::get('/{id}','AccessController@first');
    Route::post('/', 'AccessController@add');
    Route::post('/{id}','AccessController@edit');
    Route::put('/{id}','AccessController@update');
    Route::delete('/{id}','AccessController@delete');
});
