<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\DashController;
use Illuminate\Support\Facades\Route;
use App\Models\Cv;
use App\Models\Status;
use Illuminate\Http\Request;

require __DIR__.'/auth.php';

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('/dashboard')->group(function () {
        Route::get('/', [DashController::class, 'show'])->name('dashboard');
        Route::post('/status/{id}', function (Request $request) {
            $cv = Cv::find($request->id);
            $cv->status = Status::find($request->input('cv_status'));
            $cv->save();

            return redirect()->route('dashboard');
        })->name('status');
    });

    Route::get('/cvs/{cv}/save', [CvController::class, 'save'])->name('cvs.save');
    Route::resource('cvs', CvController::class);

    Route::group([
        'middleware' => 'admin',
        'prefix' => 'admin',
        'as' => 'admin.'
    ], function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');

        Route::prefix('/{model}')->group(function () {
            Route::get('/', [AdminController::class, 'show'])->name('show');
            Route::post('/', [AdminController::class, 'store'])->name('store');
            Route::get('/create', [AdminController::class, 'create'])->name('create');

            Route::prefix('/{id}')->group(function () {
                Route::get('/edit', [AdminController::class, 'edit'])->name('edit');
                Route::put('/', [AdminController::class, 'update'])->name('update');
                Route::delete('/delete', [AdminController::class, 'destroy'])->name('destroy');
            });
        });
    });
});
