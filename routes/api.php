<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\TrackRequestController;


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




Route::prefix('v1')->group(function(){
    
    Route::group(['middleware'=>['auth:sanctum','usertype:admin'] ],function () {

        Route::get('all-request', [TrackRequestController::class, 'index']);
        Route::post('store-request', [TrackRequestController::class, 'store']);
        Route::post('approve-request', [TrackRequestController::class, 'approve']);
        Route::post('update-request/{id}', [TrackRequestController::class, 'update']);
        Route::post('destroy-request/{id}', [TrackRequestController::class, 'destroy']);
    
    });
    
    
    Route::post('register', [AuthController::class,'register']);
    Route::post('login', [AuthController::class,'login']);
    Route::post('logout', [AuthController::class,'logout'])->middleware('auth:sanctum');
    
    });
    
    