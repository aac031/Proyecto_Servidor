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

    @if($errors->has('fecha_tratamiento'))
    <div class="alert alert-danger">
        <strong>Error:</strong> {{ $errors->first('fecha_tratamiento') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <h2>Detalles del socio, {{ $socio->nombre }} {{ $socio->apellidos }} :</h2>
            <table class="table table-bordered">
                <tr>
                    <th>Nombre</th>
                    <td>{{ $socio->nombre }}</td>
                </tr>
                <tr>
                    <th>Apellidos</th>
                    <td>{{ $socio->apellidos }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $socio->email }}</td>
                </tr>
                <tr>
                    <th>Teléfono</th>
                    <td>{{ $socio->telefono }}</td>
                </tr>
                <tr>
                    <th>Precio total</th>
                    <td class="fs-4">{{ $socio->precioTotal() }} €</td>
                </tr>
            </table>
        </div>
    </div>

    <hr>

    <h3>Tratamientos actuales</h3>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tratamiento</th>
                <th>Fecha del tratamiento</th>
                <th>Precio</th>
                <th>Tipo</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($socio->treatments as $treatment)
            @if ($treatment)
            <tr>
                <td>{{ $treatment->pivot->id }}</td>
                <td>{{ $treatment->name }}</td>
                <td>{{ $treatment->pivot->fecha_tratamiento }}</td>
                <td>{{ $treatment->price }} €</td>
                <td>{{ $treatment->type }}</td>
                <td class="text-center">
                    <form action="{{ route('socio.treatments.destroy', [$socio->id, $treatment->pivot->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endif
            @endforeach

        </tbody>
    </table>
    <div class="text-end mb-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tratamientoModal">Añadir tratamiento</button>
        <a href="{{ route('socios.index') }}" class="btn btn-secondary">Volver</a>
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
                            <label for="name">Nombre:</label>
                            <select class="form-control" id="name" name="name">
                                @foreach ($treatments as $treatment)
                                <option value="{{ $treatment->id }}">{{ $treatment->name }} - ({{ $treatment->price }} €)</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="fecha_tratamiento">Fecha de tratamiento:</label>
                            <input type="date" class="form-control" id="fecha_tratamiento" name="fecha_tratamiento" min="{{ date('Y-m-d') }}">
                        </div>
                        <br>
                        <div class="text-center mb-3">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection