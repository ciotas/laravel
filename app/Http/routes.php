<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {

    Route::get('/logout','UsersController@logout');
    Route::resource('posts','PostsController');
    Route::resource('comment','CommentsController');
//    Route::auth();

    Route::get('/user/register','UsersController@register');
    Route::get('/user/login','UsersController@login');
    Route::post('/user/login','UsersController@signin');
    Route::get('/verify/{confirm_code}','UsersController@confirmEmail');
    Route::resource('user','UsersController');
    Route::get('/', 'HomeController@index');
    Route::get('/success',function (){
        return 'register success';
    });



});
