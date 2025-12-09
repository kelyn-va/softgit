@extends('layouts.app')

@section('title', 'Administrar Empleados')

@section('titleContent')
<h1 class="text-center my-4 fw-bold text-dark">Administración de Empleados</h1>
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
        --btn-delete: #dc3545;
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

    .table tbody tr:nth-child(even) {
        background-color: #eaf4ff !important;
    }

    .table tbody tr:hover {
        background-color: #d4e9ff !important;
    }

    .clean-input {
        border-radius: 8px;
        border: 1px solid var(--card-border);
        padding: 0.6rem 1rem;
    }

    .btn-action-primary {
        background-color: var(--primary-soft-blue) !important;
        color: white !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 10px 18px !important;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
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

    .btn-delete {
        background-color: var(--btn-delete) !important;
        color: white !important;
    }

    .badge-info {
        background-color: #66b3ff !important;
        color: white !important;
        padding: 0.35em 0.6em;
        font-weight: 600;
        border-radius: 4px;
    }

    .btn-action-table {
        border-radius: 6px;
        padding: 6px 10px;
        font-size: .85rem;
    }
</style>

@if (session('success'))
<script>
document.addEventListener("DOMContentLoaded", function () {
    Swal.fire({
        icon: "success",
        title: "¡Éxito!",
        text: "{{ session('success') }}",
        timer: 2500
    });
});
</script>
@endif

<div class="container">

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('empleados.create') }}" class="btn btn-action-primary">
            <i class="fas fa-plus me-1"></i> Crear Empleado
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
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Cargo</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($empleados as $empleado)
                        <tr>
                            <td>{{ $empleado->id }}</td>
                            <td class="fw-bold">{{ $empleado->nombre }}</td>
                            <td>{{ $empleado->telefono }}</td>
                            <td>{{ $empleado->correo }}</td>
                            <td><span class="badge badge-info">{{ $empleado->cargo }}</span></td>

                            <td>
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('empleados.edit', $empleado->id) }}"
                                        class="btn btn-edit btn-action-table">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>

                                    <form action="{{ route('empleados.destroy', $empleado->id) }}"
                                          method="POST" onsubmit="confirmarEliminacion(event)">
                                        @csrf
                                        
                                        <button type="submit" class="btn btn-delete btn-action-table">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4" style="background-color:#e0f4ff;">
                                <i class="fas fa-info-circle"></i> No se encontraron empleados registrados.
                            </td>
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
    const form = event.target.closest("form");

    Swal.fire({
        title: "¿Estás seguro?",
        text: "Esta acción no se puede deshacer.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc3545",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) form.submit();
    });
}
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection
