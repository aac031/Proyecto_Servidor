<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Modificar datos del socio, {{ $socio->nombre }} {{ $socio->apellidos }} :</h2>
    <form action="{{ route('socios.update', $socio->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $socio->nombre }}">
        </div>

        <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos:</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ $socio->apellidos }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $socio->email }}">
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input type="tel" class="form-control" id="telefono" name="telefono" value="{{ $socio->telefono }}">
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
            <button type="submit" class="btn btn-primary">Modificar</button>
            <a href="{{ route('socios.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection