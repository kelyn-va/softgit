@extends('layouts.app')

@section('title', 'Administrar compra')

@section('titleContent')
<h1 class="text-center my-4 fw-bold text-dark">compras</h1>
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

    <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
        <a href="{{ route('welcome') }}" class="volverBtn d-flex align-items-center gap-2">
            🔙 <i class="bi bi-arrow-left-circle iconBtn"></i> Volver
        </a>

        <form action="{{ route('compras.index') }}" method="GET" class="d-flex search-box">

        </form>

        <a href="{{ route('compras.create') }}" class="crearBtn d-flex align-items-center gap-2">
            ➕<i class="bi bi-plus-circle"></i> Crear Compra
        </a>
    </div>

    <div class="card custom-card shadow-lg border-0">
        <div class="card-body">
            <table class="table table-striped table-hover align-middle text-center mb-0">
                <thead style="background: #a8dadc; color:#fff;">
                    <tr>
                        <th>ID</th>
                        <th>precioCompra</th>
                        <th>precioVenta</th>
                        <th>Total</th>
                        <th>metodoPago</th>
                        <th>Cantidad</th>
                        <th>idproveedor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($compras as $compra)


                    <tr>
                        <td>{{$compra->id }}</td>
                        <td>{{$compra->precioCompra }}</td>
                        <td>{{$compra->precioVenta }}</td>
                        <td>{{$compra->Total }}</td>
                        <td>{{$compra->metodoPago  }}</td>
                        <td>{{$compra->Cantidad }}</td>
                        <td>{{$compra->idproveedor }}</td>

                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('compras.edit', $compra->id) }}" class="btnActualizar d-flex gap-2 align-items-center">
                                    ✏️ <i class="bi bi-pencil-square"></i> Actualizar
                                </a>

                                <form action="{{ route('compras.destroy', $compra->id) }}" method="POST" onsubmit="return confirmarEliminacion(event)">
                                    @csrf

                                    <button type="submit" class="btnEliminar d-flex gap-2 align-items-center">
                                        🗑️ <i class="bi bi-trash"></i> Eliminar
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