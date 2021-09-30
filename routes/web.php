<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';




Route::middleware(['auth'])->group(function () {

    Route::get('/cv/add',function(){
        return view("cv_form");
    })->name('cv_add_get');
    Route::post('/cv/add',[\App\Http\Controllers\CvController::class,'add'])->name('cv_add_post');

    Route::prefix('/cv/{id}')->group(function (){
        Route::get('/',[\App\Http\Controllers\CvController::class,'show'])->name('cv');
        Route::get('/edit',[\App\Http\Controllers\CvController::class,'editGet'])->name('cv_edit_get');
        Route::post('/edit',[\App\Http\Controllers\CvController::class,'editPost'])->name('cv_edit_post');
        Route::post('/save',[\App\Http\Controllers\CvController::class,'save'])->name('cv_save');
    });
});

