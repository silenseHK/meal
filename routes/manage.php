<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'access'], function(){
    Route::get('/','AccessController@lists');
    Route::get('/{id}','AccessController@detail')->where(['id'=>idExp()]);
    Route::post('/', 'AccessController@add');
    Route::put('/{id}','AccessController@update')->where(['id'=>idExp()]);
    Route::delete('/{id}','AccessController@delete')->where(['id'=>idExp()]);
});
