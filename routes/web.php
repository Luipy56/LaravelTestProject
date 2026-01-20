<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BibliotecasController;
use App\Http\Controllers\LibrosController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public routes (no authentication required)
Route::get('/public', [BibliotecasController::class, 'publicIndex'])->name('public.index');
Route::get('/public/bibliotecas/{id}', [BibliotecasController::class, 'publicShow'])->name('public.bibliotecas.show');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('bibliotecas.index');
    });
    Route::resource('bibliotecas', BibliotecasController::class);
    Route::get('bibliotecas/{id}/export-libros', [BibliotecasController::class, 'exportLibros'])->name('bibliotecas.export-libros');
    Route::resource('libros', LibrosController::class);
    Route::get('libros/{id}/download', [LibrosController::class, 'download'])->name('libros.download');
});
