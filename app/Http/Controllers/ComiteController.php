<?php

namespace App\Http\Controllers;

use App\Models\Comite;
use Illuminate\Http\Request;

class ComiteController extends Controller
{

    public function index()
    {
        $comites = Comite::with('miembros')->get();
        return view('public.comites', compact('comites'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $comite = new Comite();
        $comite->carrera = $request->carrera;
        $comite->save();
        return redirect()->route('admin.comites')->with([
            'mensaje' => 'Comité agregado correctamente',
            'tipo' => 'success'
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $comite = Comite::findOrFail($id);
        $comite->carrera = $request->carrera;
        $comite->save();
        return redirect()->route('admin.comites')->with([
            'mensaje' => 'Comité actualizado correctamente',
            'tipo' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $comite = Comite::findOrFail($id);
        $comite->delete();
        return redirect()->route('admin.comites')->with([
            'mensaje' => 'Comité eliminada correctamente',
            'tipo' => 'success'
        ]);
    }
}
