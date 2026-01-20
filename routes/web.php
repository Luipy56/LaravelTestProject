<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EsdevenimentsController;
use App\Http\Controllers\InscripcionsController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/esdeveniments', [EsdevenimentsController::class, 'publicIndex'])->name('esdeveniments.index');
Route::get('/inscripcions/create', [InscripcionsController::class, 'create'])->name('inscripcions.create');
Route::post('/inscripcions', [InscripcionsController::class, 'store'])->name('inscripcions.store');

Route::middleware('usuari.admin')->group(function () {
    Route::get('/', function () {
        return redirect()->route('inscripcions.index');
    });
    Route::get('inscripcions', [InscripcionsController::class, 'index'])->name('inscripcions.index');
    Route::get('inscripcions/{id}/download', [InscripcionsController::class, 'download'])->name('inscripcions.download');
});
