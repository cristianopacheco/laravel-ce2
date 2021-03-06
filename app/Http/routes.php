<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::get('/', 'StoreController@index');

Route::get('/category/{id}',['as'=>'store.category','uses'=>'StoreController@category', 'where'=> ['id'=> '[0-9]+']] );
Route::get('/product/{id}',['as'=>'store.product','uses'=>'StoreController@product', 'where'=> ['id'=> '[0-9]+']] );
Route::get('/tag/{id}',['as'=>'store.tag','uses'=>'StoreController@tag', 'where'=> ['id'=> '[0-9]+']] );

Route::get('cart',['as'=>'cart','uses'=>'CartController@index'] );
Route::get('cart/add/{id}',['as'=>'cart.add','uses'=>'CartController@add'] );
Route::get('cart/destroy/{id}',['as'=>'cart.destroy','uses'=>'CartController@destroy'] );
Route::get('cart/update/{id}/{qtd}',['as'=>'cart.update','uses'=>'CartController@update'] );


Route::group(['middleware'=>'auth'], function(){
    
    Route::get('checkout/placeOrder',['as'=>'checkout.place','uses'=>'CheckoutController@place'] );
    Route::get('account/orders',['as'=>'account.orders','uses'=>'AccountController@orders'] );
    Route::get('checkout/placeOrder',['as'=>'checkout.place','uses'=>'CheckoutController@place'] );
    
});


Route::get('home', 'HomeController@index');

// Route::get('exemplo', 'WelcomeController@exemplo');

Route::group(['prefix'=>'admin','middleware'=>'auth,admin','middleware'=>'admin', 'where'=> ['id'=> '[0-9]+']], function ()
{
    
    Route::group(['prefix'=>'categories'],function(){
        // Rotas de Categories
        Route::get('/', ['as' => 'categories', 'uses' => 'CategoriesController@index']);
        Route::post('/',['as' => 'categories.store', 'uses' => 'CategoriesController@store']);
        Route::get('create', ['as' => 'categories.create', 'uses' => 'CategoriesController@create']);
        Route::get('destroy/{id}', ['as' => 'categories.destroy', 'uses' => 'CategoriesController@destroy']);
        Route::get('edit/{id}', ['as' => 'categories.edit', 'uses' => 'CategoriesController@edit']);
        Route::put('update/{id}', ['as' => 'categories.update', 'uses' => 'CategoriesController@update']);
    });
    
    Route::group(['prefix'=>'products'],function(){
        // Rotas de Products
        Route::get('/', ['as' => 'products', 'uses' => 'ProductsController@index']);
        Route::post('/',['as' => 'products.store', 'uses' => 'ProductsController@store']);
        Route::get('create', ['as' => 'products.create', 'uses' => 'ProductsController@create']);
        Route::get('destroy/{id}', ['as' => 'products.destroy', 'uses' => 'ProductsController@destroy']);
        Route::get('edit/{id}', ['as' => 'products.edit', 'uses' => 'ProductsController@edit']);
        Route::put('update/{id}', ['as' => 'products.update', 'uses' => 'ProductsController@update']);
        
        Route::group(['prefix'=>'images'],function(){

            Route::get('{id}/product', ['as' => 'products.images', 'uses' => 'ProductsController@images']);
            Route::get('create/{id}/product', ['as' => 'products.images.create', 'uses' => 'ProductsController@createImage']);
            Route::post('store/{id}/product', ['as' => 'products.images.store', 'uses' => 'ProductsController@storeImage']);
            Route::get('destroy/{id}/image', ['as' => 'products.images.destroy', 'uses' => 'ProductsController@destroyImage']);
            
        });
    });
    
    // Orders
    Route::group(['prefix'=>'orders'],function(){
        Route::get('/', ['as' => 'orders', 'uses' => 'OrdersController@index']);
        Route::get('edit/{id}', ['as' => 'orders.edit', 'uses' => 'OrdersController@edit']);
        Route::put('update/{id}', ['as' => 'orders.update', 'uses' => 'OrdersController@update']);
    });

});


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
