<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

@extends('layouts.app')

@section('content')

<div class="container">
    @if ($errors->has('deletedTreatment'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error:</strong> {{ $errors->first('deletedTreatment') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <h2>Detalles del socio, {{ $socio->nombre }} {{ $socio->apellidos }} :</h2>

    <div class="row">
        <div class="col-md-6">
            <p><strong>Nombre:</strong> {{ $socio->nombre }}</p>
            <p><strong>Apellidos:</strong> {{ $socio->apellidos }}</p>
            <p><strong>Email:</strong> {{ $socio->email }}</p>
            <p><strong>Teléfono:</strong> {{ $socio->telefono }}</p>
            <p><strong>Precio total:</strong> {{ $socio->precioTotal() }} €</p>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('socios.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>

    <hr>

    <h3>Tratamientos actuales</h3>

    <table class="table">
        <thead>
            <tr>
                <th>Tratamiento</th>
                <th>Fecha del tratamiento</th>
                <th>Precio</th>
                <th>Tipo</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($socio->treatments as $treatment)
            <tr>
                <td>{{ $treatment->name }}</td>
                <td>{{ $treatment->pivot->fecha_tratamiento }}</td>
                <td>{{ $treatment->price }} €</td>
                <td>{{ $treatment->type }}</td>
                <td class="text-center">
                    <form action="{{ route('socios.treatments.destroy', $socioTreatment) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="text-end mb-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tratamientoModal">Añadir tratamiento</button>
    </div>
    <div class="modal fade" id="tratamientoModal" tabindex="-1" aria-labelledby="tratamientoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tratamientoModalLabel">Añadir tratamiento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('socios.treatments.store', $socio->id) }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <select class="form-control" id="name" name="name">
                                @foreach ($treatments as $treatment)
                                <option value="{{ $treatment->id }}">{{ $treatment->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fecha_tratamiento">Fecha de tratamiento</label>
                            <input type="date" class="form-control" id="fecha_tratamiento" name="fecha_tratamiento">
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@yield('scripts')
@endsection