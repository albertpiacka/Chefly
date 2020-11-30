<?php

use Illuminate\Support\Facades\Route;

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
/**
 * Routes for authentication
 */
Auth::routes();
Route::get('/profile', 'HomeController@index')->name('profile');

/**
 * Routes for pages
 */
Route::get('/', 'PagesController@home');

/**
 * Routes for posts
 */
Route::resource('posts', 'PostController');

/**
 * Routes for users
 */
Route::resource('users', 'UserController');

/**
 * Routes for comments
 */
Route::resource('comments', 'CommentController');

/**
 * Routes for likes
 */
Route::resource('likes', 'LikeController');

/**
 * Routes for follows
 */
Route::resource('follows', 'FollowController');

/**
 * Routes for conversations
 */
Route::resource('conversations', 'ConversationController');

/**
 * Routes for messages
 */
Route::resource('messages', 'MessageController');

/**
 * Admin
 */
Route::get('admin/{any?}', function () {
    return view('layouts.admin');
})->where('any', '.*')->middleware('auth');