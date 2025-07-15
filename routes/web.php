<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicacionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('public.home');
});
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

Route::get('/comites', function () {
    $json = file_get_contents(public_path('data/comites.json'));
    $comites = json_decode($json, true);
    return view('public.comites', compact('comites'));
});
Route::get('/publicaciones', [PublicacionController::class, 'index']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/admin', fn () => redirect()->route('admin.publications'))->name('admin.dashboard');;
    Route::get('/admin/publicaciones', [AdminController::class, 'publications'])->name('admin.publications');
    Route::post('/admin/publicaciones', [PublicacionController::class, 'store'])->name('publicaciones.store');
    Route::put('/admin/publicaciones/{id}', [PublicacionController::class, 'update'])->name('publicaciones.update');
    Route::delete('/admin/publicaciones/delete/{id}', [PublicacionController::class, 'destroy'])->name('publicaciones.destroy');
    Route::get('/admin/publicaciones/baja/{id}', [PublicacionController::class, 'low'])->name('publicaciones.low');
});
