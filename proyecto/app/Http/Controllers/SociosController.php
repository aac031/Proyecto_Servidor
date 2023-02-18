<?php

namespace App\Http\Controllers;

use App\Models\Socio;
use Illuminate\Http\Request;

class SociosController extends Controller
{
    public function index()
    {
        $socios = Socio::orderBy('nombre', 'asc')->paginate(10);
        return view('socios.index', compact('socios'));
    }

    public function edit($id)
    {
        $socio = Socio::find($id);

        return view('socios.edit', compact('socio'));
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
