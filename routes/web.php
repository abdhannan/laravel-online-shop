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
    // return view('welcome');
    // mengubah home jadi login
    return view("auth.login");
});

Auth::routes();

// Disable register dengan cara me redirect register ke login
Route::match(['get', 'post'], '/register', function () {
    return redirect("/login");
})->name("register");

Route::get('/home', 'HomeController@index')->name('home');

// Rouute user
Route::resource('users', 'UserController');

// Trash category
Route::get('/categories/trash', 'CategoryController@trash')->name('categories.trash');

// Restore category
Route::get('/categories/{id}/restore/', 'CategoryController@restore')->name('categories.restore');

// Route delete permanent category
Route::delete('/categories/{id}/delete-permanent', 'CategoryController@deletePermanent')->name('categories.delete-permanent');


// Route category
Route::resource('categories', 'CategoryController');

// Route ajaxSearch category
Route::get('/ajax/categories/search', 'CategoryController@ajaxSearch');



// Trashed book
Route::get('/books/trash', 'BookController@trash')->name('books.trash');

// Book route
Route::resource('books', 'BookController');
