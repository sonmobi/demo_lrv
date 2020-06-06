<?php

use Illuminate\Support\Facades\Route;


//=========== phần Public không chặn quyền ===============================
Route::get('/', function () {
    return view('welcome');
});
//--------------- auth------------
Route::match(['get','post'],'/login','AuthController@Login')
    ->name('Auth.Login');
Route::get('/logout','AuthController@Logout')
    ->name('Auth.Logout');


//=========== phần Private có yêu cầu đăng nhập ===============================

Route::middleware(['auth'])->group(function () {

    Route::get('/user','UserController@Index')->name('User.Index');
    Route::match(['get','post'],'/user/add','UserController@Add')
        ->name('User.Add');

    Route::match(['get','post'],'/user/edit/{id}','UserController@Edit')
        ->where(['id'=>'[0-9]+'])
        ->name('User.Edit');

    Route::match(['get','post'],'/user/delete/{id}','UserController@Delete')
        ->where(['id'=>'[0-9]+'])
        ->name('User.Delete');

    Route::match(['get','post'],'/upload','AdminController@Upload') ->name('User.Upload');

});




