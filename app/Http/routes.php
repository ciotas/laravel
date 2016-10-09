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
Route::group(['prefix' => 'api/v1'], function () {
    Route::resource('lessons','api\LessonsController');
});


Route::group(['middleware' => 'web'], function () {

    Route::get('/logout','UsersController@logout');
    Route::post('/posts/upload','PostsController@upload');
    Route::resource('posts','PostsController');
    Route::resource('comment','CommentsController');
//    Route::auth();

    Route::get('/user/register','UsersController@register');
    Route::get('/user/login','UsersController@login');
    Route::get('/login','UsersController@github');//github登录
    Route::get('/github/login','UsersController@githubLogin');//github登录callback url
    Route::get('/user/avatar','UsersController@avatar');
    Route::post('/crop/api','UsersController@cropAvatar');
    Route::post('/user/avatar','UsersController@changeavatar');
    Route::post('/user/login','UsersController@signin');
    Route::get('/verify/{confirm_code}','UsersController@confirmEmail');
    Route::resource('user','UsersController');
    Route::resource('lessons','LessonsController');
    Route::resource('favourite','FavouritesController');
    Route::resource('articles','ArticlesController');
    Route::get('/', 'HomeController@index');

    Route::get('/success',function (){
        return 'register success';
    });



});
