@extends('layouts.app')

@section('title', 'Administrar compra')

@section('titleContent')
<h1 class="text-center my-4 fw-bold text-dark">Compras</h1>
@endsection

@section('content')

<style>
    :root {
        --primary-soft-blue: #007bff;
        --light-blue-bg: #f0f7ff;
        --header-bg: #d0e7ff;
        --text-dark: #344767;
        --card-border: #daeafc;
    }

    .custom-card {
        background-color: white !important;
        border-radius: 12px !important;
        border: 1px solid var(--card-border) !important;
    }

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

    .btnActualizar, .btnEliminar {
        font-weight: 600;
        border: none;
        border-radius: 6px;
        padding: 6px 10px;
        display: inline-flex;
        align-items: center;
        cursor: pointer;
    }

    .btnActualizar {
        background-color: #4dabf7;
        color: #fff;
    }
    .btnActualizar:hover {
        background-color: #339af0;
    }

    .btnEliminar {
        background-color: #ff6b6b;
        color: #fff;
    }
    .btnEliminar:hover {
        background-color: #fa5252;
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
        <a href="{{ route('compras.create') }}" class="btn-action-primary">
            <i class="fas fa-plus me-1"></i> Crear Compra
        </a>
    </div>

    <div class="card custom-card shadow-lg border-0">
        <div class="card-body">
            <table class="table table-striped table-hover align-middle text-center mb-0">
                <thead style="background: var(--header-bg); color: var(--text-dark);">
                    <tr>
                        <th>ID</th>
                        <th>Precio Compra</th>
                        <th>Precio Venta</th>
                        <th>Total</th>
                        <th>Método Pago</th>
                        <th>Cantidad</th>
                        <th>Proveedor</th>
                        <th>Producto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($compras as $compra)
                    <tr>
                        <td>{{ $compra->id }}</td>
                        <td>{{ number_format($compra->precioCompra, 0, ',', '.') }}</td>
                        <td>{{ number_format($compra->precioVenta, 0, ',', '.') }}</td>
                        <td>
                            {{ 
                                fmod($compra->Total,1) == 0 
                                ? number_format($compra->Total, 0, ',', '.')
                                : number_format($compra->Total, 2, ',', '.')
                            }}
                        </td>
                        <td>{{ $compra->metodoPago }}</td>
                        <td>{{ $compra->Cantidad }}</td>

                        <td>{{ $compra->proveedor->nombre ?? 'Sin proveedor' }}</td>
                        <td>{{ $compra->producto->nombre ?? 'Sin producto' }}</td>

                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('compras.edit', $compra->id) }}" class="btnActualizar">
                                    ✏️ Editar
                                </a>

                                <form action="{{ route('compras.destroy', $compra->id) }}" method="POST" onsubmit="return confirmarEliminacion(event)">
                                    @csrf
                                    <button type="submit" class="btnEliminar">
                                        🗑️ Eliminar
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
            text: "No podrás revertir esto.",
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
