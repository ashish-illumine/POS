<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

Route::get('/category', ['uses' => 'ApiController@category']); // fetch all categories

Route::post('/add_category', ['uses' => 'ApiController@addUpdateCategory']); // add new category

Route::post('/edit_category/{id}', ['uses' => 'ApiController@editCategory']); // edit category

Route::post('/delete_category', ['uses' => 'ApiController@deleteCategory']); // delete category

Route::get('/product', ['uses' => 'ApiController@product']); // fetch all product

Route::post('/add_product', ['uses' => 'ApiController@addUpdateProduct']); // add new product

Route::post('/edit_product/{id}', ['uses' => 'ApiController@editProduct']); // edit product

Route::post('/delete_product', ['uses' => 'ApiController@deleteProduct']); // delete product
