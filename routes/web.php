<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\FrontController;

Route::middleware(['auth', 'role:Admin|Moderator|Writer'])->group(function ()
{
    Route::get('/dashboard', function ()
    {
        return view('admin.index');
    })->name('dashboard');


    Route::prefix('article')->group(function ()
    {
        Route::get('/', [ArticleController::class, 'index'])->name('article.list');
        Route::get('/create', [ArticleController::class, 'create'])->name('article.create');
        Route::post('/create', [ArticleController::class, 'store']);
        Route::get('/edit/{id}', [ArticleController::class, 'edit'])->name('article.edit')->whereNumber('id');
        Route::post('/edit/{id}', [ArticleController::class, 'update'])->whereNumber('id');
        Route::post('/delete', [ArticleController::class, 'destroy'])->name('article.delete');
    });


    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function ()
    {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    Route::prefix('admin')->middleware('role:Admin')->group(function ()
    {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    });

    Route::prefix('moderator')->middleware('role:Moderator')->group(function ()
    {
        Route::get('/', [AdminController::class, 'index'])->name('moderator.index');
    });

    Route::prefix('writer')->middleware('role:Writer')->group(function ()
    {
        Route::get('/', [AdminController::class, 'index'])->name('writer.index');
    });

});

Route::get('/', [FrontController::class, 'index'])->name('index');
Route::get('/{article:slug}', [FrontController::class, 'articleDetail'])->name('front.articleDetail');
Route::post('/{article:slug}/rate', [FrontController::class, 'articleRate'])->name('front.articleRate');



