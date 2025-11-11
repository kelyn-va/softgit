@extends('layouts.app')

@section('title', 'Administrar Detalle de Ventas')

@section('titleContent')
    <header class="encabezado-clientes shadow-sm">
        <h1>Gestión de Detalles de Ventas</h1>
        <p>Administra los detalles de las ventas registradas</p>
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
        <a href="{{ route('DetalleVenta.create') }}" class="crearBtn"> Crear Detalle de Venta</a>
    </div>

    <div class="card custom-card shadow-lg border-0">
        <div class="card-body">
            <table class="table table-striped table-hover align-middle text-center mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                        <th>ID Venta</th>
                        <th>ID Producto</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($detalleVenta as $detalle)
                        <tr>
                            <td>{{ $detalle->id }}</td>
                            <td>{{ $detalle->cantidad }}</td>
                            <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                            <td>${{ number_format($detalle->subtotal, 2) }}</td>
                            <td>
                                {{ $detalle->venta ? $detalle->venta->id : 'Sin asignar' }}
                            </td>
                            <td>
                                {{ $detalle->producto ? $detalle->producto->nombre : 'Sin asignar' }}
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('DetalleVenta.edit', $detalle->id) }}" class="btnActualizar">
                                        Actualizar
                                    </a>

                                    <form action="{{ route('DetalleVenta.destroy', $detalle->id)}}" method="POST" onclick="confirmarEliminacion(event)">
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
                            <td colspan="7" class="text-muted">No hay detalles de venta registrados</td>
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
