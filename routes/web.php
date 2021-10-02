<?php

use App\Models\Cv;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', function (){
        return redirect('/dashboard');
    });

    Route::prefix('/dashboard')->group(function (){
        Route::get('/', [\App\Http\Controllers\DashController::class, 'show'])->name('dashboard');
        Route::post('/status/{id}', function (Request $request){
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
});

