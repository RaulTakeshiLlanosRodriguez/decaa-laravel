<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComiteController;
use App\Http\Controllers\IndicadorController;
use App\Http\Controllers\MiembroController;
use App\Http\Controllers\PublicacionController;
use Illuminate\Support\Facades\Route;

Route::get('/decaa', function () {
    return view('public.decaa');
});
Route::get('/oseil', function () {
    return view('public.oseil');
});
Route::get('/ogc', function () {
    return view('public.ogc');
});
Route::get('/oaac', function () {
    return view('public.oaac');
});
Route::get('/olic', function () {
    return view('public.olic');
});

Route::get('/acreditacion', function (){
    return view('public.acreditacion');
});

Route::get('/innovaciones',function(){
    return view('public.innovaciones');
});

Route::get('/comites', [ComiteController::class, 'index']);
Route::get('/publicaciones', [PublicacionController::class, 'index']);
Route::get('/', [IndicadorController::class, 'index']);

/**
 * Modo Administrador
 */
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/admin', fn () => redirect()->route('admin.publications'))->name('admin.dashboard');
    Route::get('/admin/publicaciones', [AdminController::class, 'publications'])->name('admin.publications');
    Route::get('/admin/comites', [AdminController::class, 'comites'])->name('admin.comites');
    Route::get('/admin/indicadores', [AdminController::class, 'indicadores'])->name('admin.indicadores');

    Route::post('/admin/publicaciones', [PublicacionController::class, 'store'])->name('publicaciones.store');
    Route::put('/admin/publicaciones/{id}', [PublicacionController::class, 'update'])->name('publicaciones.update');
    Route::delete('/admin/publicaciones/delete/{id}', [PublicacionController::class, 'destroy'])->name('publicaciones.destroy');
    Route::get('/admin/publicaciones/baja/{id}', [PublicacionController::class, 'low'])->name('publicaciones.low');

    Route::post('/admin/comites', [ComiteController::class, 'store'])->name('comites.store');
    Route::put('/admin/comites/{id}', [ComiteController::class, 'update'])->name('comites.update');
    Route::delete('/admin/comites/delete/{id}', [ComiteController::class, 'destroy'])->name('comites.destroy');

    Route::get('/admin/miembros/{comite}', [MiembroController::class, 'index'])->name('miembros.index');
    Route::post('/admin/miembros', [MiembroController::class, 'store'])->name('miembros.store');
    Route::put('/admin/miembros/{id}', [MiembroController::class, 'update'])->name('miembros.update');
    Route::delete('/admin/miembros/delete/{id}', [MiembroController::class, 'destroy'])->name('miembros.destroy');

    Route::post('/admin/indicadores', [IndicadorController::class, 'store'])->name('indicadores.store');
    Route::put('/admin/indicadores/{id}', [IndicadorController::class, 'update'])->name('indicadores.update');
    Route::delete('/admin/indicadores/delete/{id}', [IndicadorController::class, 'destroy'])->name('indicadores.destroy');
});
