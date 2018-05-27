<?php

Route::group(['namespace' => 'Auth'], function () {
    Route::post('login', 'LoginController@login')->name('login');
    Route::post('register', 'RegisterController@register')->name('register');
    Route::post('logout', 'LoginController@logout')->name('logout');
});

Route::group(['prefix' => 'user', 'as' => 'user.'], function() {
    Route::get('/', 'UserController@user')->name('info');
    Route::put('/', 'UserController@update')->name('update');
    Route::get('/favorites', 'UserController@favorites')->name('favorites');
    Route::get('/{id}/adverts', 'UserController@adverts')->name('adverts');
});

Route::group(['prefix' => 'categories', 'as' => 'categories.'], function() {
    Route::get('/', 'CategoriesController@index')->name('list');
    Route::get('/{id}/adverts', 'CategoriesController@adverts')->name('adverts');
});

Route::group(['prefix' => 'advert', 'as' => 'advert.'], function() {
    Route::get('/', 'AdvertsController@index')->name('index');
    Route::get('/{id}', 'AdvertsController@advert')->name('show');

    Route::post('/', 'AdvertsController@create')->name('create');
    Route::put('/{id}', 'AdvertsController@update')->name('update');

    Route::put('/{id}/favorite', 'AdvertsController@favorite')->name('favorite');
    Route::put('/{id}/unfavorite', 'AdvertsController@unfavorite')->name('unfavorite');
});