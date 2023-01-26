<?php

use App\Models\Withdrawal;
use Doctrine\DBAL\Driver\Middleware;
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
Route::group(['prefix' => 'auth', 'namespace' => 'App\Http\Controllers\Api\V1\Auth'], function () {
    Route::post('register', 'UserAuthController@register');
    Route::post('login', 'UserAuthController@login');
    });
    Route::group(['namespace' => 'App\Http\Controllers\Api\V1\Auth', 'middleware' => 'auth:sanctum'], function () {
        Route::post('logout', 'UserAuthController@logout');
    });
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1', 'middleware' => 'auth:sanctum'], function(){
    Route::apiResource('contests', ContestController::class);
    Route::apiResource('participants', ParticipantController::class);
    Route::apiResource('withdrawals', WithdrawalController::class);
    Route::apiResource('rewardsRegs', RewardsRegistryController::class);
    Route::post('wheel_points', 'UserController@wheelPoints');
    Route::get('contest_list', 'ContestController@list');
    Route::get('withdrawal_list', 'WithdrawalController@list');
    Route::get('referral_list', 'RefRecordController@list');
    Route::post('winners_list', 'ParticipantController@list');
    Route::get('get_min_points', 'CustomValueController@getMinPoints');
    Route::get('get_min_balance', 'CustomValueController@getMinBalance');
    Route::get('user_info', 'UserController@getUserInfo');
    Route::post('transfer_points', 'UserController@transferPoints');
    Route::post('withdraw_balance', 'UserController@withdrawBalance');
    Route::post('reward', 'UserController@reward');
    Route::get('reward_list', 'RewardController@list');


    // Route::group(['prefix' => 'contests'], function(){
    //   Route::get('list', 'ContestController@list');
    // });

});
