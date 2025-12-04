@extends('layouts.app')

@section('title', 'Editar Empleado')

@section('css')
<style>
    :root {
        --primary-soft-blue: #007bff;
        --light-blue-bg: #f0f7ff;
        --header-bg: #d0e7ff;
        --text-dark: #344767;
        --card-border: #daeafc;
    }

    .clean-card {
        background-color: white !important;
        border-radius: 12px !important;
        border: 1px solid var(--card-border) !important;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .btn-action-primary {
        background-color: var(--primary-soft-blue) !important;
        border: none !important;
        color: white !important;
        border-radius: 8px !important;
        padding: 10px 18px !important;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-back {
        background-color: #e9f5ff !important;
        border: 1px solid var(--card-border) !important;
        color: var(--primary-soft-blue) !important;
        border-radius: 8px !important;
        padding: 10px 18px !important;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    label {
        font-weight: 600;
        color: var(--text-dark);
    }

    .form-control {
        border-radius: 8px !important;
        border-color: var(--card-border) !important;
        padding: 10px 14px;
    }
</style>
@endsection


@section('titleContent')
<h1 class="text-center my-4 fw-bold text-dark">Editar Empleado</h1>
@endsection


@section('content')
<div class="container py-4">

    <div class="card clean-card mx-auto" style="max-width: 700px;">
        <div class="card-body">

            <form action="{{ route('empleados.update', $empleados->id) }}" method="POST">
                @csrf
 

                {{-- Nombre --}}
                <div class="mb-3">
                    <label for="nombre">Nombre completo</label>
                    <input type="text" id="nombre" name="nombre"
                           class="form-control @error('nombre') is-invalid @enderror"
                           value="{{ old('nombre', $empleados->nombre) }}" required>
                    @error('nombre')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Teléfono --}}
                <div class="mb-3">
                    <label for="telefono">Teléfono</label>
                    <input type="text" id="telefono" name="telefono"
                           class="form-control @error('telefono') is-invalid @enderror"
                           value="{{ old('telefono', $empleados->telefono) }}" required>
                    @error('telefono')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Correo --}}
                <div class="mb-3">
                    <label for="correo">Correo electrónico</label>
                    <input type="email" id="correo" name="correo"
                           class="form-control @error('correo') is-invalid @enderror"
                           value="{{ old('correo', $empleados->correo) }}" required>
                    @error('correo')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Cargo --}}
                <div class="mb-3">
                    <label for="cargo">Cargo</label>
                    <input type="text" id="cargo" name="cargo" class="form-control"
                           value="Vendedor" readonly>
                </div>

                {{-- Botones --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('empleados.index') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>

                    <button type="submit" class="btn btn-action-primary">
                        <i class="fas fa-save"></i> Actualizar Empleado
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
