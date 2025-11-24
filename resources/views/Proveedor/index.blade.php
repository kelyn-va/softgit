@extends('layouts.app')

@section('title', 'Administrar proveedores')

@section('titleContent')
    <h1 class="text-center my-4 fw-bold text-dark">Administración de Proveedores</h1>
@endsection

@section('content')

<style>
    /* --- VARIABLES DE ESTILO LIMPIO Y AZUL PASTEL --- */
    :root {
        --primary-soft-blue: #007bff; /* Azul primario para acentos */
        --light-blue-bg: #f0f7ff; /* Fondo de card muy claro */
        --header-bg: #d0e7ff; /* Azul pastel para encabezados de tabla */
        --text-dark: #344767; /* Color de texto oscuro para legibilidad */
        --card-border: #daeafc; /* Borde sutil */
        --btn-edit: #007bff; /* Azul para editar */
        --btn-delete: #dc3545; /* Rojo para eliminar */
    }

    /* Estilo principal del contenedor de la tabla */
    .clean-card {
        background-color: var(--light-blue-bg) !important;
        border-radius: 12px !important;
        border: 1px solid var(--card-border) !important;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }
    
    /* Estilo de la cabecera de la tabla */
    .table thead {
        background-color: var(--header-bg) !important;
        color: var(--text-dark) !important;
    }
    .table thead th {
        border-color: #c4daee !important;
        font-weight: 600;
        text-transform: uppercase;
        color: var(--text-dark); /* Asegura que el texto de la cabecera sea oscuro */
    }

    /* Botones de acción principal (Crear, Volver) */
    .btn-action-primary {
        background-color: var(--primary-soft-blue) !important;
        border: none !important;
        color: white !important;
        border-radius: 8px !important;
        padding: 10px 18px !important;
        font-weight: 600;
        transition: background-color 0.2s ease;
        text-decoration: none;
    }
    .btn-action-primary:hover {
        background-color: #0069d9 !important;
        color: white !important;
    }

    /* Botón Volver específico */
    .btn-back {
        background-color: #e9f5ff !important;
        color: var(--primary-soft-blue) !important;
        border: 1px solid var(--card-border) !important;
        border-radius: 8px !important;
        padding: 10px 18px !important;
        font-weight: 600;
        transition: background-color 0.2s ease;
        text-decoration: none;
    }
    .btn-back:hover {
        background-color: #daeafc !important;
        color: #0056b3 !important;
    }

    /* Botones de acciones en la tabla (Editar, Eliminar) */
    .btn-action-table {
        border-radius: 6px;
        padding: 6px 10px;
        font-size: 0.85rem;
    }
    .btn-edit {
        background-color: var(--btn-edit) !important;
        color: white !important;
    }
    .btn-edit:hover {
        background-color: #0056b3 !important;
    }
    .btn-delete {
        background-color: var(--btn-delete) !important;
        color: white !important;
    }
    .btn-delete:hover {
        background-color: #c82333 !important;
    }
</style>

<div class="container py-4">

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

    <div class="d-flex justify-content-start align-items-center gap-3 mb-4">
        
        <a href="{{ route('welcome') }}" class="btn btn-back d-inline-flex align-items-center gap-2">
            <i class="fas fa-arrow-left"></i> Volver
        </a>

        <a href="{{ route('proveedor.create') }}" class="btn btn-action-primary d-inline-flex align-items-center gap-2 ms-auto">
            <i class="fas fa-plus"></i> Crear Proveedor
        </a>
    </div>
    
    <div class="card clean-card shadow-lg border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle text-center mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Contacto</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Opciones</th> </tr>
                    </thead>
                    <tbody>
                        @forelse ($proveedores as $Proveedor)
                            <tr>
                                <td>{{ $Proveedor->id }}</td>
                                <td>{{ $Proveedor->nombre }}</td>
                                <td>{{ $Proveedor->contacto }}</td>
                                <td>{{ $Proveedor->telefono }}</td>
                                <td>{{ $Proveedor->direccion }}</td>
                                
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('proveedor.edit', $Proveedor->id) }}" class="btn btn-edit btn-sm btn-action-table d-flex align-items-center gap-1">
                                            <i class="fas fa-pencil-alt"></i> 
                                        </a>

                                        <form action="{{ route('proveedor.destroy', $Proveedor->id) }}" method="POST" onsubmit="return confirmarEliminacion(event)">
                                            @csrf
                                            <button type="submit" class="btn btn-delete btn-sm btn-action-table d-flex align-items-center gap-1">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center p-4 text-muted">No hay proveedores registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmarEliminacion(event) {
        event.preventDefault();
        const form = event.target.closest('form'); // Asegurarse de obtener el formulario

        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545', // Rojo
            cancelButtonColor: '#6c757d', // Gris
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>
@endsection