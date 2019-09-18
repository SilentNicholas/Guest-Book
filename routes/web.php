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

Route::get('/', 'CommentController@index');
Route::get('/user/{id}', 'UserController@show')->where('id', '[0-9]+');
Route::post('/user', 'FormController@create');
Route::group(['prefix' => '/admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'DashboardController@index');
    Route::get('/users', ['as' => 'admin.users', 'uses' => 'UserController@index']);
    Route::get('/comments', ['as' => 'admin.comments', 'uses' => 'CommentController@index']);
    Route::get('/user/{id}/edit', ['as' => 'user.edit', 'uses' => 'UserController@edit']);
    Route::get('/comment/{id}/edit', ['as' => 'comment.edit', 'uses' => 'CommentController@edit']);
    Route::delete('/user/{id}/delete', ['as' => 'user.destroy', 'uses' => 'UserController@destroy']);
    Route::delete('/comment/{id}/delete', ['as' => 'comment.destroy', 'uses' => 'CommentController@destroy']);
});