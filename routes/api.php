<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/v1', function () {
    return response()->json([ 
        "slackUsername" => "ruxy1212", 
        "backend" => true, 
        "age" => 26, 
        "bio" => "A driven and hardworking individual, aspiring to be a fullstack web-developer, working with PHP language and Laravel framework."
    ]);

    //testing different
    // $response = [ "slackUsername" => 'String', "backend" => true, "age" => 26, "bio" => 'String' ];
    // return $response;
    //$request->user();
});
