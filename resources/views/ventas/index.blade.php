@extends('layouts.app')

@section('title', 'Administrar Ventas')

@section('titleContent')
    <header class="encabezado-ventas shadow-sm">
        <h1>Gestión de Ventas</h1>
        <p>Administra los registros de tus ventas fácilmente</p>
    </header>
@endsection

@section('content')

{{-- Script para el mensaje de éxito usando SweetAlert2 --}}
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

    {{-- Botón para crear nueva venta --}}
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('ventas.create') }}" class="crearBtn"> Crear Venta</a>
    </div>

    {{-- Tabla de Ventas --}}
    <div class="card custom-card shadow-lg border-0">
        <div class="card-body">
            <table class="table table-striped table-hover align-middle text-center mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Cliente</th>
                        <th>Empleado</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ventas as $venta)
                        <tr>
                            <td>{{ $venta->id }}</td>
                            <td>{{ $venta->fecha }}</td>
                            <td>${{ number_format($venta->total, 2, ',', '.') }}</td>
                            {{-- Se asume que el modelo Cliente tiene un campo 'Nombre' --}}
                            <td>{{ $venta->cliente->Nombre ?? 'N/A' }}</td>
                            {{-- Se asume que el modelo Empleado tiene un campo 'Nombre' --}}
                            <td>{{ $venta->empleado->nombre ?? 'N/A' }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    {{-- Botón de Actualizar --}}
                                    <a href="{{ route('ventas.edit', $venta->id) }}" class="btnActualizar">
                                         Actualizar
                                    </a>

                                    {{-- Formulario de Eliminar --}}
                                    <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" onclick="confirmarEliminacion(event)">
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
                            <td colspan="6" class="text-muted">No hay ventas registradas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<footer>
    Realizado por <b>Karen Julieth Sepúlveda Sánchez</b> - <b>Vanessa García Corzo</b> | 2025
</footer>

{{-- Script para la confirmación de eliminación usando SweetAlert2 --}}
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