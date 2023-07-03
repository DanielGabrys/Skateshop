<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\admin\AdminProductsController;
use App\Http\Controllers\admin\CustomImagesController;
use App\Http\Controllers\admin\AdminCategoriesController;

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


//main page
Route::get('/',[ProductsController::class,'index'])->name('main');

//single product view

Route::get('/product/{id}',["uses" => 'ProductsController@single_product','as'=>'ProductView']);


Route::group(['prefix' => 'cart'], function()
{

    /*
    // show cart items
    Route::get('/', [CartController::class,'showCart']) -> name('cartProducts');

    //add to cart
    Route::get('/add/{id}',[CartController::class,'store'])->name('AddToCart');

    // update cart items
    Route::post('/update',[CartController::class,'update']) ->name('UpdateFromCart');

    // delete item from cart
    Route::get('/delete/{id}',[ProductsController::class,'deleteItemFromCart'])->name("DeleteFromCart");
    */

});




Route::group(['prefix' => 'admin'], function()
{


    Route::get('/', function () {return view('layouts.admin');}) ->name('admin');


    Route::group(['prefix' => 'products'], function ()
    {
        //admin panel product list
        Route::get('/', [AdminProductsController::class,'index']) ->name('getProducts');

        //admin panel add new product
        Route::get('/add', [AdminProductsController::class, 'addProduct'])->name('addProduct');

        //admin panel submit added product
        Route::post('/add',[AdminProductsController::class, 'addSubmitProduct'])->name('storeProduct');


        //admin panel edit product view
        Route::get('/{id}',[AdminProductsController::class,'editProduct'])->name('editProduct');

        //admin panel submit changes after editing product
        Route::post('/{id}', [AdminProductsController::class,"updateProduct"])->name('updateProduct');


        // admin panel product overview
        Route::get('/{id}/overview',[AdminProductsController::class,'overviewProduct'])->name('overviewProduct');

        //admin panel delete product
        Route::get('/{id}/delete', [AdminProductsController::class, 'deleteProduct',])->name('deleteProduct');

        //admin panel delete product image
        Route::get('/{id}/deleteImage',[AdminProductsController::class, 'deleteProductImage'])->name('deleteProductImage');

    });

    Route::group(['prefix' => 'sliders'], function ()
    {
        //admin panel edit main page images form
        Route::get('/',[CustomImagesController::class ,'editSliders'])->name('editSliders');

        //admin panel edit main page images
        Route::post('/',[CustomImagesController::class ,'storeSliders'])->name('storeSliders');

        //admin panel delete main page images
        Route::get('/{id}/delete',[CustomImagesController::class ,'deleteSlider'])->name('deleteSlider');
    });

    Route::group(['prefix' => 'categories'], function ()
    {
        //admin panel categories display
        Route::get('/', [AdminCategoriesController::class,'index'])->name('getCategories');

        //admin panel add categories
        Route::get('/add', [AdminCategoriesController::class,'addCategory'])->name('addCategory');

        //admin panel store category
        Route::post('/add', [AdminCategoriesController::class,'storeCategory'])->name('storeCategory');

        //admin delete category
        Route::get('/{id}/delete',[AdminCategoriesController::class,'deleteCategory'])->name('deleteCategory');

    });


});

