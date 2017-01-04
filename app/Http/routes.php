<?php

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
//Route::group(['prefix' => 'api/v1'], function () {
//    Route::resource('lessons','api\LessonsController');
//});
/*
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Api\Controllers'],function ($api){
        $api->post('user/login','AuthController@authenticate');
        $api->post('user/register','AuthController@register');
        $api->group(['middleware' => 'jwt.auth'],function ($api){
            $api->get('user/me','AuthController@getAuthenticatedUser');
            $api->get('lessons','LessonsController@index');
            $api->get('lessons/{id}','LessonsController@show');
        });

    });
});
*/

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
    Route::get('/stripe',function (){
//        app('billing')->stripe();
        app()->make('billing')->stripe();
    });

    Route::resource('task','TasksController');

    Route::resource('/pay','OrdersController@pay');
});

Route::group(['middleware' => 'cors'], function(){
    Route::get('api/tasks', 'TasksController@apitask');
    Route::get('api/tasks/{id}', 'TasksController@show');
    Route::post('api/tasks/create','TasksController@store');
    Route::delete('api/tasks/{id}/delete','TasksController@destroy');
    Route::patch('api/tasks/{id}/compete','TasksController@compete');
});
//Route::get('/tasks','TasksController@apitask')->middleware('cors:api');
//Route::group(['middleware' => 'cors:api'], function(){
//    Route::get('tasks','TasksController@apitask');
//});