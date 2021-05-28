<?php

use App\Events\FormSubmittedEvent;
use App\Events\MyEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Auth::routes();
//admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('/admin/users', 'Admin\UserController');
    Route::get('/admin/categories/all', 'Admin\CategoryController@realtimecategory')->name('realtimecategory');
    Route::get('/admin/dashboard', 'Admin\UserController@dashboard')->name('users.dashboard');
    Route::resource('/admin/categories', 'Admin\CategoryController');
    Route::resource('/admin/posts', 'Admin\PostController');
});
//user routes
Route::middleware(['auth'])->group(function () {
    Route::resource('/users/profile', 'ProfileController')->except(['show']);
    Route::resource('/comment','CommentController')->except(['show']);
});

//guests routes
Route::resource('/users/profile', 'ProfileController')->only(['show']);
Route::get('/allcategories','User\CategoryController@all')->name('list');
Route::get('/comments/{postcomments}', 'CommentController@show')->name('commentshow');
Route::get('/comment/{postcomments}','CommentController@realtimecomments')->name('realtimecomments');
Route::resource('/users/blogs/post', 'User\PostController');
Route::resource('/users/blogs/category', 'User\CategoryController');

Route::get('/event',function()
{
   event(new MyEvent('Hello world'));
});

Route::get('/listen',function()
{
    return view ('sample');
});

Route::get('/form',function()
{
    return view ('form');
});

Route::post('/submit',function(Request $request){
    $text = $request->text;

    event(new FormSubmittedEvent($text));
    return redirect('/form');
});
