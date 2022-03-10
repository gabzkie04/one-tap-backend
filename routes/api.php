<?php

use App\Http\Controllers\Api\AgentController;
use App\Http\Controllers\Api\DataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\FarmersGroupController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\FarmerController;

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

Route::post("register", [UserController::class, "register"]);
Route::post("login", [UserController::class, "login"]);
Route::get("get-farms", [FarmersGroupController::class, "getFarms"]);
Route::get( "get-farm/{id}", [FarmersGroupController::class, "getFarm"]);
Route::get( "get-farmer/{id}", [FarmerController::class, "getFarmer"]);
Route::get( "get-farmers", [FarmerController::class, "getFarmers"]);
Route::get( "get-farmers-by-farm/{id}", [FarmerController::class, "getFarmersByFarm"]);
Route::get("get-total-farmers", [FarmerController::class, "getTotalFarmers"]);

Route::group(["middleware" => ["auth:api"]], function(){
    
    Route::get("profile", [UserController::class, "profile"]);
    Route::get("logout", [UserController::class, "logout"]);

    // planholder api routes
    Route::post("add-farm", [FarmersGroupController::class, "createFarm"]);
    Route::put("update-farm/{id}", [FarmersGroupController::class, "updateFarm"]);
    Route::post("add-post", [PostController::class, "addPost"]);

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
