<?php

namespace App\Http\Controllers;

use App\Models\Comite;
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
