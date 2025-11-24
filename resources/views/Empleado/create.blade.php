@extends('layouts.app')

@section('title', 'Crear Empleado')

{{-- Inclusión del CSS para el estilo limpio y azul pastel --}}
@section('css')
<style>
    /* --- VARIABLES DE ESTILO LIMPIO Y AZUL PASTEL (Unificado) --- */
    :root {
        --primary-soft-blue: #007bff; /* Azul primario para acentos */
        --light-blue-bg: #f0f7ff; /* Fondo de card o rayas de tabla muy claro */
        --header-bg: #d0e7ff; /* Azul pastel para encabezados de tabla */
        --text-dark: #344767; /* Color de texto oscuro para legibilidad */
        --card-border: #daeafc; /* Borde sutil */
    }

    /* Estilo principal del contenedor del formulario (clean-card) */
    .clean-card {
        background-color: white !important;
        border-radius: 12px !important;
        border: 1px solid var(--card-border) !important;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08); /* Sombra más pronunciada para formularios */
        padding: 20px;
    }

    /* Estilo de los Inputs del Formulario */
    .form-control {
        border-radius: 8px !important;
        border: 1px solid var(--card-border) !important;
        padding: 10px 15px;
        color: var(--text-dark);
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .form-control:focus {
        border-color: var(--primary-soft-blue) !important;
        box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25) !important;
    }
    .form-label {
        color: var(--text-dark);
        font-weight: 600;
        margin-bottom: 5px;
    }

    /* Botones de acción principal (Crear) */
    .btn-action-primary {
        background-color: var(--primary-soft-blue) !important;
        border: none !important;
        color: white !important;
        border-radius: 8px !important;
        padding: 10px 18px !important;
        font-weight: 600;
        transition: background-color 0.2s ease;
        text-decoration: none;
        display: inline-flex; /* Para alinear icono y texto */
        align-items: center;
        gap: 8px; /* Espacio entre icono y texto */
    }
    .btn-action-primary:hover {
        background-color: #0069d9 !important;
        color: white !important;
    }

    /* Botón Volver */
    .btn-back {
        background-color: #e9f5ff !important;
        color: var(--primary-soft-blue) !important;
        border: 1px solid var(--card-border) !important;
        border-radius: 8px !important;
        padding: 10px 18px !important;
        font-weight: 600;
        transition: background-color 0.2s ease;
        text-decoration: none;
        display: inline-flex; /* Para alinear icono y texto */
        align-items: center;
        gap: 8px; /* Espacio entre icono y texto */
    }
    .btn-back:hover {
        background-color: #daeafc !important;
        color: #0056b3 !important;
    }
</style>
@endsection

@section('titleContent')
<h1 class="text-center my-4 fw-bold text-dark">Crear Empleado</h1>
@endsection

@section('content')

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            {{-- Botón de volver --}}
            <div class="mb-4 text-start">
                <a href="{{ route('empleados.index') }}" class="btn btn-back">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>

            {{-- Tarjeta del formulario (Estilo clean-card) --}}
            <div class="card clean-card shadow-lg border-0">
                <div class="card-body p-4">

                    <form action="{{ route('empleados.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"
                                class="form-control @error('nombre') is-invalid @enderror" placeholder="Ingresa el nombre completo">
                            @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="cargo" class="form-label">Cargo</label>
                            <input type="text" id="cargo" name="cargo" value="{{ old('cargo') }}"
                                class="form-control @error('cargo') is-invalid @enderror" placeholder="Ej: Gerente, Vendedor, Administrativo">
                            @error('cargo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text" id="usuario" name="usuario" value="{{ old('usuario') }}"
                                class="form-control @error('usuario') is-invalid @enderror" placeholder="Nombre de usuario para el sistema">
                            @error('usuario')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="contraseña" class="form-label">Contraseña</label>
                            <input type="password" id="contraseña" name="contraseña"
                                class="form-control @error('contraseña') is-invalid @enderror" placeholder="Ingresa una contraseña segura">
                            @error('contraseña')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        {{-- Botón de Enviar --}}
                        <div class="text-end">
                            <button type="submit" class="btn btn-action-primary">
                                <i class="fas fa-user-plus"></i> Crear Empleado
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection