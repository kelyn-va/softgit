@extends('layouts.app')

@section('title', 'Editar Pago')

@section('titleContent')
<h1 class="text-center my-4 fw-bold text-dark">Editar Pago #{{ $pago->id }}</h1>
@endsection

@section('content')

<div class="container py-4">

    <!-- Botón de Volver -->
    <div class="mb-4">
        <a href="{{ route('pagos.index') }}" class="volverBtn d-flex align-items-center gap-2">
            🔙 <i class="bi bi-arrow-left-circle iconBtn"></i> Volver a Pagos
        </a>
    </div>

    <!-- Tarjeta del Formulario -->
    <div class="card custom-card shadow-lg border-0 mx-auto" style="max-width: 600px;">
        <div class="card-body p-4">

            <!-- Título del Formulario -->
            <h3 class="text-center mb-4">Actualizar Detalles del Pago</h3>

            <!-- Formulario de Edición -->
            <!-- La acción debe apuntar al método 'update' del recurso 'pagos' -->
            <form action="{{ route('pagos.update', $pago->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Usamos el método PUT/PATCH para la actualización -->

                <!-- Campo: Monto -->
                <div class="mb-3">
                    <label for="monto" class="form-label">Monto ($)</label>
                    <input type="number" 
                           step="0.01" 
                           class="form-control @error('monto') is-invalid @enderror" 
                           id="monto" 
                           name="monto" 
                           value="{{ old('monto', $pago->monto) }}" 
                           required>
                    @error('monto')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Campo: Venta Relacionada (idventa) -->
                <div class="mb-3">
                    <label for="idventa" class="form-label">Venta Asociada</label>
                    <select class="form-select @error('idventa') is-invalid @enderror" 
                            id="idventa" 
                            name="idventa" 
                            required>
                        <option value="">-- Seleccione una Venta --</option>
                        
                        <!-- Iterar sobre las Ventas. Usar $pago->idventa para precargar el valor actual. -->
                        @foreach ($ventas as $venta)
                            <option value="{{ $venta->id }}" 
                                    {{ old('idventa', $pago->idventa) == $venta->id ? 'selected' : '' }}>
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

                <!-- Campo: Método de Pago (idmetodopagos) -->
                <div class="mb-4">
                    <label for="idmetodopagos" class="form-label">Método de Pago</label>
                    <select class="form-select @error('idmetodopagos') is-invalid @enderror" 
                            id="idmetodopagos" 
                            name="idmetodopagos" 
                            required>
                        <option value="">-- Seleccione un Método de Pago --</option>
                        
                        <!-- Iterar sobre los Métodos de Pago. Usar $pago->idmetodopagos para precargar el valor actual. -->
                        @foreach ($metodosDePago as $metodo)
                            <option value="{{ $metodo->id }}" 
                                    {{ old('idmetodopagos', $pago->idmetodopagos) == $metodo->id ? 'selected' : '' }}>
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

                <!-- Botón de Actualizar -->
                <div class="d-grid">
                    <button type="submit" class="btnActualizar btn-lg d-flex align-items-center justify-content-center gap-2">
                        🔁 Actualizar Pago
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection


