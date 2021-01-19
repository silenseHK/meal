<?php

use Illuminate\Support\Facades\Route;

Route::group([], function(){
    Route::group(['prefix'=>'admin'], function(){
        Route::group(['prefix'=>'account'], function(){
            Route::get('/','AdminController@lists');
            Route::get('/{id}','AdminController@detail')->whereNumber('id');
            Route::post('/', 'AdminController@add');
            Route::post('/{id}','AdminController@edit')->whereNumber('id');
            Route::put('/{id}','AdminController@update');
            Route::delete('/{id}','AdminController@delete')->whereNumber('id');
        });

        Route::group(['prefix'=>'role'], function(){
            Route::get('/','RoleController@lists');
            Route::get('/{id}','RoleController@detail')->whereNumber('id');
            Route::post('/', 'RoleController@add');
            Route::post('/{id}','RoleController@edit')->whereNumber('id');
            Route::put('/{id}','RoleController@update')->whereNumber('id');
            Route::delete('/{id}','RoleController@delete')->whereNumber('id');
        });
    });

});
