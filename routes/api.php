<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\RequestJoinController;
use App\Http\Controllers\TestController;
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
//1|RLgYdwgwwJ0RslcEr7zVpunsL1oLiAfVzolQ2Tjk
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::get('AllProducts',[ProductController::class , 'All_Products']);
    Route::post('GadAcademy/LogOut',[AccountController::class , 'LogOut']);
});

Route::post('GadAcademy/Join_us',[RequestJoinController::class,'join_us']);
Route::post('GadAcademy/RegisterStudent',[AccountController::class,'RegisterStudent']);
Route::post('GadAcademy/RegisterProf',[AccountController::class,'RegisterProf']);
Route::post('login',[AccountController::class,'login']);

