@extends('layouts.app')

@section('title', 'Crear Producto')

@section('content')

<div class="container mt-4">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-success text-white fw-bold">
            Registrar Nuevo Producto
        </div>

        <div class="card-body">

            <form action="{{ route('productos.store') }}" method="POST">
                @csrf

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Precio</label>
                        <input type="number" step="0.01" name="precio" class="form-control" required>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Stock</label>
                        <input type="number" name="stock" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Categoría</label>
                        <select name="idCategoria" class="form-select" required>
                            @foreach($categorias as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Proveedor</label>
                        <select name="idProveedor" class="form-select" required>
                            @foreach($proveedores as $prov)
                                <option value="{{ $prov->id }}">{{ $prov->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button class="btn btn-success">Guardar Producto</button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection
