@extends('layouts.app')

@section('title', 'Administrar Categorias')

@section('titleContent')
<h1 class="text-center my-4 fw-bold text-dark">Categorías</h1>
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
        text-decoration: none;
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

    .clean-input {
        border-radius: 8px !important;
        border: 1px solid var(--card-border) !important;
        padding: 0.5rem 1rem;
        width: 100%;
        margin-bottom: 1rem;
    }
</style>

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function(){
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
        <a href="{{ route('categorias.create') }}" class="btn btn-action-primary">
            <i class="fas fa-plus me-1"></i> Crear Categoría
        </a>
    </div>

    {{-- Búsqueda --}}
    <input type="text" id="buscarNombre" class="form-control clean-input" placeholder="Buscar por nombre...">

    {{-- Tabla --}}
    <div class="card clean-card shadow-lg border-0">
        <div class="card-body p-0">
            <div class="table-responsive px-3">
                <table id="tablaCategorias" class="table table-striped table-hover align-middle text-center mb-0">
                    <thead style="background: var(--header-bg); color: var(--text-dark)">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->id }}</td>
                            <td class="fw-bold">{{ $categoria->nombre }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('categorias.edit',$categoria->id) }}" class="btn btn-edit btn-sm btn-action-table">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('categorias.destroy',$categoria->id) }}" method="POST" onsubmit="return confirmarEliminacion(event)">
                                        @csrf
                                        <button type="submit" class="btn btn-delete btn-sm btn-action-table">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
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

{{-- DataTable y búsqueda en tiempo real --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function(){
    var table = $('#tablaCategorias').DataTable({
        language: {
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_",
            zeroRecords: "No hay coincidencias",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            paginate: { next: "Siguiente", previous: "Anterior" }
        }
    });

    $('#buscarNombre').on('keyup', function(){
        table.column(1).search(this.value).draw();
    });
});
</script>

{{-- Confirmación eliminar --}}
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
