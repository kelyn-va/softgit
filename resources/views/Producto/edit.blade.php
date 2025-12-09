@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')

<div class="container mt-4">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white fw-bold">
            Editar Producto
        </div>

        <div class="card-body">

            <form action="{{ route('productos.update', $productos->id) }}" method="POST">
                @csrf
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{ $productos->nombre }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Precio</label>
                        <input type="number" step="0.01" name="precio" class="form-control" value="{{ $productos->precio }}" required>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control" rows="3">{{ $productos->descripcion }}</textarea>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Stock</label>
                        <input type="number" name="stock" class="form-control" value="{{ $productos->stock }}" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Categoría</label>
                        <select name="idCategoria" class="form-select select2" required>
                            @foreach($categorias as $cat)
                            <option value="{{ $cat->id }}" {{ $productos->idCategoria == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nombre }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Proveedor</label>
                        <select name="idProveedor" class="form-select" required>
                            @foreach($proveedores as $prov)
                            <option value="{{ $prov->id }}" {{ $productos->idProveedor == $prov->id ? 'selected' : '' }}>
                                {{ $prov->nombre }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>

            </form>

        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Seleccione una categoría",
            allowClear: true,
            width: '100%'  // para que no se dañe el diseño
        });
    });x
</script>

@endpush




@endsection