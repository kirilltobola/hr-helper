<?php


use App\Http\Controllers\Admin\CatalogController;
use App\Http\Controllers\Admin\AuthController;
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
        Route::resource('users', AuthController::class);

        Route::get('/', [CatalogController::class, 'index'])->name('index');
        Route::prefix('/{model}')->group(function () {
            Route::get('/', [CatalogController::class, 'show'])->name('show');
            Route::post('/', [CatalogController::class, 'store'])->name('store');
            Route::get('/create', [CatalogController::class, 'create'])->name('create');

            Route::prefix('/{id}')->group(function () {
                Route::get('/edit', [CatalogController::class, 'edit'])->name('edit');
                Route::put('/', [CatalogController::class, 'update'])->name('update');
                Route::get('/delete', [CatalogController::class, 'delete'])->name('delete');
                Route::delete('/delete', [CatalogController::class, 'destroy'])->name('destroy');
            });
        });
    });
});
