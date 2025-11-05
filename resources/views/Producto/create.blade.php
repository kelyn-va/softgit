@extends('layouts.app')

@section('title', 'Crear Producto')

@section('titleContent')
    <h1 class="text-center my-4 fw-bold text-dark">Crear Producto</h1>
@endsection

@section('content')



<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            {{-- Botón de volver --}}
            <div class="mb-3 text-start">
                <a href="{{ route('productos.index') }}" class="volverBtn d-inline-flex align-items-center gap-1">
                    🔙 <i class="bi bi-arrow-left-circle"></i> Volver
                </a>
            </div>

            {{-- Tarjeta del formulario --}}
            <div class="card custom-card shadow-lg border-0">
                <div class="card-body p-4">

                    <form action="{{ route('productos.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label fw-semibold">nombre</label>
                            <input type="text" id="nombre" name="nombre" 
                                class="form-control @error('nombre') is-invalid @enderror">
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                         <div class="mb-3">
                            <label for="descripcion" class="form-label fw-semibold">descripcion</label>
                            <input type="text" id="descripcion" name="descripcion" 
                                class="form-control @error('descripcion') is-invalid @enderror">
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                         <div class="mb-3">
                            <label for="precio" class="form-label fw-semibold">precio</label>
                            <input type="decimal" id="precio" name="precio" 
                                class="form-control @error('precio') is-invalid @enderror">
                            @error('precio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                         <div class="mb-3">
                            <label for="stock" class="form-label fw-semibold">stock</label>
                            <input type="decimal" id="stock" name="stock" 
                                class="form-control @error('stock') is-invalid @enderror">
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="crearBtn">
                                ➕ <i class="bi bi-person-plus"></i> Crear Categoria
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection