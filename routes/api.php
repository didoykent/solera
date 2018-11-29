<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('mega_signin', 'Api\Auth\SignInController@megaSignIn');

Route::group(['middleware' => ['jwt.auth']], function(){

Route::post('mega_logout', 'Api\Auth\LogOutController@megaLogOut');

Route::get('getReport', 'Api\ReportController@getReport');

Route::post('editItem', 'Api\ReportController@editItem');

Route::post('createItem',  'Api\ReportController@createItem');

Route::post('deleteItem', 'Api\ReportController@deleteItem');


});
