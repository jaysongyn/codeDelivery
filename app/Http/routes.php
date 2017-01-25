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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'admin','middleware' => 'auth.checkrole','as'=>'admin.'],function(){

    Route::get('categories/index',['as' => 'categories.index', 'uses' => 'CategoriesController@index'] );
    Route::get('categories/create',['as' => 'categories.create', 'uses' => 'CategoriesController@create']);
    Route::post('categories/create',['as' => 'categories.store', 'uses' => 'CategoriesController@store']);
    Route::get('categories/edit/{id}',['as' => 'categories.edit', 'uses' => 'CategoriesController@edit']);
    Route::post('categories/update/{id}',['as' => 'categories.update', 'uses' => 'CategoriesController@update']);

    Route::get('products/index',['as' => 'products.index', 'uses' => 'ProductsController@index'] );
    Route::get('products/create',['as' => 'products.create', 'uses' => 'ProductsController@create']);
    Route::post('products/create',['as' => 'products.store', 'uses' => 'ProductsController@store']);
    Route::get('products/edit/{id}',['as' => 'products.edit', 'uses' => 'ProductsController@edit']);
    Route::post('products/update/{id}',['as' => 'products.update', 'uses' => 'ProductsController@update']);
    Route::get('products/destroy/{id}',['as' => 'products.destroy', 'uses' => 'ProductsController@destroy']);

    Route::get('clients/index',['as' => 'clients.index', 'uses' => 'ClientsController@index'] );
    Route::get('clients/create',['as' => 'clients.create', 'uses' => 'ClientsController@create']);
    Route::post('clients/create',['as' => 'clients.store', 'uses' => 'ClientsController@store']);
    Route::get('clients/edit/{id}',['as' => 'clients.edit', 'uses' => 'ClientsController@edit']);
    Route::post('clients/update/{id}',['as' => 'clients.update', 'uses' => 'ClientsController@update']);
    Route::get('clients/destroy/{id}',['as' => 'clients.destroy', 'uses' => 'ClientsController@destroy']);

    Route::get('orders/index',['as' => 'orders.index', 'uses' => 'OrdersController@index'] );
    Route::get('orders/create',['as' => 'orders.create', 'uses' => 'OrdersController@create']);
    Route::post('orders/create',['as' => 'orders.store', 'uses' => 'OrdersController@store']);
    Route::get('orders/edit/{id}',['as' => 'orders.edit', 'uses' => 'OrdersController@edit']);
    Route::post('orders/update/{id}',['as' => 'orders.update', 'uses' => 'OrdersController@update']);
    Route::get('orders/destroy/{id}',['as' => 'orders.destroy', 'uses' => 'OrdersController@destroy']);

    Route::get('orders/itens/{id}',['as' => 'ordersItens.index', 'uses' => 'OrdersController@items']);

});

Route::get('/test', function(){
   $repository = app()->make('CodeDelivery\Repositories\CategoryRepository');
   return $repository->all();
});