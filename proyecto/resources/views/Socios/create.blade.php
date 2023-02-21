<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

@extends('layouts.app')

@section('content')
<div class="container">
    @if($errors->has('fecha_tratamiento'))
    <div class="alert alert-danger">{{ $errors->first('fecha_tratamiento') }}</div>
    @endif

    <h1>Crear nuevo socio</h1>
    <form method="POST" action="{{ route('socios.store') }}">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}">
        </div>

        <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos:</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ old('apellidos') }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input type="tel" class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}">
        </div>

        <div class="mb-3">
            <label for="treatment" class="form-label">Tratamiento:</label>
            <select class="form-select" id="treatment" name="treatment">
                @foreach ($treatments as $treatment)
                <option value="{{ $treatment->id }}">{{ $treatment->name }} - ({{ $treatment->price }} €)</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="fecha_tratamiento" class="form-label">Fecha del tratamiento:</label>
            <input type="date" class="form-control" id="fecha_tratamiento" name="fecha_tratamiento" min="{{ date('Y-m-d') }}">
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
            <button type="submit" class="btn btn-primary">Crear</button>
            <a href="{{ route('socios.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection