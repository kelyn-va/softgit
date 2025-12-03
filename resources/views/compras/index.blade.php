@extends('layouts.app')

@section('title', 'Administrar compra')

@section('titleContent')
<h1 class="text-center my-4 fw-bold text-dark">compras</h1>
@endsection


@section('content')
<style>
    /* --- VARIABLES DE ESTILO LIMPIO Y AZUL PASTEL --- */
    :root {
        --primary-soft-blue: #007bff; /* Azul primario para acentos */
        --light-blue-bg: #f0f7ff; /* Fondo de card y tabla muy claro */
        --header-bg: #d0e7ff; /* Azul pastel para encabezados */
        --text-dark: #344767; /* Color de texto oscuro para legibilidad */
        --card-border: #daeafc; /* Borde sutil */
        --btn-edit: #007bff; /* Azul para editar */
        --btn-edit-hover: #0056b3;
    }

    /* Estilo para el contenedor de la tabla */
    .clean-card {
        background-color: var(--light-blue-bg) !important;
        border-radius: 12px !important; /* Menos redondeado */
        border: 1px solid var(--card-border) !important;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); /* Sombra sutil */
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
    }

    /* Input de búsqueda */
    .clean-input {
        border-radius: 8px !important;
        border: 1px solid var(--card-border) !important;
        padding: 0.5rem 1rem;
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
    }
    .btn-action-primary:hover {
        background-color: #0069d9 !important;
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
    <a href="{{ route('compras.create') }}" class="btn btn-action-primary">
        <i class="fas fa-plus me-1"></i> Crear Compra
    </a>
</div>

    <div class="card custom-card shadow-lg border-0">
        <div class="card-body">
            <table class="table table-striped table-hover align-middle text-center mb-0">
                <thead style="background: #a8dadc; color:#fff;">
                    <tr>
                        <th>ID</th>
                        <th>precioCompra</th>
                        <th>precioVenta</th>
                        <th>Total</th>
                        <th>metodoPago</th>
                        <th>Cantidad</th>
                        <th>Proveedor</th>
                        <th>Producto</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($compras as $compra)


                    <tr>
                        <td>{{$compra->id }}</td>
                        <td>{{$compra->precioCompra }}</td>
                        <td>{{$compra->precioVenta }}</td>
                        <td>{{$compra->Total }}</td>
                        <td>{{$compra->metodoPago  }}</td>
                        <td>{{$compra->Cantidad }}</td>
                        <td>{{$compra->proveedores->nombre }}</td>
                        <td>{{$compra->productos->nombre }}</td>


                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('compras.edit', $compra->id) }}" class="btnActualizar d-flex gap-2 align-items-center">
                                    ✏️ <i class="bi bi-pencil-square"></i> Actualizar
                                </a>

                                <form action="{{ route('compras.destroy', $compra->id) }}" method="POST" onsubmit="return confirmarEliminacion(event)">
                                    @csrf

                                    <button type="submit" class="btnEliminar d-flex gap-2 align-items-center">
                                        🗑️ <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    
                    @endforeach
                </tbody>
            </table>
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
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
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