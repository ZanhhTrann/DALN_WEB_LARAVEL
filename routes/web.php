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
    return redirect()->route('pages.index',['page'=>'home']);
});
// pages route
Route::get('/page/{page}', 'App\Http\Controllers\PagesController@index')->name('pages.index');
Route::get('/home', 'App\Http\Controllers\PagesController@__pageHomeView')->name('pages.home');
Route::get('/shop',function(){
    return redirect()->route('shopList',['value'=>"all"]);
})->name('pages.shop');
Route::get('/features', 'App\Http\Controllers\PagesController@__pageFeaturesView')->name('pages.features');
Route::get('/about', 'App\Http\Controllers\PagesController@__pageAboutView')->name('pages.about');
Route::get('/contact', 'App\Http\Controllers\PagesController@__pageContactView')->name('pages.contact');
Route::get('/signup', 'App\Http\Controllers\PagesController@__pageSignupView')->name('pages.signup');
Route::get('/signin', 'App\Http\Controllers\PagesController@__pageSigninView')->name('pages.signin');
Route::get('/search', 'App\Http\Controllers\PagesController@__pageSearchView')->name('pages.search');
Route::post('/changeCatList', 'App\Http\Controllers\PagesController@__changeCatList')->name('changeCatList');
Route::get('/shop/{value}', 'App\Http\Controllers\PagesController@__listProducts')->name('shopList');
Route::get('/shop/{value}/{page}', 'App\Http\Controllers\PagesController@__pageShopView')->name('showListProducts');
Route::get('/product/{Pid}', 'App\Http\Controllers\PagesController@productDetail')->name('productDetail');
Route::post('/updatePage', 'App\Http\Controllers\PagesController@updatePage')->name('updatePage');
// Route cho trang tìm kiếm
Route::get('/search', 'App\Http\Controllers\PagesController@searchResults')->name('searchResults');
Route::post('/search', 'App\Http\Controllers\PagesController@search')->name('search');


// Route::get('/shop/{page}', 'App\Http\Controllers\PagesController@__pageShopView')->name('childpages');

// end pages route
Route::post('/getChilCategory', 'App\Http\Controllers\CategoriesController@getChilCategory')->name('getChilCategory');
Route::post('/getListCategoryLimit', 'App\Http\Controllers\ProductsController@getListCategoryLimit')->name('getListCategoryLimit');
Route::post('/getQuickView', 'App\Http\Controllers\ProductsController@getQuickView')->name('getQuickView');
Route::post('/getListCategoryAll', 'App\Http\Controllers\ProductsController@getListCategoryAll')->name('getListCategoryAll');
//


