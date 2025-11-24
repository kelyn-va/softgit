@extends('layouts.app')

@section('title', 'Administrar Productos')

@section('titleContent')
<h1 class="text-center my-4 fw-bold text-dark">Listado de Productos</h1>
@endsection

@section('content')

<style>
    /* --- VARIABLES DE ESTILO LIMPIO Y AZUL PASTEL --- */
    :root {
        --primary-soft-blue: #007bff; /* Azul primario para acentos */
        --light-blue-bg: #f0f7ff; /* Fondo de card y tabla muy claro */
        --header-bg: #d0e7ff; /* Azul pastel para encabezados */
        --text-dark: #344767; /* Color de texto oscuro para legibilidad */
        --card-border: #daeafc; /* Borde sutil */
        --btn-edit: #007bff; /* Azul para editar */
        --btn-edit-hover: #0056b3;
    }

    /* Estilo para el contenedor de la tabla */
    .clean-card {
        background-color: var(--light-blue-bg) !important;
        border-radius: 12px !important; /* Menos redondeado */
        border: 1px solid var(--card-border) !important;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); /* Sombra sutil */
    }
    
    /* Estilo de la cabecera de la tabla */
    .table thead {
        background-color: var(--header-bg) !important;
        color: var(--text-dark) !important;
    }
    .table thead th {
        border-color: #c4daee !important;
        font-weight: 600;
        text-transform: uppercase;
    }

    /* Input de búsqueda */
    .clean-input {
        border-radius: 8px !important;
        border: 1px solid var(--card-border) !important;
        padding: 0.5rem 1rem;
    }

    /* Botones de acción principal (Crear, Volver) */
    .btn-action-primary {
        background-color: var(--primary-soft-blue) !important;
        border: none !important;
        color: white !important;
        border-radius: 8px !important;
        padding: 10px 18px !important;
        font-weight: 600;
        transition: background-color 0.2s ease;
    }
    .btn-action-primary:hover {
        background-color: #0069d9 !important;
    }

    /* Botón Volver específico */
    .btn-back {
        background-color: #e9f5ff !important;
        color: var(--primary-soft-blue) !important;
        border: 1px solid var(--card-border) !important;
    }
    .btn-back:hover {
        background-color: #daeafc !important;
        color: #0056b3 !important;
    }

    /* Botones de acciones en la tabla (Editar, Eliminar) */
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

    /* Personalizar Modal */
    .modal-header-clean {
        background-color: var(--header-bg) !important;
        color: var(--text-dark) !important;
        border-bottom: 1px solid var(--card-border);
    }
    .modal-header-clean .modal-title {
        font-weight: 600;
    }
    .modal-content {
        border-radius: 12px;
    }
    .modal-footer .btn-primary {
        background-color: var(--primary-soft-blue);
        border-color: var(--primary-soft-blue);
    }
    .modal-footer .btn-primary:hover {
        background-color: #0069d9;
        border-color: #0069d9;
    }
    /* Estilo para el formulario dentro del modal */
    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #c4daee;
        padding: 0.6rem 1rem;
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

    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('welcome') }}" class="btn btn-back btn-action-primary d-flex align-items-center gap-2">
            <i class="fas fa-arrow-left"></i> Volver
        </a>

        <form action="{{ route('productos.index') }}" method="GET" class="d-flex w-50 mx-4">
            <input type="text" name="buscar" class="form-control clean-input shadow-sm" placeholder="Buscar producto por nombre o descripción...">
        </form>

        <button class="btn btn-action-primary" data-bs-toggle="modal" data-bs-target="#crearProductoModal">
            <i class="fas fa-plus me-1"></i> Crear Producto
        </button>
    </div>

    <div class="card clean-card shadow-lg border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle text-center mb-0">
                    <thead>
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
                            <td style="max-width:200px" class="text-start text-muted">{{ Str::limit($producto->descripcion, 60) }}</td>
                            <td class="fw-bold text-success">${{ number_format($producto->precio,2) }}</td>

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
                                    <a href="{{ route('productos.edit',$producto->id) }}" class="btn btn-edit btn-sm btn-action-table">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>

                                    <form action="{{ route('productos.destroy',$producto->id) }}" method="POST" onsubmit="return confirmarEliminacion(event)">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm btn-action-table">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center p-4 text-muted">No hay productos registrados que coincidan con la búsqueda.</td>
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
    const form = event.target;

    Swal.fire({
        title: "¿Eliminar producto?",
        text: "Esta acción no se puede revertir",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc3545", // Rojo de Bootstrap
        cancelButtonColor: "#6c757d", // Gris de Bootstrap
        confirmButtonText: "Sí, Eliminar",
        cancelButtonText: "Cancelar"
    }).then(result => {
        if (result.isConfirmed) form.submit();
    });
}
</script>

<div class="modal fade" id="crearProductoModal" tabindex="-1" aria-labelledby="crearProductoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header modal-header-clean">
        <h5 class="modal-title" id="crearProductoModalLabel"><i class="fas fa-box me-2"></i> Registrar Nuevo Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="{{ route('productos.store') }}" method="POST">
        @csrf
        
        <div class="modal-body">

          <div class="row g-3">

            <div class="col-md-6">
              <label class="form-label fw-bold text-dark">Nombre</label>
              <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-bold text-dark">Precio</label>
              <input type="number" step="0.01" name="precio" class="form-control" required>
            </div>

            <div class="col-md-12">
              <label class="form-label fw-bold text-dark">Descripción</label>
              <textarea name="descripcion" class="form-control" rows="3"></textarea>
            </div>

            <div class="col-md-4">
              <label class="form-label fw-bold text-dark">Stock</label>
              <input type="number" name="stock" class="form-control" required>
            </div>

            <div class="col-md-4">
              <label class="form-label fw-bold text-dark">Categoría</label>
              <select name="idCategoria" class="form-select" required>
                @foreach($categorias as $categoria)
                  <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-4">
              <label class="form-label fw-bold text-dark">Proveedor</label>
              <select name="idProveedor" class="form-select" required>
                @foreach($proveedores as $proveedor)
                  <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                @endforeach
              </select>
            </div>

          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button class="btn btn-primary">Guardar Producto</button>
        </div>

      </form>

    </div>
  </div>
</div>


@endsection