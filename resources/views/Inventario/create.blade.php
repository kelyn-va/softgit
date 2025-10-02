@extends('layouts.app')

@section('title', 'Crear inventario')

@section('titleContent')
    <h1 class="text-center my-4 fw-bold text-dark">Crear inventario</h1>
@endsection

@section('Content')

<style>
    /* Fondo degradado animado */
    body {
        background: linear-gradient(-45deg,
            #a8edea,   /* azul pastel */
            #fed6e3,   /* rosa pastel */
            #cfd9df,   /* gris pastel */
            #d7fbe8,   /* verde menta pastel */
            #e0c3fc    /* lila pastel */
        );
        background-size: 400% 400%;
        animation: gradientBG 15s ease infinite;
    }

    @keyframes gradientBG {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Card estilo vidrio */
    .custom-card {
        transition: all 0.3s ease-in-out;
        border-radius: 20px;
        box-shadow: 0 6px 12px rgba(0,0,0,0.08);
        background-color: #ffffffcc;
        backdrop-filter: blur(8px);
        max-width: 550px;
        margin: auto;
    }

    /* Botón guardar */
    .btnGuardar {
        border-radius: 12px;
        font-weight: 500;
        background-color: #a8dadc;
        color: #fff;
        padding: 10px 16px;
        transition: 0.3s;
        border: none;
    }
    .btnGuardar:hover {
        background-color: #457b9d;
        color: #fff;
    }

    /* Botón volver */
    .btnVolver {
        border-radius: 12px;
        font-weight: 500;
        background-color: #ffd166;
        color: #333;
        padding: 10px 16px;
        text-decoration: none;
        transition: 0.3s;
    }
    .btnVolver:hover {
        background-color: #f4a261;
        color: #fff;
    }

    /* Inputs */
    .form-control {
        border-radius: 12px;
        border: 1px solid #ccc;
        padding: 10px 14px;
        background-color: #ffffffcc;
    }

    .form-control:focus {
        border-color: #a8dadc;
        box-shadow: 0 0 6px rgba(168,218,220,0.5);
    }

    label {
        font-weight: 600;
        color: #333;
    }

</style>

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
