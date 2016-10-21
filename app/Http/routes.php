<?php
Auth::loginUsingId(1);
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
Route::get('oauth/authorize', ['as' => 'oauth.authorize.get', 'middleware' => ['check-authorization-params'], function() {
    $authParams = Authorizer::getAuthCodeRequestParams();
    $formParams = array_except($authParams,'client');

    $formParams['client_id'] = $authParams['client']->getId();

    $formParams['scope'] = implode(config('oauth2.scope_delimiter'), array_map(function ($scope) {
        return $scope->getId();
    }, $authParams['scopes']));

    return view('oauth.authorization-form', ['params' => $formParams, 'client' => $authParams['client']]);
}]);
Route::post('oauth/authorize', ['as' => 'oauth.authorize.post', 'middleware' => ['csrf', 'check-authorization-params'], function() {

    $params = Authorizer::getAuthCodeRequestParams();
    $params['user_id'] = Auth::user()->id;
    $redirectUri = '/';

    // If the user has allowed the client to access its data, redirect back to the client with an auth code.
    if (Request::has('approve')) {
        $redirectUri = Authorizer::issueAuthCode('user', $params['user_id'], $params);
    }

    // If the user has denied the client to access its data, redirect back to the client with an error message.
    if (Request::has('deny')) {
        $redirectUri = Authorizer::authCodeRequestDeniedRedirectUri();
    }

    return Redirect::to($redirectUri);
}]);
Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});
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

//Route::group(['middleware' => ['web']], function () {
//    //
//});
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
*/