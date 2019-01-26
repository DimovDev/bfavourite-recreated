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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['as' => 'admin.'],function() {
  
    Route::get('/admin/home', 'Admin\HomeController@index')->name('home');

    Route::get('admin/users', 'Admin\UsersController@index')->name('users.index');
    Route::get('admin/users/{user}/edit', 'Admin\UsersController@edit')->name('users.edit');
    Route::get('admin/users/create', 'Admin\UsersController@create')->name('users.create');
    Route::post('admin/users', 'Admin\UsersController@store')->name('users.store');
    Route::put('admin/users/{user}', 'Admin\UsersController@update')->name('users.update');
    Route::delete('admin/users/destroy', 'Admin\UsersController@destroy')->name('users.destroy'); 
    
    Route::get('admin/categories', 'Admin\CategoriesController@index')->name('categories.index');
    Route::get('admin/categories/{category}/edit', 'Admin\CategoriesController@edit')->name('categories.edit');
    Route::get('admin/categories/create', 'Admin\CategoriesController@create')->name('categories.create');
    Route::post('admin/categories', 'Admin\CategoriesController@store')->name('categories.store');
    Route::put('admin/categories/{category}', 'Admin\CategoriesController@update')->name('categories.update');
    Route::delete('admin/categories/destroy', 'Admin\CategoriesController@destroy')->name('categories.destroy'); 

    Route::get('admin/posts', 'Admin\PostsController@index')->name('posts.index');
    Route::get('admin/posts/{post}/edit', 'Admin\PostsController@edit')->name('posts.edit');
    Route::get('admin/posts/create', 'Admin\PostsController@create')->name('posts.create');
    Route::post('admin/posts', 'Admin\PostsController@store')->name('posts.store');
    Route::put('admin/posts/{post}', 'Admin\PostsController@update')->name('posts.update');
    Route::delete('admin/posts/destroy', 'Admin\PostsController@destroy')->name('posts.destroy'); 

    Route::get('admin/projects', 'Admin\ProjectsController@index')->name('projects.index');
    Route::get('admin/projects/{project}/edit', 'Admin\ProjectsController@edit')->name('projects.edit');
    Route::get('admin/projects/create', 'Admin\ProjectsController@create')->name('projects.create');
    Route::post('admin/projects', 'Admin\ProjectsController@store')->name('projects.store');
    Route::put('admin/projects/{project}', 'Admin\ProjectsController@update')->name('projects.update');
    Route::delete('admin/projects/destroy', 'Admin\ProjectsController@destroy')->name('projects.destroy'); 

});

