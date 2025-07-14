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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pub = new Publicacion();
        $pub->titulo = $request->titulo;
        $pub->docente = $request->docente;
        $pub->anio = $request->anio;
        $pub->carrera = $request->carrera;
        $pub->enlace = $request->enlace;
        $pub->activo = 1;
        $pub->save();

        return redirect()->route('admin.dashboard')->with([
            'mensaje' => 'Publicación agregada correctamente',
            'tipo' => 'success'
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pub = Publicacion::find($id);
        $pub->titulo = $request->titulo;
        $pub->docente = $request->docente;
        $pub->anio = $request->anio;
        $pub->carrera = $request->carrera;
        $pub->enlace = $request->enlace;
        $pub->save();
        return redirect()->route('admin.dashboard')->with([
            'mensaje' => 'Publicación actualizada',
            'tipo' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

    public function low($id){
        $pub = Publicacion::find($id);
        $pub->activo = false;
        $pub->save();

        return redirect()->route('admin.dashboard')->with([
            'mensaje' => 'Publicación dada de baja',
            'tipo' => 'warning'
        ]);
    }
}
