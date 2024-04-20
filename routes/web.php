<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// home
Route::get('/home', 'HomeController@index')->name('home');

// generic
Route::get('/generic', function () {
    return view('generic');
})->name('generic');

// elements
Route::get('/elements', function () {
    return view('elements');
})->name('elements');


