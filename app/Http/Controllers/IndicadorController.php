<?php

namespace App\Http\Controllers;

use App\Models\Indicador;
use Illuminate\Http\Request;

class IndicadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $indicadores = Indicador::all();
        return view('public.home', compact('indicadores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $indicador = new Indicador();
        $indicador->descripcion = $request->descripcion;
        $indicador->cantidad = $request->cantidad;
        $indicador->save();
        return redirect()->route('admin.indicadores')->with([
            'mensaje' => 'Indicador agregado correctamente',
            'tipo' => 'success'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $indicador = Indicador::findOrFail($id);
        $indicador->descripcion = $request->descripcion;
        $indicador->cantidad = $request->cantidad;
        $indicador->save();
        return redirect()->route('admin.indicadores')->with([
            'mensaje' => 'Indicador actualizado correctamente',
            'tipo' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $indicador = Indicador::findOrFail($id);
        $indicador->delete();
        return redirect()->route('admin.indicadores')->with([
            'mensaje' => 'Indicador eliminado correctamente',
            'tipo' => 'success'
        ]);
    }
}
