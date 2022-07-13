<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\SectionController;
use \App\Http\Controllers\SectionHeadController;
use \App\Http\Controllers\SectionClassesController;
use \App\Http\Controllers\TeacherController;
use \App\Http\Controllers\ProfileCompleteController;

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

//Route::group(['middleware'=>['cors']],function (){
    Route::group(['middleware'=>['auth:api']],function (){
        Route::prefix('/auth')->group(function (){
            Route::get('/me',[AuthController::class,'Auth_user']);
            Route::post('/logout',[AuthController::class,'logout']);
            Route::post('/profile/{uuid}',[AuthController::class,'profile']);
            Route::post('/password-update/{uuid}',[AuthController::class,'PasswordUpdate']);
            Route::post('/complete/{uuid}',[ProfileCompleteController::class,'complete']);
            Route::post('/profile-pic/{uuid}',[ProfileCompleteController::class,'profile_pic']);

        });

// SECTION ROUTES
        Route::prefix('/sections')->group(function (){
            Route::post('/add',[SectionController::class,'add']);
            Route::get('/all',[SectionController::class,'all']);
            Route::get('/details/{id}',[SectionController::class,'sectionData']);
        });

// CLASS TEACHER ROUTES
        Route::prefix('/classes-teacher')->group(function (){
            Route::post('/add',[SectionHeadController::class,'add']);
            Route::get('/all',[SectionHeadController::class,'all']);
        });

// CLASSES ROUTES
        Route::prefix('/classes')->group(function (){
            Route::get('/all',[SectionClassesController::class,'all']);
        });

// CLASS TEACHER ROUTES
        Route::prefix('/student')->group(function (){
            Route::post('/add',[TeacherController::class,'add']);
            Route::get('/attendence/{uid}',[TeacherController::class,'attendance']);
            Route::get('/all',[TeacherController::class,'all']);
            Route::get('/edit/{uid}',[TeacherController::class,'edit']);
            Route::put('/update/{uid}',[TeacherController::class,'update']);
            Route::delete('/delete/{uid}',[TeacherController::class,'drop']);
        });

    });

//});

