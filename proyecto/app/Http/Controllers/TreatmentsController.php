<?php

namespace App\Http\Controllers;

use App\Models\Socio;
use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentsController extends Controller
{
    public function getTreatments()
    {
        $treatments = Treatment::all();
        return response()->json($treatments);
    }

    public function store($socio_id, Request $request)
    {
        $socio = Socio::find($socio_id);

        // Buscar si ya existe un tratamiento en la fecha especificada
        if ($socio->treatments()->where('fecha_tratamiento', $request->input('fecha_tratamiento'))->exists()) {
            return back()->withErrors(['deletedTreatment' => 'Ya existe un tratamiento en esa fecha.']);
        }

        // Validar la solicitud
        $validated = $request->validate([
            'name' => 'required',
            'fecha_tratamiento' => 'required|date',
        ]);

        // Crear el tratamiento
        $treatment = Treatment::where('name', $request->input('name'))->first();

        $socio->treatments()->attach($treatment->id, ['fecha_tratamiento' => $request->input('fecha_tratamiento')]);

        return redirect()->route('socios.show', $socio_id)->with('success', 'El tratamiento se ha añadido correctamente.');
    }
}
