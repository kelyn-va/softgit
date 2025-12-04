@extends('layouts.app')

@section('title', 'Administrar Compras')

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
        --btn-edit: #007bff;
        --btn-edit-hover: #0056b3;
    }

    .clean-card {
        background-color: var(--light-blue-bg) !important;
        border-radius: 12px !important;
        border: 1px solid var(--card-border) !important;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
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

    .btn-delete {
        background-color: #dc3545 !important;
        color: white !important;
    }
    .btn-delete:hover {
        background-color: #b02a37 !important;
    }

    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #c4daee;
        padding: 0.6rem 1rem;
    }
</style>

@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: "{{ session('success') }}",
            timer: 2500
        });
    });
</script>
@endif

<div class="container py-4">

    {{-- Botón Crear --}}
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('compras.create') }}" class="btn btn-action-primary">
            <i class="fas fa-plus me-1"></i> Crear Compra
        </a>
    </div>

    {{-- Filtros --}}
    <div class="row g-2 mb-3">
        <div class="col-md-3">
            <select id="filtroProveedor" class="form-select">
                <option value="">-- Proveedor --</option>
                @foreach ($proveedores as $proveedor)
                    <option value="{{ $proveedor->nombre }}">{{ $proveedor->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select id="filtroProducto" class="form-select">
                <option value="">-- Producto --</option>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->nombre }}">{{ $producto->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 d-grid">
            <button id="limpiarFiltros" class="btn btn-secondary">Limpiar filtros</button>
        </div>
    </div>

    {{-- Tabla --}}
    <div class="card clean-card shadow-lg border-0">
        <div class="card-body p-0">
            <div class="table-responsive px-3">
                <table id="tablaCompras" class="table table-hover table-striped align-middle text-center mb-0">
                    <thead style="background: var(--header-bg); color: var(--text-dark)">
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
                            <td>{{ number_format($compra->precioCompra,2) }}</td>
                            <td>{{ number_format($compra->precioVenta,2) }}</td>
                            <td>{{ number_format($compra->Total,2) }}</td>
                            <td>{{ $compra->metodoPago }}</td>
                            <td>{{ $compra->Cantidad }}</td>
                            <td>{{ $compra->proveedores->nombre ?? 'Sin proveedor' }}</td>
                            <td>{{ $compra->productos->nombre ?? 'Sin producto' }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('compras.edit',$compra->id) }}" class="btn btn-edit btn-sm btn-action-table">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('compras.destroy',$compra->id) }}" method="POST" onsubmit="return confirmarEliminacion(event)">
                                        @csrf
                                        <button type="submit" class="btn btn-delete btn-sm btn-action-table">
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
        </div>
    </div>

</div>

{{-- Datatables --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function(){
    var table = $("#tablaCompras").DataTable({
        language: {
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_",
            zeroRecords: "No hay coincidencias",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            paginate: { next: "Siguiente", previous: "Anterior" }
        }
    });

    $("#buscarNombre").on("keyup", function(){
        table.column(0).search(this.value).draw();
    });

    $("#filtroProveedor").on("change", function(){
        table.column(6).search(this.value).draw();
    });

    $("#filtroProducto").on("change", function(){
        table.column(7).search(this.value).draw();
    });

    $("#limpiarFiltros").click(function(){
        $("#buscarNombre").val("");
        $("#filtroProveedor").val("");
        $("#filtroProducto").val("");
        table.columns().search("").draw();
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmarEliminacion(event){
    event.preventDefault();
    const form = event.target.closest('form');
    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás revertir esto.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result)=>{
        if(result.isConfirmed) form.submit();
    });
}
</script>

@endsection
