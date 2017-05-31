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


// route home admin
Route::get('/','MenuController@index')->name('menu.index');


Auth::routes();

Route::group(['prefix'=>'admin'],function(){
	
	Route::get('/login',"Auth\LoginController@index");
	// route Menu phía user
	Route::get('/home', 'HomeController@index')->name('home');
	// route Category phía admin
	Route::resource('/list-menu','ListMenuController');

	// route Food admin

	Route::resource('/list-food','ListFoodController');

	// route Book Tables admin
	Route::resource('/book-tables','BookTableController');

	// route menu Top 
	Route::resource('/menu-top','MenuTopController');

	Route::get('/users','UserController@index')->name('users.index');
});


