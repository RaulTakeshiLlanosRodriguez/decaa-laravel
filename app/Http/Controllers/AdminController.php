<?php

namespace App\Http\Controllers;

use App\Models\Comite;
use App\Models\Publicacion;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function publications(){
        $publicaciones = Publicacion::where('activo',true)->orderByDesc('anio')->paginate(5);
        return view('admin.publicaciones.index', compact('publicaciones'));
    }

    public function comites(){
        $comites = Comite::paginate(8);
        return view('admin.comites.index', compact('comites'));
    }
}
