<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'MessageController@index')->name('home');
Route::get('/create/{id?}/{subject?}', 'MessageController@create')->name('create-message');
Route::post('/send', 'MessageController@store')->name('send_message');
Route::get('/sent', 'MessageController@showSentMessages')->name('sent_messages');
Route::get('/read/{id}', 'MessageController@readMessage')->name('read-message');
Route::get('/delete/{id}', 'MessageController@destroy')->name('delete-message');
Route::get('/deleted', 'MessageController@deleted')->name('deleted-messages');
Route::get('/deleted/{id}', 'MessageController@recoverMessages')->name('deleted-message');
