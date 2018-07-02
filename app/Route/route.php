<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
echo 1;
Route::get('/', function () {
    return view('welcome');
});

echo 2;
Route::get('/aaa', function () {
    return "aaa";
});

Route::get('/aaa/bbb/{i}/{j}', function () {
    return "aaa";
});

echo 3;
Route::get('/bbb', function () {
    echo __METHOD__;
    return view();
    return "bbb";
});