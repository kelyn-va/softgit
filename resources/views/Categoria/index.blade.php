@extends('layouts.app')

@section('title', 'Administrar Categorias')

@section('titleContent')
<h1 class="text-center my-4 fw-bold text-dark">Categorías</h1>
@endsection

@section('content')

<style>
    /* --- VARIABLES DE ESTILO LIMPIO Y AZUL PASTEL --- */
    :root {
        --primary-soft-blue: #007bff; /* Azul primario para acentos */
        --light-blue-bg: #f0f7ff; /* Fondo de card muy claro */
        --header-bg: #d0e7ff; /* Azul pastel para encabezados */
        --text-dark: #344767; /* Color de texto oscuro para legibilidad */
        --card-border: #daeafc; /* Borde sutil */
        --btn-edit: #007bff; /* Azul para editar */
        --btn-edit-hover: #0056b3;
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
        /* Aseguramos que solo las celdas del thead tomen el color */
    }
    .table thead th {
        border-color: #c4daee !important;
        font-weight: 600;
        text-transform: uppercase;
    }

    /* Input de búsqueda */
    .clean-input {
        border-radius: 8px !important;
        border: 1px solid var(--card-border) !important;
        padding: 0.5rem 1rem;
        width: 100%; /* Ocupar todo el espacio de su contenedor */
    }
    .search-box {
        flex-grow: 1; /* Permite que el formulario de búsqueda crezca */
        margin: 0 1rem; /* Margen a los lados de los botones */
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
        text-decoration: none; /* Quitamos subrayado de enlace */
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
        background-color: var(--btn-edit-hover) !important;
    }
</style>

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

<div class="container py-4">

    <div class="d-flex justify-content-end mb-3">
    <a href="{{ route('categorias.create') }}" class="btn btn-action-primary">
        <i class="fas fa-plus me-1"></i> Crear Categoría
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
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->id }}</td>
                            <td class="fw-bold">{{ $categoria->nombre }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    
                                    <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-edit btn-sm btn-action-table d-flex align-items-center gap-1">
                                        <i class="fas fa-pencil-alt"></i> </a>

                                    <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" onsubmit="return confirmarEliminacion(event)">
                                        @csrf
                                         <button type="submit" class="btn btn-danger btn-sm btn-action-table d-flex align-items-center gap-1">
                                            <i class="fas fa-trash-alt"></i> </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center p-4 text-muted">No hay categorías registradas.</td>
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
        const form = event.target;

        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545', // Rojo de Bootstrap
            cancelButtonColor: '#6c757d', // Gris de Bootstrap
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>

<!-- script para tablas relacionadas  -->
@if(session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: '¡Atención!',
            text: "{{ session('error') }}",
            confirmButtonText: 'Aceptar',
        });
    });
</script>
@endif
@endsection