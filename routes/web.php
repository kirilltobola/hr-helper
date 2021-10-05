<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::middleware(['auth'])->group(function () {

    Route::prefix('/cv')->group(function(){
        Route::get('/add',function(){
            return view("cv_form");
        })->name('cv_add_get');
        Route::post('/add',[\App\Http\Controllers\CvController::class,'add'])->name('cv_add_post');


        Route::prefix('/{id}')->group(function (){
            Route::get('/',[\App\Http\Controllers\CvController::class,'show'])->name('cv');
            Route::get('/edit',[\App\Http\Controllers\CvController::class,'editGet'])->name('cv_edit_get');
            Route::post('/edit',[\App\Http\Controllers\CvController::class,'editPost'])->name('cv_edit_post');
            Route::post('/save',[\App\Http\Controllers\CvController::class,'save'])->name('cv_save');
            Route::post('/delete',[\App\Http\Controllers\CvController::class,'delete'])->name('cv_delete');
        });
    });

    Route::group([
        'middleware' => 'admin',
        'prefix' => 'admin',
        'as' => 'admin.'
    ], function () {
        Route::get(
            '/',
            [App\Http\Controllers\AdminController::class, 'index']
        )->name('index');

        Route::prefix('/{model}')->group(function () {
            Route::get(
                '/',
                [App\Http\Controllers\AdminController::class, 'show']
            )->name('show');

            Route::get(
                '/add',
                [App\Http\Controllers\AdminController::class, 'create']
            )->name('create');
            Route::post(
                '/add',
                [App\Http\Controllers\AdminController::class, 'store']
            )->name('store');

            Route::prefix('/{id}')->group(function () {
                Route::get(
                    '/edit',
                    [App\Http\Controllers\AdminController::class, 'edit']
                )->name('edit');
                Route::put(
                    '/edit',
                    [App\Http\Controllers\AdminController::class, 'update']
                )->name('update');

                Route::delete(
                    '/delete',
                    [App\Http\Controllers\AdminController::class, 'destroy']
                )->name('destroy');
            });
        });
    });
});
