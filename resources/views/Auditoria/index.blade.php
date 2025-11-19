@extends('layouts.app')

@section('title', 'Administrar Auditorías')

@section('titleContent')
    <header class="encabezado-clientes shadow-sm">
        <h1>Gestión de Auditorías</h1>
        <p>Consulta y administra los registros de auditoría del sistema</p>
    </header>
@endsection

@section('content')

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

    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('Auditoria.create') }}" class="crearBtn"> Crear Registro</a>
    </div>

    <div class="card custom-card shadow-lg border-0">
        <div class="card-body">
            <table class="table table-striped table-hover align-middle text-center mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Acción</th>
                        <th>Fecha</th>
                        <th>Cierre de Caja</th>
                        <th>ID Empleado</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($auditorias as $auditoria)
                        <tr>
                            <td>{{ $auditoria->id }}</td>
                            <td>{{ $auditoria->Accion }}</td>
                            <td>{{ $auditoria->fecha }}</td>
                            <td>{{ $auditoria->cierreCaja }}</td>
                            <td>{{ $auditoria->empleado->nombre }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('Auditoria.edit', $auditoria->id) }}" class="btnActualizar">
                                        Actualizar
                                    </a>

                                    <form action="{{ route('Auditoria.destroy', $auditoria->id) }}" method="POST" onclick="confirmarEliminacion(event)">
                                        @csrf
                                      
                                        <button type="submit" class="btnEliminar">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-muted">No hay registros de auditoría</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>



<script>
    function confirmarEliminacion(event) {
        event.preventDefault();
        const form = event.target.closest('form');

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
