<?php

namespace App\Http\Controllers;

use App\Models\Comite;
use App\Models\Miembro;
use Illuminate\Http\Request;

class MiembroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($comite_id)
    {
        $comite = Comite::findOrFail($comite_id);
        $miembros = $comite->miembros()->paginate(8);

        return view('admin.miembros.index', compact('comite', 'miembros'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Miembro::create([
            'comite_id' => $request->comite_id,
            'nombre' => $request->nombre,
            'rol' => $request->rol,
        ]);

        return redirect()->route('miembros.index', $request->comite_id)->with([
            'mensaje' => 'Miembro actualizado correctamente',
            'tipo' => 'success'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $miembro = Miembro::findOrFail($id);
        $miembro->update([
            'nombre' => $request->nombre,
            'rol' => $request->rol,
        ]);

        return redirect()->route('miembros.index', $miembro->comite_id)->with([
            'mensaje' => 'Miembro actualizado correctamente',
            'tipo' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $miembro = Miembro::findOrFail($id);
        $comite_id = $miembro->comite_id;
        $miembro->delete();

        return redirect()->route('miembros.index', $comite_id)->with([
            'mensaje' => 'Miembro eliminado correctamente',
            'tipo' => 'success'
        ]);
    }
}
