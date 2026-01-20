<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EsdevenimentsController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public routes (no authentication required)
Route::get('/esdeveniments', [EsdevenimentsController::class, 'publicIndex'])->name('esdeveniments.index');
Route::get('/inscripcions/create', [EsdevenimentsController::class, 'createInscripcio'])->name('inscripcions.create');
Route::post('/inscripcions', [EsdevenimentsController::class, 'storeInscripcio'])->name('inscripcions.store');

Route::middleware('usuari.admin')->group(function () {
    Route::get('/', function () {
        return redirect()->route('inscripcions.index');
    });
    Route::get('inscripcions', [EsdevenimentsController::class, 'inscripcions'])->name('inscripcions.index');
    Route::get('inscripcions/{id}/download', [EsdevenimentsController::class, 'downloadFitxer'])->name('inscripcions.download');
});
