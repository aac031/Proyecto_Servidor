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
        // Validar la solicitud
        $validated = $request->validate([
            'name' => 'required',
            'fecha_tratamiento' => 'required|date',
        ]);

        // Obtener el tratamiento seleccionado y la fecha del formulario
        $tratamiento = Treatment::find($request->input('name'));
        $fecha_tratamiento = $request->input('fecha_tratamiento');

        // Buscar si ya existe un tratamiento en la fecha especificada para este socio
        $socio = Socio::find($socio_id);
        if ($socio->treatments()->where('fecha_tratamiento', $fecha_tratamiento)->exists()) {
            return back()->withErrors(['deletedTreatment' => 'Ya existe un tratamiento en esa fecha.']);
        }

        // Verificar si existe un socio que tenga asignado ese tratamiento en esa fecha
        $socioExistente = Socio::whereHas('treatments', function ($query) use ($tratamiento, $fecha_tratamiento) {
            $query->where('treatment_id', $tratamiento->id)
                ->where('fecha_tratamiento', $fecha_tratamiento);
        })->exists();

        // Si existe, agregar un error al formulario y redirigir al usuario a la página de creación de socio
        if ($socioExistente) {
            return redirect()->route('socios.show', $socio_id)
                ->withInput($validated)
                ->withErrors(['fecha_tratamiento' => 'Ya existe un socio con este tratamiento en esta fecha']);
        }

        // Asociar el tratamiento al socio
        $socio->treatments()->attach($tratamiento->id, ['fecha_tratamiento' => $fecha_tratamiento]);

        return redirect()->route('socios.show', $socio_id)->with('success', 'El tratamiento se ha añadido correctamente.');
    }

    public function destroy($socioId, $socioTreatmentId)
    {
        Socio::find($socioId)->treatments()->wherePivot('id', $socioTreatmentId)->detach();

        return redirect()->back()->with('success', 'El tratamiento se eliminó correctamente');
    }
}
