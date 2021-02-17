<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\ArticleController;

Route::post('/login', [LoginController::class, 'login']);
Route::post('/refresh', [LoginController::class, 'refresh']);


Route::middleware('auth:api')->group(function ()
{
    Route::post('/logout', [LoginController::class, 'logout']);

    Route::prefix('article')->group(function ()
    {
        Route::post('/', [ArticleController::class, 'index']);
        Route::post('/store', [ArticleController::class, 'store']);
        Route::post('/update/{id}', [ArticleController::class, 'update'])->whereNumber('id');
        Route::post('/destroy/{id}', [ArticleController::class, 'destroy'])->whereNumber('id');
        Route::post('/change-status/{id}', [ArticleController::class, 'changeStatus'])->whereNumber('id');
    });

});
