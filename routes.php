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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/work', 'WorkController@index')->name('work');

    Route::resource('topic', 'TopicController');
    Route::resource('user', 'UserController');
    Route::resource('topic-user', 'TopicUserController');

    Route::post('/hide/{topic}', 'TopicController@hide')->name('topic.hide');
    Route::post('/count/{topic}', 'TopicController@count')->name('topic.count');
});