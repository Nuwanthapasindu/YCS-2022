<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\SectionController;

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


Route::post('/auth/login',[AuthController::class,'login']);


Route::group(['middleware'=>['auth:api']],function (){
Route::prefix('/auth')->group(function (){
    Route::get('/me',[AuthController::class,'Auth_user']);
    Route::post('/logout',[AuthController::class,'logout']);
});

// SECTION ROUTES
Route::prefix('/sections')->group(function (){
    Route::post('/add',[SectionController::class,'add']);
    Route::get('/assign/{uid}',[SectionController::class,'assign']);
    Route::get('/all',[SectionController::class,'all']);
    Route::get('/edit/{id}',[SectionController::class,'edit']);
    Route::put('/update/{id}',[SectionController::class,'update']);

});

});
