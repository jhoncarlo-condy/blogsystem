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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



// Route::get('/dashboard', 'UserController@index')->name('dashboard');
// Route::get('/category', '<Catego></Catego>ryController@index')->name('category');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('/users', 'UserController');
    Route::get('/dashboard', 'UserController@dashboard')->name('users.dashboard');
    Route::resource('/category', 'CategoryController');
    Route::resource('/post', 'PostController');
});

Route::resource('/blog', 'BlogUserController');
