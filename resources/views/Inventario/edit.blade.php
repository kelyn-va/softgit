@extends('layouts.app')

@section('title', 'Actualizar Inventario')

@section('titleContent')
<h1 class="text-center my-4 fw-bold text-dark">Actualizar Inventario</h1>
@endsection

@section('content')

<div class="container py-4">

    <div class="card custom-card shadow-lg border-0 p-4">
        <form action="{{ route('inventario.update', $inventario->id) }}" method="POST">
            @csrf


            {{-- SELECT PRODUCTO --}}
            <div class="mb-3">
                <label for="idProducto" class="form-label">Producto</label>
                <select id="idProducto" name="idProducto"
                    class="form-control @error('idProducto') is-invalid @enderror" required>

                    <option value="">Seleccione un producto</option>

                    @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}"
                        {{ $inventario->id_producto == $producto->id ? 'selected' : '' }}>
                        {{ $producto->nombre }}
                    </option>
                    @endforeach

                </select>

                @error('idProducto')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- CANTIDAD --}}
            <div class="mb-3">
                <label for="Cantidad" class="form-label">Cantidad</label>
                <input type="number" id="Cantidad" name="Cantidad"
                    class="form-control @error('Cantidad') is-invalid @enderror"
                    value="{{ $inventario->Cantidad }}" required min="1">

                @error('Cantidad')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- FECHA --}}
            <div class="mb-3">
                <label for="FechaActualizacion" class="form-label">Fecha de actualizacion</label>
                <input type="datetime-local" id="FechaActualizacion" name="FechaActualizacion"
                    class="form-control @error('FechaActualizacion') is-invalid @enderror"
                    value="{{ $inventario->FechaActualizacion }}" required>

                @error('FechaActualizacion')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- BOTONES --}}
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('inventario.index') }}" class="btnVolver">
                    <i class="bi bi-arrow-left"></i> Volver
                </a>

                <button type="submit" class="btnGuardar">
                    <i class="bi bi-save"></i> Actualizar Inventario
                </button>
            </div>

        </form>
    </div>

</div>

@endsection