@extends('layouts.app')

@section('title', 'Administrar Inventario')

@section('titleContent')
    <h1 class="text-center my-4 fw-bold text-dark">Inventario</h1>
@endsection

@section('content')

<style>
    /* --- NUEVO ESTILO: LIMPIO Y MODERNO (sin "dibujos") --- */
    :root {
        --primary-soft-blue: #007bff; /* Azul primario para enlaces y botones */
        --light-blue-bg: #e9f5ff; /* Azul muy claro para fondos de secciones */
        --card-bg: #ffffff; /* Fondo blanco puro para las tarjetas */
        --card-border: #daeafc; /* Borde muy sutil para tarjetas */
        --text-dark: #344767; /* Color de texto oscuro para legibilidad */
        --text-muted-light: #6c757d; /* Texto secundario más claro */
        --header-bg-light: #f0f7ff; /* Fondo ligeramente azulado para encabezados de tarjeta */
    }

    body {
        background-color: #f8faff; /* Un fondo general muy ligero, casi blanco */
    }

    /* Estilo para las tarjetas principales */
    .clean-card {
        background-color: var(--card-bg);
        border-radius: 12px; /* Menos redondeado para un look más formal */
        border: 1px solid var(--card-border);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); /* Sombra más sutil */
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .clean-card:hover {
        transform: translateY(-2px); /* Efecto hover más discreto */
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
    }

    /* Estilo para el encabezado de cada tarjeta */
    .clean-card-header {
        background-color: var(--header-bg-light) !important; /* Azul muy suave */
        color: var(--text-dark) !important;
        border-bottom: 1px solid var(--card-border);
        border-top-left-radius: 12px !important;
        border-top-right-radius: 12px !important;
        font-weight: 600; /* Menos bold que antes */
        padding: 1rem 1.25rem; /* Ajuste de padding */
    }

    /* Área de scroll para listas */
    .scroll-area {
        max-height: 280px;
        overflow-y: auto;
        padding-right: 8px; /* Espacio para la barra de scroll */
    }

    /* Estilo de la barra de desplazamiento */
    .scroll-area::-webkit-scrollbar {
        width: 6px;
    }
    .scroll-area::-webkit-scrollbar-thumb {
        background-color: var(--card-border);
        border-radius: 10px;
    }
    .scroll-area::-webkit-scrollbar-track {
        background: transparent;
    }

    /* Estilo para cada item dentro de las listas */
    .clean-item-box {
        background-color: white;
        border-radius: 8px; /* Ligeramente redondeado */
        padding: 12px 15px;
        margin-bottom: 8px;
        border: 1px solid #f0f7ff; /* Borde muy muy suave */
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03); /* Sombra aún más sutil */
        transition: all 0.2s ease;
    }
    .clean-item-box:hover {
        background-color: #fcfdff; /* Fondo muy ligeramente más oscuro al pasar el ratón */
        transform: none; /* Sin traslación en hover */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.06);
    }

    /* Colores de texto */
    .text-main-color {
        color: var(--text-dark) !important;
    }
    .text-secondary-color {
        color: var(--text-muted-light) !important;
    }

    /* Badges para contadores */
    .clean-badge-counter {
        background-color: var(--primary-soft-blue) !important;
        color: white !important;
        border-radius: 20px; /* Más redondo */
        padding: 5px 12px;
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    /* Botones de acción "Ir a..." */
    .btn-action-primary {
        background-color: var(--primary-soft-blue) !important;
        color: white !important;
        border-radius: 8px; /* Menos redondeado */
        font-weight: 500;
        padding: 8px 18px;
        transition: background-color 0.2s ease;
        border: none; /* Sin borde */
    }
    .btn-action-primary:hover {
        background-color: #0069d9 !important; /* Un poco más oscuro */
    }

    /* Enlace "Volver" */
    .back-link {
        color: var(--primary-soft-blue) !important;
        font-weight: 600;
        text-decoration: none;
        font-size: 1.05rem;
    }
    .back-link:hover {
        text-decoration: underline;
    }

    /* Íconos dentro de títulos de tarjetas */
    .card-title-icon {
        margin-right: 8px;
        color: var(--primary-soft-blue); /* Color azul para los íconos */
    }
</style>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
        <a href="{{route('welcome')}}" class="back-link">
            <i class="fas fa-arrow-left"></i> Volver
        </a>

        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: "{{ session('success') }}",
                        confirmButtonText: 'Aceptar',
                        timer: 3000
                    });
                });
            </script>
        @endif
    </div>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card clean-card">
                <div class="card-header clean-card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-main-color">
                        <i class="fas fa-box card-title-icon"></i> Productos
                    </h5>
                    <a href="{{ route('productos.index') }}" class="btn btn-action-primary btn-sm">
                        Ir <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>

                <div class="card-body">
                    <span class="clean-badge-counter mb-3">
                        {{ $productos->count() }} productos
                    </span>

                    <div class="scroll-area mt-3">
                        @forelse ($productos as $producto)
                            <div class="clean-item-box d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1 text-main-color fw-bold">{{ $producto->nombre }}</h6>
                                    <small class="text-secondary-color">
                                        $ {{ number_format($producto->precio, 2) }} &nbsp;|&nbsp; Stock: {{ $producto->stock }}
                                    </small>
                                </div>
                            </div>
                        @empty
                            <p class="text-secondary-color text-center py-3">Sin productos registrados</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card clean-card">
                <div class="card-header clean-card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-main-color">
                        <i class="fas fa-list-alt card-title-icon"></i> Categorías
                    </h5>
                    <a href="{{ route('categorias.index') }}" class="btn btn-action-primary btn-sm">
                        Ir <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>

                <div class="card-body">
                    <span class="clean-badge-counter mb-3">
                        {{ $categorias->count() }} categorías
                    </span>

                    <div class="scroll-area mt-3">
                        @forelse ($categorias as $categoria)
                            <div class="clean-item-box d-flex justify-content-between align-items-center">
                                <h6 class="mb-0 text-main-color fw-bold">{{ $categoria->nombre }}</h6>
                                <small class="text-secondary-color">{{ $productos->where('idCategoria', $categoria->id)->count() }} producto(s)</small>
                            </div>
                        @empty
                            <p class="text-secondary-color text-center py-3">Sin categorías registradas</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card clean-card">
                <div class="card-header clean-card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-main-color">
                        <i class="fas fa-truck-loading card-title-icon"></i> Proveedores
                    </h5>
                    <a href="{{ route('proveedor.index') }}" class="btn btn-action-primary btn-sm">
                        Ir <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>

                <div class="card-body">
                    <span class="clean-badge-counter mb-3">
                        {{ $proveedores->count() }} proveedores
                    </span>

                    <div class="scroll-area mt-3">
                        @forelse ($proveedores as $proveedor)
                            <div class="clean-item-box">
                                <h6 class="mb-1 text-main-color fw-bold">{{ $proveedor->nombre }}</h6>
                                <small class="text-secondary-color">
                                    <i class="fas fa-phone-alt me-1"></i> {{ $proveedor->telefono }} &nbsp;•&nbsp; 
                                    <i class="fas fa-user-alt me-1"></i> {{ $proveedor->contacto }}
                                </small>
                            </div>
                        @empty
                            <p class="text-secondary-color text-center py-3">Sin proveedores registrados</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection