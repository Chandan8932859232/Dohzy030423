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

// **** funds routes *** //
//list applications
Route::get('fund-applications','Api\FundsApplyController@index');

//list single application
Route::get('fund-application/{id}','Api\FundsApplyController@show');

// create new application
Route::post('fund-application','Api\FundsApplyController@store');

// update application
Route::put('fund-application/{id}','Api\FundsApplyController@update');

// delete application
Route::delete('fund-application/{id}','Api\FundsApplyController@destroy');






// ****    ***//
