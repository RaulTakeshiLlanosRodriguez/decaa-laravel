<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $publicaciones = Publicacion::where('activo',true)->orderByDesc('anio')->paginate(10);
        return view('admin.dashboard', compact('publicaciones'));
    }
}
