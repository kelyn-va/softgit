@extends('layouts.app')

@section('title', 'Administrar Inventario')

@section('titleContent')
    <h1 class="text-center my-4 fw-bold text-dark">Inventario</h1>
@endsection

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
        <a href="{{route('welcome')}}" >
            🔙<i class="bi bi-arrow-left iconBack">Volver </i>
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

    <!-- Row con tres cards -->
    <div class="row mb-4">
        <!-- Card Productos -->
        <div class="col-md-4">
            <div class="card custom-card shadow-lg border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">📦 Productos Registrados</h5>
                    <a href="{{ route('productos.index') }}" class="btn btn-light btn-sm">
                        Ir a <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge bg-primary" style="font-size: 1.2rem; padding: 10px 15px;">
                            {{ $productos->count() }} productos
                        </span>
                    </div>
                    <div style="max-height: 300px; overflow-y: auto;">
                        @forelse ($productos as $producto)
                            <div class="d-flex justify-content-between align-items-center p-2 border-bottom">
                                <div>
                                    <h6 class="mb-1">{{ $producto->nombre }}</h6>
                                    <small class="text-muted">
                                        <strong>Precio:</strong> ${{ number_format($producto->precio, 2) }} | 
                                        <strong>Stock:</strong> {{ $producto->stock }}
                                    </small>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted text-center py-3">No hay productos registrados</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Categorías -->
        <div class="col-md-4">
            <div class="card custom-card shadow-lg border-0">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">🏷️ Categorías Registradas</h5>
                    <a href="{{ route('categorias.index') }}" class="btn btn-light btn-sm">
                        Ir a <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge bg-success" style="font-size: 1.2rem; padding: 10px 15px;">
                            {{ $categorias->count() }} categorías
                        </span>
                    </div>
                    <div style="max-height: 300px; overflow-y: auto;">
                        @forelse ($categorias as $categoria)
                            <div class="d-flex justify-content-between align-items-center p-2 border-bottom">
                                <div>
                                    <h6 class="mb-0">{{ $categoria->nombre }}</h6>
                                </div>
                                <small class="text-muted">
                                    {{ $productos->where('idCategoria', $categoria->id)->count() }} producto(s)
                                </small>
                            </div>
                        @empty
                            <p class="text-muted text-center py-3">No hay categorías registradas</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Proveedores -->
        <div class="col-md-4">
            <div class="card custom-card shadow-lg border-0">
                <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">🚚 Proveedores Registrados</h5>
                    <a href="{{ route('proveedor.index') }}" class="btn btn-light btn-sm">
                        Ir a <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge bg-warning" style="font-size: 1.2rem; padding: 10px 15px;">
                            {{ $proveedores->count() }} proveedores
                        </span>
                    </div>
                    <div style="max-height: 300px; overflow-y: auto;">
                        @forelse ($proveedores as $proveedor)
                            <div class="d-flex justify-content-between align-items-center p-2 border-bottom">
                                <div>
                                    <h6 class="mb-1">{{ $proveedor->nombre }}</h6>
                                    <small class="text-muted">
                                        <strong>Tel:</strong> {{ $proveedor->telefono }} | 
                                        <strong>Contacto:</strong> {{ $proveedor->contacto }}
                                    </small>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted text-center py-3">No hay proveedores registrados</p>
                        @endforelse
                    </div>
                </div>
            </div>
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
