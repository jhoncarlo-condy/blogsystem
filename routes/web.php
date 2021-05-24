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

use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();


//admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('/admin/users', 'Admin\UserController');
    Route::get('/admin/dashboard', 'Admin\UserController@dashboard')->name('users.dashboard');
    Route::resource('/admin/categories', 'Admin\CategoryController');
    Route::resource('/admin/posts', 'Admin\PostController');
});


Route::view('categories','users.categories.allcategory',[
    'datas'=> App\Category::all()
])->name('list');
Route::get('/comments/{id}', 'CommentController@show')->name('allcomments');


Route::resource('/users/blog/post', 'User\PostController');
Route::resource('/users/blog/category', 'User\CategoryController');


//user routes
Route::middleware(['auth'])->group(function () {
    Route::post('/profile','ProfileController@store')->name('changepassword');
    Route::get('/profile/view/{id}','ProfileController@show')->name('viewprofile');
    Route::get('/blog/profile/view', 'PostController@profile')->name('profile');
    Route::resource('/comment','CommentController');

});
