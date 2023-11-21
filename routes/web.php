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
Route::get('/order', 'App\Http\Controllers\PagesController@__pagePaymentView')->name('pages.payment');
Route::get('/orders', 'App\Http\Controllers\PagesController@__pageOrdersView')->name('pages.orders');
Route::get('/thanks', 'App\Http\Controllers\PagesController@__pageThanksView')->name('pages.thanks');
Route::get('/helps/{page}', 'App\Http\Controllers\PagesController@__pageHelpsView')->name('helps');
Route::get('/profile', 'App\Http\Controllers\PagesController@__pageProfileView')->name('pages.profile');
Route::post('/changeCatList', 'App\Http\Controllers\PagesController@__changeCatList')->name('changeCatList');
Route::get('/shop/{value}', 'App\Http\Controllers\PagesController@__listProducts')->name('shopList');
Route::get('/shop/{value}/{page}', 'App\Http\Controllers\PagesController@__pageShopView')->name('showListProducts');
Route::get('/product/{Pid}', 'App\Http\Controllers\PagesController@productDetail')->name('productDetail');
Route::post('/updatePage', 'App\Http\Controllers\PagesController@updatePage')->name('updatePage');
Route::post('/updatePageSearch', 'App\Http\Controllers\PagesController@updatePageSearch')->name('updatePageSearch');
// Route cho trang tìm kiếm
Route::get('/search', 'App\Http\Controllers\PagesController@searchResults')->name('searchResults');
Route::post('/search', 'App\Http\Controllers\PagesController@search')->name('search');
Route::post('/payment', 'App\Http\Controllers\PaymentController@payment')->name('payment');
Route::get('/cancelOrder/{ODid}', 'App\Http\Controllers\PaymentController@cancelOrder')->name('cancelOrder');
Route::get('/sucssetOrder/{ODid}', 'App\Http\Controllers\PaymentController@sucssetOrder')->name('sucssetOrder');
//
Route::get('/getProductByName/{searchTerm}', 'App\Http\Controllers\ProductsController@getProductByName')->name('getProductByName');
Route::post('/UpdateCart', 'App\Http\Controllers\UsersController@updateUserCart')->name('UpdateCart');
Route::get('/DelelteProductCart/{UCid}', 'App\Http\Controllers\UsersController@DelelteProductCart')->name('DelelteProductCart');
//
Route::post('/pay', 'App\Http\Controllers\PaymentController@Pay')->name('pay');
Route::get('/payView', 'App\Http\Controllers\PaymentController@payView')->name('payView');

// signin
Route::post('/signin', 'App\Http\Controllers\UsersController@signin')->name('signin');
Route::post('/signup', 'App\Http\Controllers\UsersController@signup')->name('signup');
Route::get('/signout', 'App\Http\Controllers\UsersController@signout')->name('signout');
Route::get('/updateFavorite/{Pid}', 'App\Http\Controllers\UsersController@updateFavorite')->name('updateFavorite');
Route::post('/updateCart/{Pid}', 'App\Http\Controllers\UsersController@updateCart')->name('updateCart');
Route::post('/updataProfile', 'App\Http\Controllers\UsersController@updataProfile')->name('updataProfile');
Route::post('/putReview', 'App\Http\Controllers\UsersController@putReview')->name('putReview');



// Route::get('/shop/{page}', 'App\Http\Controllers\PagesController@__pageShopView')->name('childpages');

// end pages route
Route::post('/getChilCategory', 'App\Http\Controllers\CategoriesController@getChilCategory')->name('getChilCategory');
Route::post('/getListCategoryLimit', 'App\Http\Controllers\ProductsController@getListCategoryLimit')->name('getListCategoryLimit');
Route::post('/getQuickView', 'App\Http\Controllers\ProductsController@getQuickView')->name('getQuickView');
Route::post('/getListCategoryAll', 'App\Http\Controllers\ProductsController@getListCategoryAll')->name('getListCategoryAll');
Route::post('/getTown', 'App\Http\Controllers\PaymentController@getTown')->name('getTown');
Route::post('/getDistrict', 'App\Http\Controllers\PaymentController@getDistrict')->name('getDistrict');
//
Route::post('/send-message','App\Http\Controllers\ContactController@sendMessage')->name('send.message');
//
// admin
Route::get('/admin',function(){
    return redirect()->route('signup_Admin');
});
Route::get('/admin/login', 'App\Http\Controllers\PagesController@__pageAdminLoginView')->name('signup_Admin');
Route::post('/admin/checkSignin','App\Http\Controllers\AdminController@postLogin')->name('checkSignin');
Route::get('/admin/dashboard', 'App\Http\Controllers\PagesController@__pageDashboardView')->name('dashboard');
// categories
Route::get('/admin/categories/add', 'App\Http\Controllers\PagesController@CasAddView')->name('CasAddView');
Route::get('/admin/categories/Api_add', 'App\Http\Controllers\PagesController@AddformApiView')->name('AddformApiView');
Route::get('/admin/categories/delete/{Cid}', 'App\Http\Controllers\CategoriesController@deleteCat')->name('deleteCat');
Route::get('/admin/categories/management', 'App\Http\Controllers\PagesController@CasMPage')->name('CasMPageView');
Route::get('/admin/categories/management/{page}', 'App\Http\Controllers\PagesController@__pageCasManagementView')->name('CasManagement');
Route::post('/updatePageCatAdmin', 'App\Http\Controllers\PagesController@updatePageCatAdmin')->name('updatePageCatAdmin');
Route::get('//admin/categories/management/catdetail/{Cid}', 'App\Http\Controllers\PagesController@__pageCatDetailView')->name('CatDetail');
Route::post('/updateCat', 'App\Http\Controllers\CategoriesController@updateCat')->name('updateCat');
Route::post('/addCat', 'App\Http\Controllers\CategoriesController@addCat')->name('addCat');
Route::post('/adminCatSearch', 'App\Http\Controllers\CategoriesController@adminCatSearch')->name('adminCatSearch');
// products
Route::get('/admin/product_changePages/{page}', 'App\Http\Controllers\PagesController@prodAdminPagesView')->name('Admin_MProducts_Pages');
Route::get('/admin/products/{page}/{p}', 'App\Http\Controllers\PagesController@prodAdminView')->name('Admin_MProducts');
Route::post('/updatePageProdAdmin', 'App\Http\Controllers\PagesController@updatePageProdAdmin')->name('updatePageProdAdmin');
Route::get('/admin/products', 'App\Http\Controllers\PagesController@adminCP')->name('adminChagePageProducts');
Route::get('/admin/Products/detail/{Pid}', 'App\Http\Controllers\PagesController@__pageProdDetailView')->name('ProDetail');
Route::post('/changeProd', 'App\Http\Controllers\ProductsController@changeProd')->name('changeProd');
Route::get('/admin/Products/addProdView', 'App\Http\Controllers\PagesController@addProdView')->name('addProdView');
Route::post('/addProd', 'App\Http\Controllers\ProductsController@addProd')->name('addProd');
Route::post('/searchProd', 'App\Http\Controllers\ProductsController@searchProd')->name('searchProd');
Route::get('/admin/Products/search/{page}', 'App\Http\Controllers\PagesController@ProdSearchView')->name('ProdSearchView');
Route::get('/admin/Products/delete/{Pid}', 'App\Http\Controllers\ProductsController@deletePro')->name('deletePro');
Route::get('/admin/Products/AddFormApi/{Cid}', 'App\Http\Controllers\ProductsController@addProductFormApi')->name('addProductFormApi');
Route::get('/admin/Products/newProDetail/{tempPid}', 'App\Http\Controllers\PagesController@__pageNewProDetailView')->name('NewProDetail');
//
// Orders
Route::get('/admin/Orders', 'App\Http\Controllers\PagesController@getOrder')->name('getOrder');
Route::get('/admin/Orders/OrderDetail/{Oid}', 'App\Http\Controllers\PagesController@orderDetails')->name('orderDetails');
Route::get('/admin/Accset/{ODid}', 'App\Http\Controllers\AdminController@accsetOrder')->name('accsetOrder');
Route::get('/admin/Cancel/{ODid}', 'App\Http\Controllers\AdminController@cancelOrder')->name('cancelOrder');
Route::post('/searchOrder', 'App\Http\Controllers\AdminController@searchOrder')->name('searchOrder');
