<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
// |
*/




Route::resource('users', 'UserController');

Route::resource('questions', 'QuestionController',['except'=>['index','show']])
->middleware('auth');
Route::get('questions/{question}', 'QuestionController@show')->name('questions.show');
Route::get('/', 'QuestionController@index')->name('questions.index');
Route::resource('users', 'UserController');
Route::resource('questions.comments', 'CommentController');
Route::resource('tags', 'TagController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
