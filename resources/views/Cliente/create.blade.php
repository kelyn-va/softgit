@extends('layouts.app')

@section('title', 'Crear Cliente')

@section('titleContent')
    <h1 class="text-center my-4 fw-bold text-dark">Crear Cliente</h1>
@endsection

@section('Content')

<style>
    /* Fondo degradado animado */
    body {
        background: linear-gradient(-45deg, 
            #a8edea, #fed6e3, #cfd9df, #d7fbe8, #e0c3fc
        );
        background-size: 400% 400%;
        animation: gradientBG 15s ease infinite;
    }

    @keyframes gradientBG {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Tarjeta */
    .custom-card {
        border-radius: 20px;
        background: #ffffffcc;
        backdrop-filter: blur(8px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.08);
        transition: all 0.3s ease-in-out;
    }
    .custom-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 20px rgba(0,0,0,0.12);
    }

    /* Botón volver (más pequeño) */
    .volverBtn {
        border-radius: 10px;
        font-size: 0.85rem;
        background-color: #8ecae6;
        color: #fff;
        padding: 5px 12px;
        text-decoration: none;
        transition: 0.3s;
    }
    .volverBtn:hover {
        background-color: #219ebc;
        color: #fff;
    }

    /* Botón crear */
    .crearBtn {
        border-radius: 12px;
        font-weight: 500;
        background-color: #a8dadc;
        color: #fff;
        padding: 9px 16px;
        transition: 0.3s;
        border: none;
    }
    .crearBtn:hover {
        background-color: #457b9d;
        color: #fff;
    }

    /* Inputs */
    .form-control {
        border-radius: 12px;
        border: 1px solid #cbd5e0;
        transition: all 0.3s ease;
    }
    .form-control:focus {
        border-color: #a8dadc;
        box-shadow: 0 0 6px #a8dadc80;
    }
</style>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            {{-- Botón de volver --}}
            <div class="mb-3 text-start">
                <a href="{{ route('Cliente.index') }}" class="volverBtn d-inline-flex align-items-center gap-1">
                    🔙 <i class="bi bi-arrow-left-circle"></i> Volver
                </a>
            </div>

            {{-- Tarjeta del formulario --}}
            <div class="card custom-card shadow-lg border-0">
                <div class="card-body p-4">

                    <form action="{{ route('Cliente.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="Nombre" class="form-label fw-semibold"> Nombre</label>
                            <input type="text" id="Nombre" name="Nombre" 
                                   class="form-control @error('Nombre') is-invalid @enderror">
                            @error('Nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Telefono" class="form-label fw-semibold"> Teléfono</label>
                            <input type="text" id="Telefono" name="Telefono" 
                                   class="form-control @error('Telefono') is-invalid @enderror">
                            @error('Telefono')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Email" class="form-label fw-semibold"> Email</label>
                            <input type="text" id="Email" name="Email" 
                                   class="form-control @error('Email') is-invalid @enderror">
                            @error('Email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Direccion" class="form-label fw-semibold"> Dirección</label>
                            <input type="text" id="Direccion" name="Direccion" 
                                   class="form-control @error('Direccion') is-invalid @enderror">
                            @error('Direccion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="crearBtn">
                                ➕ <i class="bi bi-person-plus"></i> Crear Cliente
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection