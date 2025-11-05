@extends('layouts.app')

@section('title', 'Actuakizar turnos')

@section('titleContent')
    <h1 class="text-center my-4 fw-bold text-dark">Actualizar turnos</h1>
@endsection

@section('Content')



<div class="container py-4">

    <div class="card custom-card shadow-lg border-0 p-4">
        <form action="{{route('turno.update', $turnos->id)}}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="InicioTurno" class="form-label">inicio de turno</label>
                <input type="datetime" id="InicioTurno" name="InicioTurno"
                       class="form-control @error('InicioTurno') is-invalid @enderror"
                       value="{{$turnos->InicioTurno}}" required>
                @error('InicioTurno')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="FinTurno" class="form-label">fin de turno</label>
                <input type="datetime-local" id="FinTurno" name="FinTurno"
                       class="form-control @error('FinTurno') is-invalid @enderror"
                       value="{{$turnos->FinTurno}}" required>
                @error('FinTurno')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

           

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('turno.index') }}" class="btnVolver">
                    <i class="bi bi-arrow-left"></i> Volver
                </a>
                <button type="submit" class="btnGuardar">
                    <i class="bi bi-save"></i> Actualizar turnos
                </button>
            </div>
        </form>
    </div>

</div>

@endsection  
