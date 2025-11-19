@extends('layouts.app')

@section('title', 'Crear Nuevo Pago')

@section('titleContent')
<h1 class="text-center my-4 fw-bold text-dark">Registrar Nuevo Pago</h1>
@endsection

@section('content')

<div class="container py-4">

    <div class="mb-4">
        <a href="{{ route('pagos.index') }}" class="volverBtn d-flex align-items-center gap-2">
            🔙 <i class="bi bi-arrow-left-circle iconBtn"></i> Volver a Pagos
        </a>
    </div>

    <div class="card custom-card shadow-lg border-0 mx-auto" style="max-width: 600px;">
        <div class="card-body p-4">

            <h3 class="text-center mb-4">Detalles del Pago</h3>

            <form action="{{ route('pagos.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="monto" class="form-label">Monto ($)</label>
                    <input type="number" 
                           step="0.01" 
                           class="form-control @error('monto') is-invalid @enderror" 
                           id="monto" 
                           name="monto" 
                           value="{{ old('monto') }}" 
                           required>
                    @error('monto')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="idventa" class="form-label">Venta Asociada</label>
                    <select class="form-select @error('idventa') is-invalid @enderror" 
                            id="idventa" 
                            name="idventa" 
                            required>
                        <option value="">-- Seleccione una Venta --</option>
                        @foreach ($ventas as $venta)
                            <option value="{{ $venta->id }}" {{ old('idventa') == $venta->id ? 'selected' : '' }}>
                                Venta #{{ $venta->id }} ({{ $venta->created_at->format('d/m/Y') ?? 'Sin fecha' }})
                            </option>
                        @endforeach
                    </select>
                    @error('idventa')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="idmetodopagos" class="form-label">Método de Pago</label>
                    <select class="form-select @error('idmetodopagos') is-invalid @enderror" 
                            id="idmetodopagos" 
                            name="idmetodopagos" 
                            required>
                        <option value="">-- Seleccione un Método de Pago --</option>
                        @foreach ( $metodoPago  as $metodo)
                            <option value="{{ $metodo->id }}" {{ old('idmetodopagos') == $metodo->id ? 'selected' : '' }}>
                                {{ $metodo->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('idmetodopagos')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btnCrear btn-lg d-flex align-items-center justify-content-center gap-2">
                        Guardar Pago
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection