<?php

use PhpFramework\Router\Route;


Route::any('/home', function () {
    echo 'test';
});

Route::get('/home', 'HomeController@index');

Route::prefix('admin', function () {
    Route::middleware('Admin|Owner', function () {
        Route::get('/dashboard', 'DashbaordController@index');
        Route::get('/users', 'DashbaordController@users');
        Route::get('/admins', 'DashbaordController@admins');
    });
    Route::prefix('owner', function () {
        Route::get('/dashboard', 'DashbaordController@index');
        Route::get('/users', 'DashbaordController@users');
        Route::get('/admins', 'DashbaordController@admins');
    });
});
