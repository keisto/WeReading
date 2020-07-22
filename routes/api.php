<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Auth')->group(function () {
    Route::post('/register', 'AuthController@register');
    Route::post('/login', 'AuthController@login');
    Route::post('/logout', 'AuthController@logout');
    Route::get('/me', 'AuthController@me');
});

Route::get('/books', 'BookController@index');
Route::post('/books', 'BookController@store');
Route::patch('/books', 'BookController@update');
Route::post('/books/search', 'BookController@search');
Route::get('/books/{book}', 'BookController@show');
Route::delete('/books/{book}', 'BookController@destroy');
