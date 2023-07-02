<?php

use App\Http\Controllers\ProductsController;
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



Route::get('/header', function () {
    return view('layouts.header');
}) ->name('header');

//main page
Route::get('/',[ProductsController::class,'index'])->name('main');


//add to cart from main page
Route::get('main/addToCart/{id}',[ProductsController::class,'addProductToCart'])->name('AddToCart');

//add to cart from product detail page
Route::post('main/addToCartForm',[ProductsController::class,'addProductToCartForm'])->name('AddToCartForm');

// show cart items
Route::get('cart', ["uses" => "ProductsController@showCart",'as'=>'cartproducts']);

// update item from cart (increase/decrease)
Route::post('cart/updateItemFromCart',["uses" => 'ProductsController@updateItemFromCart','as'=>'UpdateFromCart']);

// delete item from cart
Route::get('cart/deleteItemFromCart/{id}',["uses" => 'ProductsController@deleteItemFromCart','as'=>'DeleteFromCart']);




//single product view
Route::get('main/product_view/{id}',["uses" => 'ProductsController@single_product','as'=>'ProductView']);

// login customer
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




//admin panel
Route::get('/admin', function () {
    return view('layouts.admin');
}) ->name('admin');

//admin panel product list
Route::get('admin/products', ["uses" => "admin\AdminProductsController@index",'as'=>'adminDisplayProducts']);


//admin panel edit product
Route::get('admin/editProduct/{id}',["uses" => "admin\AdminProductsController@editProductsForm",'as'=>'adminEditProducts']);

//admin panel submit changes after editing product
Route::post('admin/updateProducts/{id}', ["uses" => "admin\AdminProductsController@updateProducts",'as'=>'adminUpdateProducts']);


// admin panel product overview
Route::get('admin/overviewProduct/{id}',["uses" => "admin\AdminProductsController@overviewProduct",'as'=>'adminOverviewProducts']);


//admin panel add new product
Route::get('admin/addProducts', ["uses" => "admin\AdminProductsController@addProduct",'as'=>'adminAddProducts']);

//admin panel submit added product
Route::post('admin/addSubmitProducts', ["uses" => "admin\AdminProductsController@addSubmitProduct",'as'=>'adminAddSubmitProducts']);

//admin panel delete product
Route::get('admin/deleteProducts/{id}', ["uses" => "admin\AdminProductsController@deleteProduct",'as'=>'adminDeleteProducts']);

//admin panel delete product image
Route::get('admin/deleteProductImage/{id}',["uses" => "admin\AdminProductsController@deleteProductImage",'as'=>'adminDeleteProductImage']);



//admin panel edit main page images form
Route::get('admin/editMainPageImages',["uses" => 'admin\CustomImagesController@editMainImagesForm','as'=>'adminEditMainImagesForm']);

//admin panel edit main page images
Route::post('admin/EditMainPageImages',["uses" => 'admin\CustomImagesController@editMainImages','as'=>'adminEditMainImages']);

//admin panel delete main page images
Route::get('admin/deleteMainImage/{id}',["uses" => 'admin\CustomImagesController@deleteMainImage','as'=>'adminDeleteMainImages']);


//admin panel categories display
Route::get('admin/categories', ["uses" => "admin\AdminCategoriesController@index",'as'=>'adminDisplayCategories']);

//admin panel add categories
Route::get('admin/addCategories', ["uses" => "admin\AdminCategoriesController@addCategoryForm",'as'=>'adminAddCategoryForm']);

//admin panel add categories submit
Route::post('admin/submitCategories', ["uses" => "admin\AdminCategoriesController@addCategory",'as'=>'adminAddCategory']);

//admin panel add categories field
Route::get('admin/addCategoriesField', ["uses" => "admin\AdminCategoriesController@addCategoryField",'as'=>'adminAddCategoryField']);
