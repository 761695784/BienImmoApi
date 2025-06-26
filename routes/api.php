<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProprieteController;

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->name('user');
    Route::post('/proprietes', [ProprieteController::class, 'store'])->name('proprietes.store');
    Route::get('/mes-proprietes', [ProprieteController::class, 'indexForOwner']);

    Route::put('/proprietes/{propriete}', [ProprieteController::class, 'update'])->name('proprietes.update');
    Route::delete('/proprietes/{propriete}', [ProprieteController::class, 'destroy'])->name('proprietes.destroy');
});

  Route::get('/proprietes', [ProprieteController::class, 'indexPublic']);
  Route::get('/all-proprietes', [ProprieteController::class, 'index'])->name('proprietes.index');
  Route::get('/proprietes/{propriete}', [ProprieteController::class, 'show'])->name('proprietes.show');
