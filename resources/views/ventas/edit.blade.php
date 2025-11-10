@extends('layouts.app')

@section('title', 'Editar Venta')

@section('titleContent')
    <header class="encabezado-ventas shadow-sm">
        <h1>Editar Registro de Venta #{{ $ventas->id }}</h1>
        <p>Modifica los datos de la transacción seleccionada</p>
    </header>
@endsection

@section('content')

<div class="container py-4">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card custom-card shadow-lg border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Formulario de Edición de Venta</h5>
                </div>
                <div class="card-body">
                    
                    {{-- Formulario de Edición --}}
                    {{-- La ruta usa el ID de la venta para saber cuál actualizar --}}
                    <form action="{{ route('ventas.update', $ventas->id) }}" method="POST">
                        @csrf
                        
                        
                        {{-- Campo de Fecha --}}
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha de Venta</label>
                            {{-- Se precarga con $venta->fecha o con old('fecha') si hay error --}}
                            <input type="date" class="form-control @error('fecha') is-invalid @enderror" id="fecha" name="fecha" value="{{ old('fecha', $ventas->fecha) }}" required>
                            @error('fecha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Campo de Total --}}
                        <div class="mb-3">
                            <label for="total" class="form-label">Total de Venta</label>
                            {{-- Se precarga con $venta->total o con old('total') si hay error --}}
                            <input type="number" step="0.01" min="0" class="form-control @error('total') is-invalid @enderror" id="total" name="total" value="{{ old('total', $ventas->total) }}" placeholder="Ej: 150.75" required>
                            @error('total')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Campo de Cliente (idcliente) --}}
                        <div class="mb-3">
                            <label for="idcliente" class="form-label">Cliente</label>
                            {{-- $clientes y $venta deben ser pasados desde el controlador --}}
                            <select class="form-select @error('idcliente') is-invalid @enderror" id="idcliente" name="idcliente" required>
                                <option value="">Seleccione un Cliente</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" 
                                        {{-- Lógica para seleccionar el cliente actual (old() tiene prioridad) --}}
                                        {{ (old('idcliente') == $cliente->id || $ventas->idcliente == $cliente->id) ? 'selected' : '' }}>
                                        {{ $cliente->Nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idcliente')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Campo de Empleado (idempleado) --}}
                        <div class="mb-3">
                            <label for="idempleado" class="form-label">Empleado que Registra</label>
                            {{-- $empleados y $venta deben ser pasados desde el controlador --}}
                            <select class="form-select @error('idempleado') is-invalid @enderror" id="idempleado" name="idempleado" required>
                                <option value="">Seleccione un Empleado</option>
                                @foreach ($empleados as $empleado)
                                    <option value="{{ $empleado->id }}" 
                                        {{-- Lógica para seleccionar el empleado actual (old() tiene prioridad) --}}
                                        {{ (old('idempleado') == $empleado->id || $ventas->idempleado == $empleado->id) ? 'selected' : '' }}>
                                        {{ $empleado->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idempleado')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        {{-- Botones de acción --}}
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btnActualizar">Actualizar Venta</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

<footer>
    Realizado por <b>Karen Julieth Sepúlveda Sánchez</b> - <b>Vanessa García Corzo</b> | 2025
</footer>

@endsection