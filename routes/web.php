<?php

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
Route::get('/publicaciones', [PublicacionController::class, 'index']);
