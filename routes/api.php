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

Route::prefix('hello')->group(function(){
    Route::get('/', function() {
        return response()->json(['message'=>'hello']);
    });

    Route::get('{name}', function($name) {
        return response()->json(['message'=>"hello $name"]);
    });
});

Route::get('hello',"HelloController@index");

Route::get('color',"HelloController@color");

Route::get('ibw',"HelloController@ibw");

Route::get('hospitals',"HospitalController@index");
Route::get('hospitals/{id}',"HospitalController@show");

// Route::prefix('hospitals')->group(function(){
//     Route::get('/',"HospitalController@index")->middleware('auth:api');
//     Route::get('{id}',"HospitalController@show")->middleware('auth:api');
//     Route::post('/',"HospitalController@store")->middleware('auth:api');
//     Route::delete('{id}',"HospitalController@destroy")->middleware('auth:api');
// });