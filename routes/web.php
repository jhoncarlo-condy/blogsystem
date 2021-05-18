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
})->name('welcome');

Auth::routes();



// Route::get('/dashboard', 'UserController@index')->name('dashboard');
// Route::get('/category', '<Catego></Catego>ryController@index')->name('category');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('/users', 'UserController');
    Route::get('/dashboard', 'UserController@dashboard')->name('users.dashboard');
    Route::get('/dashboard/profile/{id}', 'UserController@viewprofile')->name('users.viewprofile');
    Route::resource('/category', 'CategoryController');
    Route::resource('/post', 'PostController');
});

Route::get('/blog/categories/list','BlogUserController@category')->name('categories');
Route::get('/blog/categories/view/{id}','BlogUserController@viewcat')->name('view');
Route::resource('/blog', 'BlogUserController');


Route::middleware(['auth'])->group(function () {
    Route::post('/profile','ProfileController@store')->name('changepassword');
    Route::get('/profile/view/{id}','ProfileController@show')->name('viewprofile');
    Route::get('/blog/profile/view', 'BlogUserController@profile')->name('profile');
    Route::resource('/comment','CommentController');

});
