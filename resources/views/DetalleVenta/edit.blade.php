@extends('layouts.app')

@section('title', 'Editar Detalle de Venta')

@section('titleContent')
    <h1 class="text-center my-4 fw-bold text-dark">Editar Detalle de Venta</h1>
@endsection

@section('content')
<div class="overlay-modal">
    <div class="modal-card p-4">

        {{-- Botón de volver --}}
        <div class="mb-3 text-start">
            <a href="{{ route('DetalleVenta.index') }}" class="volverBtn d-inline-flex align-items-center gap-1">
                <i class="bi bi-arrow-left-circle"></i> Volver
            </a>
        </div>

        {{-- Tarjeta del formulario --}}
        <div class="card custom-card shadow-lg border-0">
            <div class="card-body p-4">

                <form action="{{ route('DetalleVenta.update', $detalleVenta->id) }}" method="POST">
                    @csrf
                 

                    {{-- Campo Cantidad --}}
                    <div class="mb-3">
                        <label for="cantidad" class="form-label fw-semibold">Cantidad</label>
                        <input type="number" id="cantidad" name="cantidad"
                            class="form-control @error('cantidad') is-invalid @enderror"
                            value="{{ old('cantidad', $detalleVenta->cantidad) }}" placeholder="Ejemplo: 2">
                        @error('cantidad')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Campo Precio Unitario --}}
                    <div class="mb-3">
                        <label for="precio_unitario" class="form-label fw-semibold">Precio Unitario</label>
                        <input type="number" step="0.01" id="precio_unitario" name="precio_unitario"
                            class="form-control @error('precio_unitario') is-invalid @enderror"
                            value="{{ old('precio_unitario', $detalleVenta->precio_unitario) }}" placeholder="Ejemplo: 25000.00">
                        @error('precio_unitario')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Campo Subtotal --}}
                    <div class="mb-3">
                        <label for="subtotal" class="form-label fw-semibold">Subtotal</label>
                        <input type="number" step="0.01" id="subtotal" name="subtotal"
                            class="form-control @error('subtotal') is-invalid @enderror"
                            value="{{ old('subtotal', $detalleVenta->subtotal) }}" placeholder="Ejemplo: 50000.00">
                        @error('subtotal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Campo ID Venta --}}
                    <div class="mb-3">
                        <label for="idVenta" class="form-label fw-semibold">Venta Asociada</label>
                        <select id="idVenta" name="idVenta" class="form-select @error('idVenta') is-invalid @enderror">
                            <option value="" disabled>Seleccione una venta</option>
                            @foreach ($ventas as $venta)
                                <option value="{{ $venta->id }}"
                                    {{ old('idVenta', $detalleVenta->idVenta) == $venta->id ? 'selected' : '' }}>
                                    Venta #{{ $venta->id }}
                                </option>
                            @endforeach
                        </select>
                        @error('idVenta')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Campo ID Producto --}}
                    <div class="mb-3">
                        <label for="idProducto" class="form-label fw-semibold">Producto</label>
                        <select id="idProducto" name="idProducto" class="form-select @error('idProducto') is-invalid @enderror">
                            <option value="" disabled>Seleccione un producto</option>
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->id }}"
                                    {{ old('idProducto', $detalleVenta->idProducto) == $producto->id ? 'selected' : '' }}>
                                    {{ $producto->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('idProducto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-end">
                        <button type="submit" class="crearBtn">
                            <i class="bi bi-pencil-square"></i> Actualizar Detalle
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
