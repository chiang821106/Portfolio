<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// 首頁

Route::get('/', "exController@index");

// 後台管理 

  // 後台-員工
Route::get('/backstage_employees', 'EmployeesController@backstage_employees');
  // 後台-訂單
Route::get('/backstage_order', 'EmployeesController@backstage_order');
  // 後台-訂單明細
Route::get('/backstage_order_detail{id}', 'EmployeesController@backstage_order_detail');

// 撈出管理員資料
Route::get("users", 'GroceryController@action');
// 新增管理員
Route::post('/grocery/post', 'GroceryController@store');
// 修改管理員
Route::post('/grocery/update/{id}', 'GroceryController@update');
// 停權管理員
Route::post('/grocery/delete/{id}', 'GroceryController@Suspension');
// 取消停權管理員
Route::post('/grocery/canel/{id}', 'GroceryController@CanelSuspension');
// 訂單狀態
Route::post('/update-detail{id}', 'OrderController@edit');
// 日期查詢訂單
Route::post('/finddetail','OrderController@finddetail');

//----------------------------------------------------------------------------

// 會員(登入/註冊)
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/password.request',"Auth\ForgotPasswordController@forgot");




//----------------------------------------------------------------------------

// 直接購買

  // 商品區頁面
Route::get('/products', 'ProductsController@index');
  // 購物車頁面
Route::get('cart', 'ProductsController@cart');
  // 商品item頁面(選size color)
Route::get('/item{id}','GroceryController@item');
  // 商品加入購物車
Route::post('/lucky{id}','ProductsController@addToCart');
  // 商品訂單頁面
Route::get('products_order', 'ProductsController@order');
  // 更新購物車商品
Route::patch('update-cart', 'ProductsController@update');
  // 移除購物車商品
Route::delete('remove-from-cart', 'ProductsController@remove');
  // 商品訂單
Route::post('/p_order', 'OrderController@store');
// popular
Route::get('/popular', 'ProductsController@popular');
// /newproducts
Route::get('/newproducts', 'ProductsController@newproducts');


//-----------------------------------------------------------------------------

// 會員中心

Route::get('/homes','exController@homes');
  // 修改會員資料
Route::post('/update-member{id}', 'EmployeesController@edit');
// 上傳大頭照
Route::post('/addimage{id}','EmployeesController@store')->name('addimage');
  // 訂單查詢
Route::get('/order{id}', 'exController@order');
  // 客製衣服上架
Route::get('/diysell{id}', 'DiyimageController@display');
  // 上架商品
Route::post('/shelfing{id}', 'DiyimageController@shelfing');
  // 下架商品
Route::post('/undercarriage{id}', 'DiyimageController@undercarriage');

//-----------------------------------------------------------------------------

// 動手設計
  // 動手設計頁面
Route::get('/custom','DiyimageController@index');
  // 上傳客製化成品
Route::post('/saveimg{id}','DiyimageController@saveimg');

//-----------------------------------------------------------------------------