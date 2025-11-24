@extends('layouts.app')

@section('title', 'Administrar Empleados')

{{-- Inclusión del CSS para el estilo limpio y azul pastel --}}
@section('css')
<style>
    /* --- VARIABLES DE ESTILO LIMPIO Y AZUL PASTEL (Unificado) --- */
    :root {
        --primary-soft-blue: #007bff; /* Azul primario para acentos */
        --light-blue-bg: #f0f7ff; /* Fondo de card o rayas de tabla muy claro */
        --header-bg: #d0e7ff; /* Azul pastel para encabezados de tabla (Idéntico) */
        --text-dark: #344767; /* Color de texto oscuro para legibilidad (Idéntico) */
        --card-border: #daeafc; /* Borde sutil (Idéntico) */

        /* Colores de botones de acción de la tabla (Idénticos a proveedor) */
        --btn-edit: #007bff; /* Azul para editar */
        --btn-delete: #dc3545; /* Rojo para eliminar */
    }

    /* Estilo principal del contenedor de la tabla (clean-card de Proveedores) */
    .clean-card {
        background-color: white !important; /* El fondo del CARD es blanco, las rayas las ponemos en el TR */
        border-radius: 12px !important;
        border: 1px solid var(--card-border) !important;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }
    
    /* Estilo de la cabecera de la tabla (Idéntico a Proveedores) */
    .table thead {
        background-color: var(--header-bg) !important;
        color: var(--text-dark) !important;
    }
    .table thead th {
        border-color: #c4daee !important;
        font-weight: 600;
        text-transform: uppercase;
        color: var(--text-dark);
        padding: 12px 10px; /* Ajuste el padding para consistencia */
    }

    /* Estilo de las filas del cuerpo de la tabla (reproduce table-striped/hover de Proveedores) */
    .table tbody tr:nth-child(even) { /* Filas pares (fondo claro) */
        background-color: var(--light-blue-bg) !important;
    }
    .table tbody tr:nth-child(odd) { /* Filas impares (fondo blanco) */
        background-color: white !important;
    }
    .table tbody tr:hover { /* Efecto hover */
        background-color: #c4daee !important; /* Resaltado suave al pasar el ratón */
    }
    .table td {
        color: var(--text-dark);
        font-size: 0.95rem;
        padding: 10px 10px; /* Ajuste el padding para consistencia */
        border-color: var(--card-border); /* Color de borde para las celdas */
    }
    .table td:last-child {
        border-right: none; /* Eliminar borde derecho de la última celda */
    }
    .table th:first-child, .table td:first-child {
        border-left: none; /* Eliminar borde izquierdo de la primera celda */
    }


    /* Botones de acción principal (Crear) (Idéntico a Proveedores) */
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

    /* Botón Volver (Idéntico a Proveedores) */
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

    /* Estilo para el input de búsqueda (Para que se vea como un botón contiguo) */
    .search-box .form-control {
        border-radius: 8px 0 0 8px !important;
        border-color: var(--card-border) !important;
        box-shadow: none !important;
        padding: 10px 15px;
    }
    .search-box .btn-action-primary {
        border-radius: 0 8px 8px 0 !important;
        padding: 10px 15px !important; /* Ajuste de padding para el botón de búsqueda */
    }

    /* Botones de acciones en la tabla (Idénticos a Proveedores - solo iconos) */
    .btn-action-table {
        border-radius: 6px;
        padding: 6px 10px; /* Padding para solo el icono */
        font-size: 0.85rem;
        border: none;
        color: white; /* Color del icono */
        display: inline-flex; /* Para centrar el icono */
        align-items: center;
        justify-content: center;
    }
    .btn-edit {
        background-color: var(--btn-edit) !important;
    }
    .btn-edit:hover {
        background-color: #0056b3 !important;
    }
    .btn-delete {
        background-color: var(--btn-delete) !important;
    }
    .btn-delete:hover {
        background-color: #c82333 !important;
    }

    /* Estilo del Badge (para el Cargo) */
    .badge-info {
        background-color: #66b3ff !important;
        color: white !important;
        font-weight: 600;
        padding: 0.4em 0.6em;
        border-radius: 4px;
        font-size: 0.8em; /* Ajuste para que no sea muy grande */
    }

    /* Ocultar el campo de Contraseña para seguridad */
    .table td:nth-child(5), .table th:nth-child(5) {
        display: none;
    }
</style>
@endsection

@section('titleContent')
    <h1 class="text-center my-4 fw-bold text-dark">Administración de Empleados</h1>
@endsection

@section('content')

{{-- Mensaje de Éxito con SweetAlert --}}
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

    {{-- Botones de Acción (Volver, Búsqueda y Crear) --}}
    <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
        
        {{-- Botón Volver --}}
        <a href="{{ route('welcome') }}" class="btn btn-back">
            <i class="fas fa-arrow-left"></i> Volver
        </a>

        {{-- Formulario de Búsqueda (Estilo limpio) --}}
        <form action="{{ route('empleados.index') }}" method="GET" class="d-flex search-box input-group w-50">
            <input type="text" name="search" class="form-control" placeholder="Buscar empleado por nombre o cargo..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-action-primary">
                <i class="fas fa-search"></i>
            </button>
        </form>

        {{-- Botón Crear Empleado --}}
        <a href="{{ route('empleados.create') }}" class="btn btn-action-primary">
            <i class="fas fa-user-plus"></i> Crear Empleado
        </a>
    </div>

    {{-- Tabla de Empleados --}}
    <div class="card clean-card shadow-lg border-0">
        <div class="card-body p-0">

            @if ($empleados->isEmpty())
                <div class="alert alert-info text-center m-4">
                    <i class="fas fa-info-circle"></i> No se encontraron empleados registrados.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle text-center mb-0"> {{-- Eliminadas clases table-striped y table-hover --}}
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Cargo</th>
                                <th>Usuario</th>
                                <th style="display: none;">Contraseña</th> {{-- Ocultar por seguridad --}}
                                <th>Opciones</th> {{-- Cambiado de Acciones a Opciones para consistencia --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($empleados as $empleado)
                            <tr>
                                <td>{{ $empleado->id }}</td>
                                <td>{{ $empleado->nombre }}</td>
                                <td><span class="badge badge-info">{{ $empleado->cargo }}</span></td> 
                                <td>{{ $empleado->usuario }}</td>
                                <td style="display: none;">********</td> 
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        {{-- Botón Editar (Solo icono) --}}
                                        <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-edit btn-action-table">
                                            <i class="fas fa-pencil-alt"></i> 
                                        </a>

                                        {{-- Formulario Eliminar (Solo icono) --}}
                                        <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" onsubmit="return confirmarEliminacion(event)">
                                            @csrf
                                           
                                            <button type="submit" class="btn btn-delete btn-action-table">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Paginación (si usas paginación de Laravel) --}}
                {{-- <div class="mt-4">
                    {{ $empleados->links() }}
                </div> --}}
            @endif
        </div>
    </div>
</div>

<script>
    // Función de SweetAlert para confirmar la eliminación (Idéntica a proveedores)
    function confirmarEliminacion(event) {
        event.preventDefault();
        const form = event.target.closest('form');

        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545', // Rojo de eliminar
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