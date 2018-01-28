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

Route::middleware('auth:api')->get('/usr', function (Request $request) {
    return $request->user();
});

Route::post('/warap', ['uses' => 'HomeController@warap'])->middleware('jwt.auth');

Route::post('/authenticated', ['uses' => 'UserController@isAuthenticated']);

Route::post('/signout', ['uses' => 'UserController@signOut']);

Route::post('/signup', ['uses' => 'UserController@signup']);

Route::post('/signin', ['uses' => 'UserController@signin']);


//Route::options('endpoint', function() {
//    return response('OK')
//        ->header('Access-Control-Allow-Headers ', 'Origin, Authorization, X-Requested-With, Content-Type, Accept')
//        ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS')
//        ->header('Access-Control-Allow-Origin', '*')
//        ->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0')
//        ;
//});