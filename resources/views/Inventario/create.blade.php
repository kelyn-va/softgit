@extends('layouts.app')

@section('title', 'Crear inventario')

@section('titleContent')
    <h1 class="text-center my-4 fw-bold text-dark">Crear inventario</h1>
@endsection

@section('content')



<div class="container py-4">

    <div class="card custom-card shadow-lg border-0 p-4">
        <form action="{{route('inventario.store')}}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="Cantidad" class="form-label">Cantidad</label>
                <input type="text" id="Cantidad" name="Cantidad"
                       class="form-control @error('Cantidad') is-invalid @enderror"
                       value="{{ old('Cantidad') }}" required>
                @error('Cantidad')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="FechaActualizacion" class="form-label">Fecha de actualizacion</label>
                <input type="datetime-local" id="FechaActualizacion" name="FechaActualizacion"
                       class="form-control @error('FechaActualizacion') is-invalid @enderror"
                       value="{{ old('FechaActualizacion') }}" required>
                @error('FechaActualizacion')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
         

           

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('inventario.index') }}" class="btnVolver">
                    <i class="bi bi-arrow-left-circle iconBtn"></i> Volver
                </a>
                <button type="submit" class="btnGuardar">
                    <i class="bi bi-save"></i> Guardar
                </button>
            </div>
        </form>
    </div>

</div>

@endsection
