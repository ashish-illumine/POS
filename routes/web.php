<?php

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

/* Include Views */
Route::get('/sidebar', function () {
    return view('layout/sidebar');
});

Route::get('/header', function () {
    return view('layout/header');
});

/* oAuth2 */
Auth::routes();

/* General Views */
Route::get('/', function(){
    return view('index'); // After login view
});

Route::get('/dashboard', function () {
    return view('dashboard'); // admin dashboard
});

Route::get('/category', function () {
    return view('category'); // categories page view
});

Route::get('/category_add_edit', function () {
    return view('category_add_edit'); // add category view
});

Route::get('/category_add_edit/{id}', function ($id) {
    return view('category_add_edit', compact($id)); // edit category view
});

Route::get('/product', function () {
    return view('product'); // products page view
});

Route::get('/product_add_edit', function () {
    return view('product_add_edit'); // add category view
});

Route::get('/product_add_edit/{id}', function ($id) {
    return view('product_add_edit', compact($id)); // edit category view
});
