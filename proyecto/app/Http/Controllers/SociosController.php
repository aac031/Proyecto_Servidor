<?php

namespace App\Http\Controllers;

use App\Models\Socio;
use App\Models\SocioTreatment;
use App\Models\Treatment;
use Illuminate\Http\Request;

class SociosController extends Controller
{
    public function index()
    {
        $socios = Socio::orderBy('nombre', 'asc')->paginate(10);
        return view('socios.index', compact('socios'));
    }

    public function create()
    {
        $treatments = Treatment::all();
        return view('socios.create', compact('treatments'));
    }

    public function store(Request $request)
    {
        // Obtener los datos del formulario
        $data = $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'email' => 'required|email|unique:socios',
            'telefono' => 'required',
            'treatment' => 'required',
            'fecha_tratamiento' => 'required|date',
        ]);

        // Obtener el tratamiento seleccionado y la fecha del formulario
        $tratamiento = Treatment::find($data['treatment']);
        $fecha_tratamiento = $data['fecha_tratamiento'];

        // Verificar si existe un socio que tenga asignado ese tratamiento en esa fecha
        $socioExistente = Socio::whereHas('treatments', function ($query) use ($tratamiento, $fecha_tratamiento) {
            $query->where('treatment_id', $tratamiento->id)
                ->where('fecha_tratamiento', $fecha_tratamiento);
        })->exists();

        // Si existe, agregar un error al formulario y redirigir al usuario a la página de creación de socio
        if ($socioExistente) {
            return redirect()->route('socios.create')
                ->withInput($data)
                ->withErrors(['fecha_tratamiento' => 'Ya existe un socio con este tratamiento en esta fecha']);
        }

        // Si no existe, guardar el socio en la base de datos
        $socio = Socio::create([
            'nombre' => $data['nombre'],
            'apellidos' => $data['apellidos'],
            'email' => $data['email'],
            'telefono' => $data['telefono'],
        ]);
        $socio->treatments()->attach($tratamiento, ['fecha_tratamiento' => $fecha_tratamiento]);

        return redirect()->route('socios.index')->with('success', 'Socio creado correctamente');
    }

    public function edit($id)
    {
        $treatments = Treatment::all();
        $socio = Socio::find($id);

        // Comprobar si la relación existe para este socio
        $fecha_tratamiento = null;

        // Obtener la primera relación de tratamiento del socio, 
        // o crear una nueva instancia de Treatment con el nombre "Sin tratamiento" si no hay ninguna relación.
        $selectedTreatment = $socio->treatments->first() ?? new Treatment(['name' => 'Sin tratamiento']);

        return view('socios.edit', [
            'socio' => $socio,
            'treatments' => $treatments,
            'fecha_tratamiento' => $fecha_tratamiento,
            'selectedTreatment' => $selectedTreatment,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required|max:255',
            'apellidos' => 'required|max:255',
            'telefono' => 'required|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Buscar el registro por el ID
        $socio = Socio::findOrFail($id);

        // Actualizar los datos del registro
        $socio->nombre = $validatedData['nombre'];
        $socio->apellidos = $validatedData['apellidos'];
        $socio->telefono = $validatedData['telefono'];
        $socio->email = $validatedData['email'];

        $socio->save();

        // Redireccionar a la lista de socios con un mensaje de éxito
        return redirect()->route('socios.index')->with('success', 'Socio actualizado correctamente.');
    }

    public function show(Request $request, $id)
    {
        $socio = Socio::find($id);
        $treatments = Treatment::all();

        return view('socios.show', ['socio' => $socio, 'treatments' => $treatments]);
    }

    public function destroy($id)
    {
        // Buscar el socio que se va a eliminar
        $socio = Socio::findOrFail($id);

        // Eliminar el socio de la base de datos
        $socio->delete();

        // Redirigir al usuario de vuelta a la lista de socios
        return redirect('/socios')->with('deleted', 'Socio eliminado correctamente.');
    }
}
