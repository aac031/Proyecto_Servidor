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
            <div class="d-flex justify-content-between align-items-center">
                <h1>Listado de socios</h1>
                <a href="{{ route('socios.create') }}" class="btn btn-primary">Dar de alta a nuevo socio</a>
            </div>
            <table class="table table-bordered table-striped text-center">
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
                            <a href="{{ route('socios.show', $socio->id) }}" class="btn btn-success btn-sm">Ver</a>
                            <a href="{{ route('socios.edit', ['id' => $socio->id]) }}" class="btn btn-primary btn-sm">Modificar</a>
                            <form action="{{ route('socios.destroy', ['id' => $socio->id]) }}" method="POST" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro/a de que deseas eliminar este socio?')">Eliminar</button>
                            </form>
                        </td>
                        @else
                        <td>
                            <a href="{{ route('socios.show', $socio->id) }}" class="btn btn-success btn-sm">Ver</a>
                            <a href="{{ route('socios.edit', ['id' => $socio->id]) }}" class="btn btn-primary btn-sm">Modificar</a>
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