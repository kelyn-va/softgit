@extends('layouts.app')

@section('title', 'Crear compra')

@section('titleContent')
<h1 class="text-center my-4 fw-bold text-dark">Crear Compra</h1>
@endsection

@section('content')


<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            {{-- Botón de volver --}}
            <div class="mb-3 text-start">
                <a href="{{ route('compras.index') }}" class="volverBtn d-inline-flex align-items-center gap-1">
                    🔙 <i class="bi bi-arrow-left-circle"></i> Volver
                </a>
            </div>

            {{-- Tarjeta del formulario --}}
            <div class="card custom-card shadow-lg border-0">
                <div class="card-body p-4">

                    <form action="{{ route('compras.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="precioCompra" class="form-label fw-semibold">Precio de Compra</label>
                            <input type="decimal" id="precioCompra" name="precioCompra"
                                class="form-control @error('precioCompra') is-invalid @enderror">
                            @error('precioCompra')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="precioVenta" class="form-label fw-semibold">Precio de Venta</label>
                            <input type="decimal" id="precioVenta" name="precioVenta"
                                class="form-control @error('precioVenta') is-invalid @enderror">
                            @error('precioVenta')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="Cantidad" class="form-label fw-semibold">Cantidad</label>
                            <input type="int" id="Cantidad" name="Cantidad"
                                class="form-control @error('Cantidad') is-invalid @enderror">
                            @error('Cantidad')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="Total" class="form-label fw-semibold">Total</label>
                            <input type="text" id="Total" name="Total" readonly
                                class="form-control @error('Total') is-invalid @enderror">
                            @error('Total')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                        <label for="metodoPago">Método de Pago</label>
                        <select name="metodoPago" id="metodoPago" class="form-control" required>
                        <option value="" disabled selected>Seleccione un método</option>
        
                       <option value="Efectivo">Efectivo</option>
                        <option value="Tarjeta">Tarjeta</option>
                        <option value="Transferencia">Transferencia</option>
                        </select>
                        </div>



                        <div class="mb-3">
                            <label for="idproveedor" class="form-label fw-semibold">Proveedor</label>
                            <select id="idproveedor" name="idproveedor"
                                class="form-select @error('idproveedor') is-invalid @enderror">
                                <option value="">Selecciona un proveedor </option>
                                @foreach ( $proveedores as  $proveedor)
                                    
                                <option value=" {{$proveedor->id }}">{{$proveedor->nombre}}</option>
                              @endforeach
                            </select>
                                
                                
                            @error('idproveedor')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                         <div class="mb-3">
                            <label for="idproducto" class="form-label fw-semibold">Producto</label>
                            <select id="idproducto" name="idproducto"
                                class="form-select @error('idproducto') is-invalid @enderror">
                                <option value=""> Selecciona un producto</option>
                                @foreach ( $proveedores as  $proveedor)
                                    
                                <option value=" {{$producto->id }}">{{$producto->nombre}}</option>
                              @endforeach
                            </select>
                                
                                
                            @error('idproducto')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>







                        <div class="text-end">
                            <button type="submit" class="crearBtn">
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
        const cantidad = document.getElementById("Cantidad");
        const total = document.getElementById("Total");

        function calcularTotal() {
            const p = parseFloat(precioCompra.value) || 0;
            const c = parseInt(cantidad.value) || 0;
            total.value = (p * c).toFixed(2);
        }

        precioCompra.addEventListener("input", calcularTotal);
        cantidad.addEventListener("input", calcularTotal);
    });
</script>
