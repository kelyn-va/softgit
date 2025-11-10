@extends('layouts.app')

@section('title', 'Crear Nueva Venta')

@section('titleContent')
    <header class="encabezado-ventas shadow-sm">
        <h1>Registrar Nueva Venta</h1>
        <p>Completa los campos para registrar una nueva transacción</p>
    </header>
@endsection

@section('content')

<div class="container py-4">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card custom-card shadow-lg border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Formulario de Registro de Venta</h5>
                </div>
                <div class="card-body">
                    
                    {{-- Formulario de Creación --}}
                    <form action="{{ route('ventas.store') }}" method="POST">
                        @csrf
                        
                        {{-- Campo de Fecha --}}
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha de Venta</label>
                            {{-- Se usa type="date" para facilitar la selección --}}
                            <input type="date" class="form-control @error('fecha') is-invalid @enderror" id="fecha" name="fecha" value="{{ old('fecha', date('Y-m-d')) }}" required>
                            @error('fecha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Campo de Total --}}
                        <div class="mb-3">
                            <label for="total" class="form-label">Total de Venta</label>
                            {{-- Se usa type="number" para asegurar el formato numérico --}}
                            <input type="number" step="0.01" min="0" class="form-control @error('total') is-invalid @enderror" id="total" name="total" value="{{ old('total') }}" placeholder="Ej: 150.75" required>
                            @error('total')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Campo de Cliente (idCliente) --}}
                        <div class="mb-3">
                            <label for="idCliente" class="form-label">Cliente</label>
                            {{-- Se asume que $clientes es una colección de todos los clientes disponible en el controlador --}}
                            <select class="form-select @error('idCliente') is-invalid @enderror" id="idCliente" name="idCliente" required>
                                <option value="">Seleccione un Cliente</option>
                                {{-- Itera sobre la colección de clientes --}}
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" {{ old('idCliente') == $cliente->id ? 'selected' : '' }}>
                                        {{ $cliente->Nombre }} {{-- Asume que el modelo Cliente tiene un campo 'Nombre' --}}
                                    </option>
                                @endforeach
                            </select>
                            @error('idCliente')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Campo de Empleado (idempleado) --}}
                        <div class="mb-3">
                            <label for="idempleado" class="form-label">Empleado que Registra</label>
                            {{-- Se asume que $empleados es una colección de todos los empleados disponible en el controlador --}}
                            <select class="form-select @error('idempleado') is-invalid @enderror" id="idempleado" name="idempleado" required>
                                <option value="">Seleccione un Empleado</option>
                                {{-- Itera sobre la colección de empleados --}}
                                @foreach ($empleados as $empleado)
                                    <option value="{{ $empleado->id }}" {{ old('idempleado') == $empleado->id ? 'selected' : '' }}>
                                        {{ $empleado->nombre }} {{-- Asume que el modelo Empleado tiene un campo 'Nombre' --}}
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
                            <button type="submit" class="crearBtn">Guardar Venta</button>
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