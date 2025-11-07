@extends('layouts.app')

@section('title', 'Administrar turnos')

@section('titleContent')
    <h1 class="text-center my-4 fw-bold text-dark">Turnos</h1>
@endsection

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
        <a href="{{ route('welcome') }}">
            <i class="bi bi-arrow-left iconBack"></i> Volver
        </a>

        <a href="{{ route('turnos.create') }}" class="crearBtn">
            <i class="bi bi-plus-circle"></i> Crear turnos
        </a>

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
    </div>

    <div class="card custom-card shadow-lg border-0">
        <div class="card-body">
            <table class="table custom-table table-hover align-middle text-center mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Inicio del Turno</th>
                        <th>Fin del Turno</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($turnos as $Turno)
                        <tr>
                            <td>{{ $Turno->id }}</td>
                            <td>{{ $Turno->InicioTurno }}</td>
                            <td>{{ $Turno->FinTurno }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('turnos.edit', $Turno->id) }}" class="btnActualizar d-flex gap-2 align-items-center">
                                        <i class="bi bi-pencil-square"></i> Actualizar
                                    </a>

                                    <form action="{{ route('turnos.destroy', $Turno->id) }}" method="POST" onclick="confirmarEliminacion(event)">
                                        @csrf
                                        <button type="submit" class="btnEliminar d-flex gap-2 align-items-center">
                                            <i class="bi bi-trash"></i> Eliminar
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
