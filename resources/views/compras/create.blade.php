@extends('layouts.app')

@section('title', 'Crear compra')

@section('titleContent')
<h1 class="text-center my-4 fw-bold text-dark">Crear Compra</h1>
@endsection

@section('content')
<style>
    :root {
        --primary-soft-blue: #007bff;
        --light-blue-bg: #f0f7ff;
        --header-bg: #d0e7ff;
        --text-dark: #344767;
        --card-border: #daeafc;
        --input-border: #c4daee;
        --input-focus-shadow: rgba(0, 123, 255, 0.25);
    }

    .clean-card {
        background-color: white !important;
        border-radius: 12px !important;
        border: 1px solid var(--card-border) !important;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .clean-input {
        border-radius: 8px !important;
        border: 1px solid var(--input-border) !important;
        padding: 0.6rem 1rem;
        background: #ffffff !important;
        transition: all 0.2s;
        color: var(--text-dark) !important;
    }

    .clean-input:focus {
        border-color: var(--primary-soft-blue) !important;
        box-shadow: 0 0 0 0.2rem var(--input-focus-shadow);
        background-color: #fcfdff !important;
    }

    .form-label {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.3rem;
    }

    .btn-action-primary {
        background-color: var(--primary-soft-blue) !important;
        border: none !important;
        color: white !important;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 600;
        transition: background-color 0.2s ease;
        text-decoration: none;
    }

    .btn-action-primary:hover {
        background-color: #0069d9 !important;
    }

    .btn-back {
        background-color: #e9f5ff !important;
        color: var(--primary-soft-blue) !important;
        border: 1px solid var(--card-border) !important;
        border-radius: 8px;
        padding: 10px 18px;
        font-weight: 600;
        transition: background-color 0.2s ease;
        text-decoration: none;
    }

    .btn-back:hover {
        background-color: #daeafc !important;
        color: #0056b3 !important;
    }
</style>


<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="mb-3 text-start">
                <a href="{{ route('compras.index') }}" class="volverBtn btn-back d-inline-flex align-items-center gap-1">
                    <i class="bi bi-arrow-left-circle"></i> Volver a compras
                </a>
            </div>

            <div class="card clean-card shadow-lg border-0">
                <div class="card-body p-4">

                    <form action="{{ route('compras.store') }}" method="POST">
                        @csrf

                        <div class="row g-4">

                            {{-- Columna izquierda --}}
                            <div class="col-md-6">

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Precio de Compra</label>
                                    <input type="number" step="0.01" id="precioCompra" name="precioCompra"
                                        class="form-control clean-input @error('precioCompra') is-invalid @enderror">
                                    @error('precioCompra')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Precio de Venta</label>
                                    <input type="number" step="0.01" id="precioVenta" name="precioVenta"
                                        class="form-control clean-input @error('precioVenta') is-invalid @enderror">
                                    @error('precioVenta')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Cantidad</label>
                                    <input type="number" step="1" id="Cantidad" name="Cantidad"
                                        class="form-control clean-input @error('Cantidad') is-invalid @enderror">
                                    @error('Cantidad')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Total</label>
                                    <input type="number" step="0.01" id="Total" name="Total" readonly
                                        class="form-control clean-input @error('Total') is-invalid @enderror">
                                    @error('Total')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            {{-- Columna derecha --}}
                            <div class="col-md-6">

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Método de Pago</label>
                                    <select name="metodoPago" id="metodoPago"
                                            class="form-select clean-input @error('metodoPago') is-invalid @enderror">
                                        <option value="">Seleccione un método</option>
                                        <option value="Efectivo">Efectivo</option>
                                        <option value="Tarjeta">Tarjeta</option>
                                        <option value="Transferencia">Transferencia</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Proveedor</label>
                                    <select id="idproveedor" name="idproveedor"
                                        class="form-select clean-input @error('idproveedor') is-invalid @enderror">
                                        <option value="">Selecciona un proveedor</option>
                                        @foreach ($proveedores as $proveedor)
                                            <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Producto</label>
                                    <select id="idproducto" name="idproducto"
                                        class="form-select clean-input @error('idproducto') is-invalid @enderror">
                                        <option value="">Selecciona un producto</option>
                                        @foreach ($productos as $producto)
                                            <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                        </div>

                        <div class="text-end mt-3">
                            <button type="submit" class="btn-action-primary">
                                <i class="bi bi-person-plus"></i> Crear Compra
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection

<script>
document.addEventListener("DOMContentLoaded", function() {
    const precioCompra = document.getElementById("precioCompra");
    const Cantidad = document.getElementById("Cantidad");
    const Total = document.getElementById("Total");

    function calcularTotal() {
        const p = parseFloat(precioCompra.value) || 0;
        const c = parseInt(Cantidad.value) || 0;

        let total = p * c;

        // Si es entero lo muestra sin decimales, si no, con dos
        Total.value = Number.isInteger(total) ? total : total.toFixed(2);
    }

    precioCompra.addEventListener("input", calcularTotal);
    Cantidad.addEventListener("input", calcularTotal);
});
</script>
