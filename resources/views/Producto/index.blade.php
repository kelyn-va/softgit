@extends('layouts.app')

@section('title', 'Administrar Productos')

@section('titleContent')
<h1 class="text-center my-4 fw-bold text-dark">Listado de Productos</h1>
@endsection

@section('content')

{{-- ========= ESTILOS UNIFICADOS (AZUL PASTEL) ========= --}}
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

    .table thead {
        background-color: var(--header-bg) !important;
        color: var(--text-dark) !important;
    }
    .table thead th {
        border-color: #c4daee !important;
        font-weight: 600;
        text-transform: uppercase;
    }

    .clean-input, .form-select {
        border-radius: 8px !important;
        border: 1px solid var(--card-border) !important;
        padding: .6rem 1rem;
    }

    .btn-action-primary {
        background-color: var(--primary-soft-blue) !important;
        border: none !important;
        color: white !important;
        border-radius: 8px !important;
        padding: 10px 18px !important;
        font-weight: 600;
    }
    .btn-action-primary:hover {
        background-color: #0069d9 !important;
    }

    .btn-edit {
        background-color: var(--btn-edit) !important;
        color: white !important;
    }
    .btn-edit:hover {
        background-color: var(--btn-edit-hover) !important;
    }

    .btn-action-table {
        border-radius: 6px !important;
        padding: 6px 10px !important;
    }
</style>

{{-- ALERTA --}}
@if (session('success'))
<script>
    document.addEventListener("DOMContentLoaded", function () {
        Swal.fire({ icon:"success", title:"¡Éxito!", text:"{{ session('success') }}", timer:2500 });
    });
</script>
@endif

<div class="container">

{{-- BOTÓN CREAR --}}
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('productos.create') }}" class="btn btn-action-primary">
        <i class="fas fa-plus me-1"></i> Crear producto
    </a>
</div>

{{-- ======== FILTROS ======== --}}
<div class="row g-2 mb-4">
    <div class="col-md-3">
        <select id="filtroCategoria" class="form-select">
            <option value="">-- Categoría --</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->nombre }}">{{ $categoria->nombre }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <select id="filtroProveedor" class="form-select">
            <option value="">-- Proveedor --</option>
            @foreach ($proveedores as $proveedor)
                <option value="{{ $proveedor->nombre }}">{{ $proveedor->nombre }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2 d-grid">
        <button id="limpiarFiltros" class="btn btn-secondary">Limpiar filtros</button>
    </div>
</div>

{{-- TABLA --}}
<div class="card clean-card shadow-lg border-0">
    <div class="card-body p-0">
        <div class="table-responsive px-3">
            <table id="tablaProductos" class="table table-hover table-striped align-middle text-center mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Categoría</th>
                        <th>Proveedor</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td class="fw-bold">{{ $producto->nombre }}</td>
                        <td style="max-width:200px" class="text-start text-muted">
                            {{ Str::limit($producto->descripcion, 60) }}
                        </td>
                        <td class="fw-bold text-success">${{ number_format($producto->precio,2) }}</td>

                        <td>
                            @if($producto->stock <= 5)
                                <span class="badge bg-danger">{{ $producto->stock }}</span>
                            @elseif($producto->stock <= 20)
                                <span class="badge bg-warning text-dark">{{ $producto->stock }}</span>
                            @else
                                <span class="badge bg-success">{{ $producto->stock }}</span>
                            @endif
                        </td>

                        <td>{{ $producto->categoria->nombre }}</td>
                        <td>{{ $producto->proveedor->nombre }}</td>

                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('productos.edit',$producto->id) }}" class="btn btn-edit btn-sm btn-action-table">
                                    ✏️
                                </a>
                                <form action="{{ route('productos.destroy',$producto->id) }}" method="POST" onclick="confirmarEliminacion(event)">
                                    @csrf
                                    <button class="btn btn-danger btn-sm btn-action-table">
                                        🗑️
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

{{-- ===== LIBRERÍAS DATATABLE ===== --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

{{-- ===== SCRIPT DATATABLE ===== --}}
<script>
$(document).ready(function(){
    var table = $("#tablaProductos").DataTable({
        language: {
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_",
            zeroRecords: "No hay coincidencias",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            paginate: { next: "Siguiente", previous: "Anterior" }
        }
    });

    $("#buscarNombre").on("keyup", function() {
        table.column(1).search(this.value).draw();
    });

    $("#filtroCategoria").on("change", function() {
        table.column(5).search(this.value).draw();
    });

    $("#filtroProveedor").on("change", function() {
        table.column(6).search(this.value).draw();
    });

    $("#limpiarFiltros").click(function(){
        $("#buscarNombre").val("");
        $("#filtroCategoria").val("");
        $("#filtroProveedor").val("");
        table.columns().search("").draw();
    });
});
</script>

{{-- Confirmación eliminación --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmarEliminacion(event) {
    event.preventDefault();
    const form = event.target.closest('form');

    Swal.fire({
        title: '¿Seguro?',
        text: "Esta acción no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) form.submit();
    });
}
</script>

<script src="https://unpkg.com/sweetalert2@11"></script>


@endsection
