<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.home.home');
});
// Trong routes/web.php
// Route::get('/process-category', 'App\Http\Controllers\CategoriesController@processCategory')->name('process.category');
// routes/web.php
Route::post('/getChilCategory', 'App\Http\Controllers\CategoriesController@getChilCategory')->name('getChilCategory');

