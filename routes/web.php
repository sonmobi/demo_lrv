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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/user','UserController@Index')->name('User.Index');
Route::match(['get','post'],'/user/add','UserController@Add') ->name('User.Add');
Route::match(['get','post'],'/user/edit/{id}','UserController@Edit')
    ->where(['id'=>'[0-9]+'])
    ->name('User.Edit');
Route::match(['get','post'],'/user/delete/{id}','UserController@Delete')
    ->where(['id'=>'[0-9]+'])
    ->name('User.Delete');


Route::match(['get','post'],'/upload','AdminController@Upload') ->name('User.Upload');
