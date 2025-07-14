<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use Illuminate\Http\Request;

class PublicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Publicacion::where('activo', true);

        //aplicamos filtros
        if ($request->filled('docente')) {
            $query->where('docente', 'like', '%' . $request->docente . '%');
        }

        if ($request->filled('titulo')) {
            $query->where('titulo', 'like', '%' . $request->titulo . '%');
        }

        if ($request->filled('anio')) {
            $query->where('anio', $request->anio);
        }

        if ($request->filled('carrera')) {
            $query->where('carrera', $request->carrera);
        }

        //paginamos los resultados de los filtros
        $publicaciones = $query->orderByDesc('anio')->paginate(5);

        //obtenemos los valores únicos para los filtros
        $anios = Publicacion::select('anio')->distinct()->pluck('anio');
        $carreras = Publicacion::select('carrera')->distinct()->pluck('carrera');

        return view('public.publicaciones', compact('publicaciones', 'anios', 'carreras'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
