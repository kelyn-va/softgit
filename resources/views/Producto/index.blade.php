@extends('layouts.app')

@section('title', 'Administrar Productos')

@section('titleContent')
<h1 class="text-center my-4 fw-bold text-dark">Listado de Productos</h1>
@endsection

@section('content')

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

    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('welcome') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2">
            <i class="bi bi-arrow-left"></i> Volver
        </a>

        <form action="{{ route('productos.index') }}" method="GET" class="d-flex">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar producto...">
        </form>

        <a href="{{ route('productos.create') }}" class="btn btn-success d-flex align-items-center gap-2">
            <i class="bi bi-plus-circle"></i> Crear Producto
        </a>
    </div>

    <div class="card shadow-lg border-0">
        <div class="card-body p-0">
            <table class="table table-hover table-striped align-middle text-center mb-0">
                <thead class="bg-dark text-white">
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
                    @forelse ($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td class="fw-bold">{{ $producto->nombre }}</td>
                        <td style="max-width:200px">{{ Str::limit($producto->descripcion, 60) }}</td>
                        <td>${{ number_format($producto->precio,2) }}</td>

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
                                <a href="{{ route('productos.edit',$producto->id) }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form action="{{ route('productos.destroy',$producto->id) }}" method="POST" onsubmit="return confirmarEliminacion(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center p-3 text-muted">No hay productos registrados</td>
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
    const form = event.target;

    Swal.fire({
        title: "¿Eliminar producto?",
        text: "Esta acción no se puede revertir",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Eliminar",
        cancelButtonText: "Cancelar"
    }).then(result => {
        if (result.isConfirmed) form.submit();
    });
}
</script>

@endsection
