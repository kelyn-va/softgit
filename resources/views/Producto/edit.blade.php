@extends('layouts.app')

@section('title', 'Crear Producto')

@section('titleContent')
    <h1 class="text-center my-4 fw-bold text-dark">Actualizar producto</h1>
@endsection

@section('Content')


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

                    <form action="{{ route('productos.update',$productos->id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nombre" class="form-label fw-semibold">Nombre</label>
                            <input type="text" id="nombre" name="nombre" 
                                class="form-control @error('nombre') is-invalid @enderror" value="{{ $productos->nombre }}">
                            @error('Nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="descripcion" class="form-label fw-semibold">descripcion</label>
                            <input type="text" id="descripcion" name="descripcion" 
                                class="form-control @error('descripcion') is-invalid @enderror" value="{{ $productos->descripcion}}">
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="precio" class="form-label fw-semibold">precio</label>
                            <input type="decimal" id="precio" name="precio" 
                                class="form-control @error('precio') is-invalid @enderror" value="{{ $productos->precio}}">
                            @error('precio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="stock" class="form-label fw-semibold">stock</label>
                            <input type="int" id="stock" name="stock" 
                                class="form-control @error('stock') is-invalid @enderror" value="{{ $productos->stock}}">
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="codigoBarras" class="form-label fw-semibold">codigoBarras</label>
                            <input type="text" id="codigoBarras" name="codigoBarras" 
                                class="form-control @error('codigoBarras') is-invalid @enderror" value="{{ $productos->codigoBarras}}">
                            @error('codigoBarras')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                         {{-- Categoria --}}
            <div class="mb-3">
                <label for="idCategoria" class="form-label">Categoria</label>
                <select name="idCategoria" id="idCategoria" class="form-select form-select-sm" >
                    <option value="">Seleccione una categoria</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ $productos->idCategoria == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>



            {{-- proveedor --}}
            <div class="mb-3">
                <label for="idproveedor" class="form-label">Proveedor</label>
                <select name="idproveedor" id="idproveedor" class="form-select form-select-sm" >
                    <option value="">Seleccione un proveedor</option>
                    @foreach($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}" {{ $productos->idproveedor == $proveedor->id ? 'selected' : '' }}>
                            {{ $proveedor->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>



             {{-- proveedor --}}
            <div class="mb-3">
                <label for="idInventario" class="form-label">inventario</label>
                <select name="idInventario" id="idInventario" class="form-select form-select-sm" >
                    <option value="">Seleccione un invetario</option>
                    @foreach($inventarios as $inventario)
                        <option value="{{ $inventario->id }}" {{ $productos->idInventario == $inventario->id ? 'selected' : '' }}>
                            {{ $inventario->cantidad }}
                        </option>
                    @endforeach
                </select>
            </div>





                        <div class="text-end">
                            <button type="submit" class="crearBtn">
                                ➕ <i class="bi bi-person-plus"></i> Actualizar Categoria
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
