<?php

use App\Http\Controllers\CvController;
use App\Models\Candidate;
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
        Route::get('/', [\App\Http\Controllers\DashController::class, 'show'])->name('dashboard');
        Route::post('/status/{id}', function (Request $request) {
            $cv = Cv::find($request->id);
            $cv->status = Status::find($request->input('cv_status'));
            $cv->save();

            return redirect('/dashboard');
        })->name('status');
    });

    Route::get('/cvs/{cv}/save', [CvController::class, 'save'])->name('cvs.save');
    Route::resource('cvs', CvController::class);

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
