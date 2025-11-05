@extends('layouts.app')

@section('title', 'Crear Proveedor')

@section('titleContent')
    <h1 class="text-center my-4 fw-bold text-dark">Crear Proveedor</h1>
@endsection

@section('content')



<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            {{-- Botón de volver --}}
            <div class="mb-3 text-start">
                <a href="{{ route('proveedor.index') }}" class="volverBtn d-inline-flex align-items-center gap-1">
                    🔙 <i class="bi bi-arrow-left-circle"></i> Volver
                </a>
            </div>

            {{-- Tarjeta del formulario --}}
            <div class="card custom-card shadow-lg border-0">
                <div class="card-body p-4">

                    <form action="{{ route('proveedor.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nombre" class="form-label fw-semibold"> nombre</label>
                            <input type="text" id="nombre" name="nombre" 
                                   class="form-control @error('nombre') is-invalid @enderror">
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="contacto" class="form-label fw-semibold"> contacto</label>
                            <input type="text" id="contacto" name="contacto" 
                                   class="form-control @error('contacto') is-invalid @enderror">
                            @error('contacto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label fw-semibold"> telefono</label>
                            <input type="text" id="telefono" name="telefono" 
                                   class="form-control @error('telefono') is-invalid @enderror">
                            @error('telefono')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="direccion" class="form-label fw-semibold"> Dirección</label>
                            <input type="text" id="direccion" name="direccion" 
                                   class="form-control @error('direccion') is-invalid @enderror">
                            @error('direccion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="crearBtn">
                                ➕ <i class="bi bi-person-plus"></i> Crear proveedor
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection