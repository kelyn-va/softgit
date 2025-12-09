@extends('layouts.app')

@section('title', 'Crear Proveedor')

@section('titleContent')
    <h1 class="text-center my-4 fw-bold text-dark">Registrar Nuevo Proveedor</h1>
@endsection

@section('content')

<style>
    /* --- VARIABLES DE ESTILO LIMPIO Y AZUL PASTEL --- */
    :root {
        --primary-soft-blue: #007bff; /* Azul primario para acentos */
        --light-blue-bg: #f0f7ff; /* Fondo de card muy claro */
        --text-dark: #344767; /* Color de texto oscuro para legibilidad */
        --card-border: #daeafc; /* Borde sutil */
        --input-border: #c4daee;
        --input-focus-shadow: rgba(0, 123, 255, 0.25);
    }

    /* Estilo principal del contenedor del formulario */
    .clean-card {
        background-color: white !important; /* Fondo blanco puro para el contenido */
        border-radius: 12px !important;
        border: 1px solid var(--card-border) !important;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    /* Estilo de los campos de formulario */
    .clean-input {
        border-radius: 8px !important;
        border: 1px solid var(--input-border) !important;
        padding: 0.6rem 1rem;
        background: #ffffff;
        transition: all 0.2s;
        color: var(--text-dark);
    }
    .clean-input:focus {
        border-color: var(--primary-soft-blue) !important;
        box-shadow: 0 0 0 0.2rem var(--input-focus-shadow);
        background-color: #fcfdff;
    }

    /* Etiqueta de formulario */
    .form-label {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.3rem;
    }

    /* Botón Principal (Crear) */
    .btn-action-primary {
        background-color: var(--primary-soft-blue) !important;
        border: none !important;
        color: white !important;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 600;
        transition: background-color 0.2s ease;
        text-decoration: none; 
    }
    .btn-action-primary:hover {
        background-color: #0069d9 !important;
    }

    /* Botón Volver */
    .btn-back {
        background-color: #e9f5ff !important;
        color: var(--primary-soft-blue) !important;
        border: 1px solid var(--card-border) !important;
        border-radius: 8px;
        padding: 10px 18px;
        font-weight: 600;
        transition: background-color 0.2s ease;
        text-decoration: none;
    }
    .btn-back:hover {
        background-color: #daeafc !important;
        color: #0056b3 !important;
    }
</style>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <!-- Botón de volver (Estilizado) -->
            <div class="mb-4 text-start">
                <a href="{{ route('proveedor.index') }}" class="btn btn-back d-inline-flex align-items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Volver a Proveedores
                </a>
            </div>

            <!-- Tarjeta del formulario (Estilizada) -->
            <div class="card clean-card shadow-lg">
                <div class="card-body p-4">

                    <h5 class="fw-bold mb-4 text-center text-dark">Ingresa los datos del nuevo proveedor</h5>

                    <form action="{{ route('proveedor.store') }}" method="POST">
                        @csrf

                        <!-- Campo Nombre -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del Proveedor (Empresa)</label>
                            <input 
                                type="text" 
                                id="nombre" 
                                name="nombre" 
                                class="form-control clean-input @error('nombre') is-invalid @enderror" 
                                value="{{ old('nombre') }}"
                                placeholder="Ej: Distribuidora Central S.A."
                              
                            >
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo Contacto -->
                        <div class="mb-3">
                            <label for="contacto" class="form-label">Persona de Contacto</label>
                            <input 
                                type="text" 
                                id="contacto" 
                                name="contacto" 
                                class="form-control clean-input @error('contacto') is-invalid @enderror"
                                value="{{ old('contacto') }}"
                                placeholder="Ej: Juan Pérez"
                               
                            >
                            @error('contacto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo Teléfono -->
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input 
                                type="tel" 
                                id="telefono" 
                                name="telefono" 
                                class="form-control clean-input @error('telefono') is-invalid @enderror"
                                value="{{ old('telefono') }}"
                                placeholder="Ej: +57 300 123 4567"
                               
                            >
                            @error('telefono')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo Dirección -->
                        <div class="mb-4">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input 
                                type="text" 
                                id="direccion" 
                                name="direccion" 
                                class="form-control clean-input @error('direccion') is-invalid @enderror"
                                value="{{ old('direccion') }}"
                                placeholder="Ej: Carrera 10 # 5-20, Bogotá"
                    >
                            @error('direccion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Botón de Envío -->
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-action-primary d-inline-flex align-items-center gap-2">
                                <i class="fas fa-plus"></i> Crear Proveedor
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection