<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/admin-panel', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/dashboard', 'HomeController@index')->name('dashboard');


Route::group(['prefix' => 'dashboard', 'middleware' => ['auth'],], function() {
		
		Route::resource('/user', UsersController::class);            

		Route::get('/', 'BackendController@index')->name('backend.index');

		Route::resource('/productCategory', ProductCategoryController::class);
		Route::get('/productCategorydatatable', 'ProductCategoryController@anyData')->name('get.proguctCategorys');

		Route::resource('/product', ProductController::class);
		Route::get('/productdatatable', 'ProductController@anyData')->name('get.product');
		
		Route::resource('/productImage', ProductImageController::class);
		Route::get('/productImagedatatable', 'ProductImageController@anyData')->name('get.productImage');
 });
