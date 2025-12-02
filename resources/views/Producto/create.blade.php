@extends('layouts.app')

@section('title', 'Registrar Producto')

@section('titleContent')
<h1 class="text-center my-4 fw-bold text-dark">Registro de Nuevo Producto</h1>
@endsection

@section('content')

<style>
    /* --- VARIABLES DE ESTILO LIMPIO Y AZUL PASTEL --- */
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

    .clean-header {
        background-color: var(--header-bg) !important;
        color: var(--text-dark) !important;
        font-weight: 600;
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--card-border);
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        font-size: 1.25rem;
    }

    .clean-input, .clean-select, .clean-textarea {
        border-radius: 8px !important;
        border: 1px solid var(--input-border) !important;
        padding: 0.6rem 1rem;
        background: #ffffff;
        transition: all 0.2s;
        color: var(--text-dark);
    }
    .clean-input:focus, .clean-select:focus, .clean-textarea:focus {
        border-color: var(--primary-soft-blue) !important;
        box-shadow: 0 0 0 0.2rem var(--input-focus-shadow);
        background-color: #fcfdff;
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
    }
    .btn-action-primary:hover {
        background-color: #0069d9 !important;
    }

    .btn-cancel-secondary {
        background-color: #e9f5ff !important;
        color: var(--primary-soft-blue) !important;
        border: 1px solid var(--card-border) !important;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 600;
        transition: background-color 0.2s ease;
    }
    .btn-cancel-secondary:hover {
        background-color: #daeafc !important;
        color: #0056b3 !important;
    }
</style>

<div class="container mt-4">
    <div class="card clean-card shadow-lg border-0">

        <div class="card-header clean-header d-flex align-items-center">
            <i class="fas fa-box me-2"></i> Registrar Nuevo Producto
        </div>

        <div class="card-body p-4">
            <form action="{{ route('productos.store') }}" method="POST">
                @csrf
                <div class="row g-4">

                    <!-- Campo Nombre -->
                    <div class="col-md-6">
                        <label class="form-label">Nombre del Producto</label>
                        <input 
                            type="text" 
                            name="nombre" 
                            value="{{ old('nombre') }}"
                            class="form-control clean-input @error('nombre') is-invalid @enderror"
                        >
                        @error('nombre')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Campo Precio -->
                    <div class="col-md-6">
                        <label class="form-label">Precio ($)</label>
                        <input 
                            type="number" 
                            step="0.01" 
                            name="precio" 
                            value="{{ old('precio') }}"
                            class="form-control clean-input @error('precio') is-invalid @enderror"
                            placeholder="Ej: 199.99"
                        >
                        @error('precio')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Campo Descripción -->
                    <div class="col-md-12">
                        <label class="form-label">Descripción</label>
                        <textarea 
                            name="descripcion" 
                            class="form-control clean-textarea @error('descripcion') is-invalid @enderror"
                            rows="3"
                            placeholder="Descripción detallada del producto para el cliente..."
                        >{{ old('descripcion') }}</textarea>

                        @error('descripcion')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Campo Stock -->
                    <div class="col-md-4">
                        <label class="form-label">Stock Inicial</label>
                        <input 
                            type="number" 
                            name="stock" 
                            value="{{ old('stock') }}"
                            class="form-control clean-input @error('stock') is-invalid @enderror"
                            placeholder="Ej: 50"
                        >
                        @error('stock')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Campo Categoría -->
                    <div class="col-md-4">
                        <label class="form-label">Categoría</label>
                        <select 
                            name="idCategoria" 
                            class="form-select clean-select @error('idCategoria') is-invalid @enderror"
                        >
                            <option value="" >Seleccione una categoría</option>


                            @foreach($categorias as $cat)
                                <option 
                                    value="{{ $cat->id }}"
                                    {{ old('idCategoria') == $cat->id ? 'selected' : '' }}
                                >
                                    {{ $cat->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('idCategoria')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Campo Proveedor -->
                    <div class="col-md-4">
                        <label class="form-label">Proveedor</label>
                        <select 
                            name="idProveedor" 
                            class="form-select clean-select @error('idProveedor') is-invalid @enderror"
                        >
                            <option value="" >Seleccione un proveedor</option>

                            @foreach($proveedores as $prov)
                                <option 
                                    value="{{ $prov->id }}"
                                    {{ old('idProveedor') == $prov->id ? 'selected' : '' }}
                                >
                                    {{ $prov->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('idProveedor')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="mt-5 d-flex justify-content-between">
                    <a href="{{ route('productos.index') }}" class="btn btn-cancel-secondary d-flex align-items-center gap-2">
                        <i class="fas fa-arrow-left"></i> Cancelar y Volver
                    </a>
                    <button class="btn btn-action-primary d-flex align-items-center gap-2">
                        <i class="fas fa-save"></i> Guardar Producto
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
