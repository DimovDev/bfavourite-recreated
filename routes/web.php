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
})->middleware('siteNavigation');

Route::group(['middleware' =>['adminMenu','siteNavigation']], function() {

              Auth::routes();

              });

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['as' => 'admin.',
              'middleware' =>['adminMenu', 'siteNavigation']], function() {
  
    Route::get('/admin/home', 'Admin\HomeController@index')->name('home');
    Route::get('admin/test', 'Admin\HomeController@test')->name('test');

    Route::get('admin/users', 'Admin\UsersController@index')->name('users.index');
    Route::get('admin/users/{user}/edit', 'Admin\UsersController@edit')->name('users.edit');
    Route::get('admin/users/create', 'Admin\UsersController@create')->name('users.create');
    Route::post('admin/users', 'Admin\UsersController@store')->name('users.store');
    Route::put('admin/users/{user}', 'Admin\UsersController@update')->name('users.update');
    Route::delete('admin/users/destroy', 'Admin\UsersController@destroy')->name('users.destroy'); 

    Route::get('admin/assets/auto', 'Admin\AssetsController@autocomplete')->name('assets.auto');
    
    Route::get('admin/tags', 'Admin\TagsController@index')->name('tags.index');
    Route::get('admin/tags/auto', 'Admin\TagsController@autocomplete')->name('tags.auto');
    Route::get('admin/tags/{category}/edit', 'Admin\TagsController@edit')->name('tags.edit');
    Route::get('admin/tags/create', 'Admin\TagsController@create')->name('tags.create');
    Route::post('admin/tags', 'Admin\TagsController@store')->name('tags.store');
    Route::put('admin/tags/{category}', 'Admin\TagsController@update')->name('tags.update');
    Route::delete('admin/tags/destroy', 'Admin\TagsController@destroy')->name('tags.destroy'); 

    Route::get('admin/posts', 'Admin\PostsController@index')->name('posts.index');
    Route::get('admin/posts/{post}/edit', 'Admin\PostsController@edit')->name('posts.edit');
    Route::get('admin/posts/create', 'Admin\PostsController@create')->name('posts.create');
    Route::post('admin/posts', 'Admin\PostsController@store')->name('posts.store');
    Route::put('admin/posts/{post}', 'Admin\PostsController@update')->name('posts.update');
    Route::delete('admin/posts/destroy', 'Admin\PostsController@destroy')->name('posts.destroy'); 

    Route::get('admin/assets', 'Admin\AssetsController@index')->name('assets.index');
    Route::delete('admin/assets/destroy', 'Admin\AssetsController@destroy')->name('assets.destroy'); 

    Route::get('admin/photos/{photo}/edit', 'Admin\PhotosController@edit')->name('photos.edit');
    Route::get('admin/photos/create', 'Admin\PhotosController@create')->name('photos.create');
    Route::post('admin/photos', 'Admin\PhotosController@store')->name('photos.store');
    Route::put('admin/photos/{photo}', 'Admin\PhotosController@update')->name('photos.update');

    Route::get('admin/links/{link}/edit', 'Admin\LinksController@edit')->name('links.edit');
    Route::get('admin/links/create', 'Admin\LinksController@create')->name('links.create');
    Route::post('admin/links', 'Admin\LinksController@store')->name('links.store');
    Route::put('admin/links/{photo}', 'Admin\LinksController@update')->name('links.update');
    Route::post('admin/links/opengraph', 'Admin\LinksController@opengraph')->name('links.opengraph');

    Route::get('admin/notes/{note}/edit', 'Admin\NotesController@edit')->name('notes.edit');
    Route::get('admin/notes/create', 'Admin\NotesController@create')->name('notes.create');
    Route::post('admin/notes', 'Admin\NotesController@store')->name('notes.store');
    Route::put('admin/notes/{note}', 'Admin\NotesController@update')->name('notes.update');


  
    Route::get('admin/projects', 'Admin\ProjectsController@index')->name('projects.index');
    Route::get('admin/projects/{project}/edit', 'Admin\ProjectsController@edit')->name('projects.edit');
    Route::get('admin/projects/create', 'Admin\ProjectsController@create')->name('projects.create');
    Route::post('admin/projects', 'Admin\ProjectsController@store')->name('projects.store');
    Route::put('admin/projects/{project}', 'Admin\ProjectsController@update')->name('projects.update');
    Route::delete('admin/projects/destroy', 'Admin\ProjectsController@destroy')->name('projects.destroy');
    
    Route::get('admin/media', 'Admin\MediaController@index')->name('media.index');
    Route::get('admin/media/{file}/edit', 'Admin\MediaController@edit')->name('media.edit');
    Route::get('admin/media/create', 'Admin\MediaController@create')->name('media.create');
    Route::post('admin/media', 'Admin\MediaController@store')->name('media.store');
    Route::put('admin/media/{file}', 'Admin\MediaController@update')->name('media.update');
    Route::delete('admin/media/destroy', 'Admin\MediaController@destroy')->name('media.destroy'); 

    

});

