<?php
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
//user routes
Route::middleware(['auth'])->group(function () {
    Route::post('/profile','ProfileController@store')->name('changepassword');
    Route::get('/profile/view/{id}','ProfileController@show')->name('viewprofile');
    Route::get('/blog/profile/view', 'PostController@profile')->name('profile');
    Route::resource('/comment','CommentController');

});
//guests routes
Route::view('categories','CommentController@allcomments')->name('list');
Route::get('/comments/{id}', 'CommentController@show')->name('allcomments');
Route::resource('/users/blog/post', 'User\PostController');
Route::resource('/users/blog/category', 'User\CategoryController');

