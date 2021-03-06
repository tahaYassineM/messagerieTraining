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

// Route::resource('conversations', 'ConversationController')->middleware('auth');
Route::get('conversations', 'ConversationController@index')->name('conversations')->middleware('auth');
Route::get('conversations/{user}', 'ConversationController@show')->name('conversations.show')->middleware(['auth', 'can:talkTo,user']);
Route::post('conversations/{user}', 'ConversationController@store')->middleware(['auth', 'can:talkTo,user']);
