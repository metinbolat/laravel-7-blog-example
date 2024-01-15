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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//USER ROUTES
Route::namespace('Backend')->group(function () {


	Route::prefix('admin')->group(function () {
		Route::middleware('auth')->group(function () {
			Route::get('/', 'PostController@dashboard')->name('admin_index');
			//CKEDITOR FILE UPLOAD ROUTE
			Route::post('ckeditor/image_upload', 'PostController@ckupload')->name('upload');

			Route::post('upload-avatar', 'UserController@uploadAvatar')->name('upload_avatar');
			//POST ROUTES
			Route::get('/posts', 'PostController@index')->name('post_index');
			Route::get('/posts/my', 'PostController@my')->name('post_my');
			Route::get('/posts/published', 'PostController@pub')->name('post_pub');
			Route::get('/posts/draft', 'PostController@draft')->name('post_draft');
			Route::get('/posts/trashed', 'PostController@trashed')->name('post_trashed');
			Route::get('/posts/new', 'PostController@create')->name('post_new');
			Route::post('/posts/new', 'PostController@store')->name('post_create');
			Route::delete('/posts/{post}/delete', 'PostController@delete')->name('post_delete');
			Route::delete('/posts/{post}/recover', 'PostController@recover')->name('post_recover');
			Route::delete('/posts/{post}/destroy', 'PostController@destroy')->name('post_destroy');
			Route::get('/posts/{id}/edit', 'PostController@edit')->name('post_edit');
			Route::post('/posts/{id}/edit', 'PostController@update')->name('post_update');

			//PAGE ROUTES
			Route::get('/pages', 'PostController@page_index')->name('page_index');
			Route::get('/pages/my', 'PostController@page_my')->name('page_my');
			Route::get('/pages/published', 'PostController@page_pub')->name('page_pub');
			Route::get('/pages/draft', 'PostController@page_draft')->name('page_draft');
			Route::get('/pages/trashed', 'PostController@page_trashed')->name('page_trashed');
			Route::get('/pages/new', 'PostController@page_create')->name('page_new');
			Route::post('/pages/new', 'PostController@page_store')->name('page_create');
			Route::get('/pages/{id}/edit', 'PostController@page_edit')->name('page_edit');
			Route::post('/pages/{id}/edit', 'PostController@page_update')->name('page_update');
			//COMMENT ROUTES
			Route::get('/comments/published', 'CommentController@index')->name('comment_index');
			Route::get('/comments/pending', 'CommentController@pend')->name('comment_pend');
			Route::get('/comments/trashed', 'CommentController@trashed')->name('comment_trashed');
			Route::get('/comments/{id}/edit', 'CommentController@edit')->name('comment_edit');
			Route::post('/comments/{id}/edit', 'CommentController@update')->name('comment_update');
			Route::post('/comments/{id}/publish', 'CommentController@publish')->name('comment_publish');
			Route::delete('/comments/{id}/delete', 'CommentController@delete')->name('comment_delete');
			Route::delete('/comments/{id}/recover', 'CommentController@recover')->name('comment_recover');
			Route::delete('/comments/{id}/destroy', 'CommentController@destroy')->name('comment_destroy');
			//ADMIN ROUTES
			Route::middleware('checkadmin')->group(function () {
				Route::get('/users', 'UserController@index')->name('user_index');
				Route::get('/users/profile/{id}', 'UserController@show')->name('user_show');
				Route::get('/settings', 'SettingController@index')->name('admin_settings');
				Route::get('/settings/{key}/edit', 'SettingController@edit')->name('admin_settings_edit');
				Route::patch('/settings/{key}/update', 'SettingController@update')->name('admin_settings_update');
			});
			//CATEGORY ROUTES
			Route::get('/categories', 'CategoryController@index')->name('category.index');
			Route::get('/categories/new', 'CategoryController@create')->name('category.new');
			Route::post('/categories/new', 'CategoryController@store')->name('category.create');
			Route::get('/categories/{id}/edit', 'CategoryController@edit')->name('category.edit');
			Route::post('/categories/{id}/update', 'CategoryController@update')->name('category.update');
			Route::delete('/categories/{id}/delete', 'CategoryController@destroy')->name('category.destroy');
			//TAG ROUTES
			Route::get('/tags', 'TagController@index')->name('tag.index');
			Route::get('/tags/new', 'TagController@create')->name('tag.new');
			Route::post('/tags/new', 'TagController@store')->name('tag.create');
			Route::get('/tags/{id}/edit', 'TagController@edit')->name('tag.edit');
			Route::post('/tags/{id}/update', 'TagController@update')->name('tag.update');
			Route::delete('/tags/{id}/delete', 'TagController@destroy')->name('tag.destroy');
		});
	});
});

//PUBLIC ROUTES
Route::namespace('Frontend')->group(function () {
	Route::get('/', 'PostController@index')->name('post.index');
	Route::get('/{slug}', 'PostController@show')->name('post.show');
	Route::post('/post/make-comment', 'CommentController@store')->name('make.comment');

	Route::get('/us/contact', 'DefaultController@contact')->name('contact');

	Route::get('/tag/{tag}', 'DefaultController@tag')->name('tag');
	Route::get('/category/{category}', 'DefaultController@category')->name('category');
});
