@extends('layouts.app')

@section('title', 'Administrar Métodos de Pago')

@section('titleContent')
    <h1 class="text-center my-4 fw-bold text-dark">Métodos de Pago</h1>
@endsection

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
        <a href="{{ route('welcome') }}">
            <i class="bi bi-arrow-left iconBack">Volver </i>
        </a>

        <a href="{{ route('metodoPago.create') }}" class="crearBtn">
            <i class="bi bi-plus-circle"></i> Crear Método de Pago
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
            <table class="table table-hover align-middle text-center mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($metodoPago as $metodo)
                        <tr>
                            <td>{{ $metodo->id }}</td>
                            <td>{{ $metodo->descripcion }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('metodoPago.edit', $metodo->id) }}" class="btnActualizar d-flex gap-2 align-items-center">
                                        <i class="bi bi-pencil-square"></i> Actualizar
                                    </a>

                                    <form action="{{ route('metodoPago.destroy', $metodo->id) }}" method="POST" onclick="confirmarEliminacion(event)">
                                        @csrf
                                     
                                        <button type="submit" class="btnEliminar d-flex gap-2 align-items-center">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-muted">No hay métodos de pago registrados</td>
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
            text: "¡No podrás revertir esta acción!",
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
