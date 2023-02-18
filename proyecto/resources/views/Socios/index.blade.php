<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron">
        @if(session('rol') === 'recepcionista')
        <h1 class="display-4">¡Bienvenido/a, Recepcionista {{ Auth::guard('administrators')->user()->name }}!</h1>
        @elseif(session('rol') === 'gerente')
        <h1 class="display-4">¡Bienvenido/a, Gerente {{ Auth::guard('administrators')->user()->name }}!</h1>
        @endif
        <hr class="my-4">
        <div class="container">
            <h1>Listado de socios</h1>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($socios as $socio)
                    <tr>
                        <td>{{ $socio->id }}</td>
                        <td>{{ $socio->nombre }}</td>
                        <td>{{ $socio->apellidos }}</td>
                        <td>{{ $socio->telefono }}</td>
                        <td>{{ $socio->email }}</td>
                        @if(session('rol') === 'gerente')
                        <td>
                            <a href="{{ route('socios.edit', ['id' => $socio->id]) }}" class="btn btn-primary">Modificar</a>
                            <form action="{{ route('socios.destroy', ['id' => $socio->id]) }}" method="POST" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro/a de que deseas eliminar este socio?')">Eliminar</button>
                            </form>
                        </td>
                        @else
                        <td>
                            <a href="{{ route('socios.edit', ['id' => $socio->id]) }}" class="btn btn-primary">Modificar</a>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $socios->links() }}
            </div>
        </div>
    </div>
</div>
@endsection