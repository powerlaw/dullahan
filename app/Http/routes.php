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

Route::get('/', function () {
    return view('welcome');
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


/**
 * @SWG\Swagger(
 *     schemes={"http"},
 *     host="api.vqiho.com",
 *     basePath="/v1",
 *     consumes={"application/xml", "application/json"},
 *     produces={"application/xml", "application/json"},
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="奇货API文档",
 *         description="项目代号Tiny(小小)",
 *         termsOfService="https://github.com/powrlaw",
 *         @SWG\Contact(
 *             name="xieyi",
 *             url="http://github.com/xieyi64",
 *             email="dev001@powerlaw.cn"
 *         ),
 *         @SWG\License(
 *             name="Apache 2.0",
 *             url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *         )
 *     ),
 *     @SWG\ExternalDocumentation(
 *         description="关于我们",
 *         url="http://powerlaw.cn"
 *     )
 * )
 */
Route::group(['middleware' => ['api'],'prefix'=>'v1'], function () {

    //视频
    Route::get('videos/favors', 'VideoFavorController@index');
    Route::delete('videos/{video_id}/favors', 'VideoFavorController@destroy');
    Route::resource('videos/{video_id}/favors', 'VideoFavorController');
    Route::resource('videos','VideoController');
    Route::any('videos/search','VideoController@search');

    //商品收藏
    Route::get('goods/favors', 'GoodFavorController@index');
    Route::delete('goods/{good_id}/favors', 'GoodFavorController@destroy');
    Route::resource('goods/{good_id}/favors', 'GoodFavorController');
    Route::resource('goods','GoodController');
    Route::any('goods/search','GoodController@search');

    //用户权限
    Route::any('auth/login', 'AuthController@login');
    Route::any('auth/logout', 'AuthController@logout');
    Route::any('auth/bind', 'AuthController@bind');
    Route::any('auth/unbind', 'AuthController@unbind');
    Route::any('auth/register', 'AuthController@register');
    Route::any('auth/id', 'AuthController@id');
    Route::any('auth/smscode', 'AuthController@smscode');
    Route::any('auth/bootstrap', 'AuthController@bootstrap');
    Route::any('auth/token', 'AuthController@token');

    //测试
    Route::any('test','TestController@test');
});

