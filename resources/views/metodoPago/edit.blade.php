@extends('layouts.app')

@section('title', 'Editar Método de Pago')

@section('titleContent')
    <h1 class="text-center my-4 fw-bold text-dark">Editar Método de Pago</h1>
@endsection

@section('content')

<div class="overlay-modal">
    <div class="modal-card p-4">

        {{-- Botón de volver --}}
        <div class="mb-3 text-start">
            <a href="{{ route('metodoPago.index') }}" class="volverBtn d-flex align-items-center gap-2">
                🔙<i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>

        {{-- Tarjeta del formulario --}}
        <div class="card custom-card shadow-lg border-0">
            <div class="card-body">
                <form action="{{ route('metodoPago.update', $metodoPago->id) }}" method="POST">
                    @csrf
                    

                    {{-- Campo descripción --}}
                    <div class="mb-3">
                        <label for="descripcion" class="form-label fw-semibold">Descripción del Método de Pago</label>
                        <input type="text" id="descripcion" name="descripcion"
                            class="form-control @error('descripcion') is-invalid @enderror"
                            placeholder="Ej: Tarjeta de crédito, Efectivo, Transferencia, etc."
                            value="{{ old('descripcion', $metodoPago->descripcion) }}">

                        @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Botones --}}
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <button type="submit" class="btnGuardar d-flex align-items-center gap-2">
                            💾 <i class="bi bi-check-circle"></i> Actualizar
                        </button>

                        <a href="{{ route('metodoPago.index') }}" class="btnCancelar d-flex align-items-center gap-2">
                            ❌ <i class="bi bi-x-circle"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
