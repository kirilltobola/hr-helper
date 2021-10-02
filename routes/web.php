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

    Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {
        Route::get('/', function () {
            return view('admin_dashboard');
        });

        Route::prefix('/{model}')->group(function () {
            Route::get('/', [App\Http\Controllers\AdminController::class, 'showModelList']);

            Route::get('/add', [App\Http\Controllers\AdminController::class, 'showAdd']);
            Route::post('/add', [App\Http\Controllers\AdminController::class, 'add']);

            Route::prefix('/{id}')->group(function () {
                Route::get('/edit', [App\Http\Controllers\AdminController::class, 'showEdit']);
                Route::post('/edit', [App\Http\Controllers\AdminController::class, 'edit']);

                Route::post('/delete', [App\Http\Controllers\AdminController::class, 'delete']);
            });
        });
    });
});
