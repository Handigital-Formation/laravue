<?php

Auth::routes();
Route::get('/', 'PenseeController@app');

Route::resource('pensees', 'PenseeController', ['only' => [
'index', 'store', 'destroy',
]]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
