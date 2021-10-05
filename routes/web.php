<?php

use Illuminate\Support\Facades\Route;
use App\Models\Cv;
use App\Models\Status;
use Illuminate\Http\Request;

require __DIR__.'/auth.php';

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::prefix('/dashboard')->group(function () {
        Route::get('/', [\App\Http\Controllers\DashController::class, 'show'])->name('dashboard');
        Route::post('/status/{id}', function (Request $request) {
            $cv = Cv::find($request->id);
            $cv->status = Status::find($request->input('cv_status'));
            $cv->save();

            return redirect('/dashboard');
        })->name('status');
    });

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
