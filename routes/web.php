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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// route home admin
Route::get('/home', 'HomeController@index')->name('home');

// route Menu phía user
Route::get('/menu','MenuController@index')->name('menu.index');

// route Category phía admin
Route::resource('/list-menu','ListMenuController');

// route Food admin

Route::resource('/list-food','ListFoodController');

// route Book Tables admin
Route::resource('/book-tables','BookTableController');

// route menu Top 
Route::resource('/menu-top','MenuTopController');

